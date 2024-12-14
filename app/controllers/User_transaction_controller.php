<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_transaction_controller extends Controller {
    protected $user_id;
    public function __construct()
    {
        parent::__construct();
        $this->call->model('User_transaction_model', 'transaction');
        $this->call->model('User_category_model', 'category');
        $this->call->model('User_notification_model', 'notification');
        $this->user_id = $this->session->userdata('user_id');
    }
    public function index() {
        $data['transactions'] = $this->transaction->get_transactions($this->user_id);
        $this->call->view('user/transactions/index', $data);
    }

    public function create() {
        if ($this->form_validation->submitted()) {
            $data = [
                'user_id' => $this->user_id,
                'category_id' => $this->io->post('category_id'),
                'amount' => $this->io->post('amount'),
            ];

            
            $category = $this->category->get_category_by_id($data['category_id']);

            if (!$category) {
                set_flash_alert('error', 'Category not found.');
                redirect('user/transactions/create');
                return;
            }

            $new_remaining_budget = $category['remaining_budget'] - $data['amount']; 

            if ($new_remaining_budget < 0) {
                set_flash_alert('error', 'Transaction amount exceeds remaining budget.');
                redirect('user/transactions/create');
                return;
            }
    
            $data['remaining_amount'] = $new_remaining_budget;
                   
            if($this->category->deduct($category['id'], $new_remaining_budget)) {
                if ($this->transaction->add_transaction($data)) {
                    
                    if ($new_remaining_budget < $category['total_budget'] * 0.1) {
                        $bind = array(
                            'user_id' => $this->user_id,
                            'message' => "Warning: Remaining budget for " . $category['category_name'] . " is below 10%"
                        );
                        if($this->notification->add_notification($bind)) {
                            set_flash_alert("success" , "Notification has been added");
                        } else {
                            set_flash_alert("failed" , "Notification has not been added");
                        }
                    } 
    
                    if ($category['savings_goal'] && $new_remaining_budget >= $category['savings_goal']) {
                        $bind = array(
                            'user_id' => $this->user_id,
                            'message'=> "Congratulations! You have reached your savings goal for " . $category['category_name'] . ".",
                        );
                        if($this->notification->add_notification($bind)) {
                            set_flash_alert("success" , "Notification has been added");
                        } else {

                            set_flash_alert("failed" , "Notification has not been added");
                        }                   
                    }        
                }
                set_flash_alert('success', 'Transaction has been added.');
                redirect('user/transactions/index');
            } else {
                set_flash_alert('error', 'Failed to update remaining budget.');
                $this->call->view('user/transactions/create');
            }
        }
    
        // Default view rendering when form is not submitted
        $data['categories'] = $this->category->get_categories($this->user_id);
        $this->call->view('user/transactions/create', $data);
    }
    
}
?>
