<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_category_controller extends Controller {
    protected $user_id;
    public function __construct()
    {
        parent::__construct();
        $this->call->model('User_category_model', 'category');
        $this->user_id = $this->session->userdata('user_id');;

    }
    public function index() {
        $data['categories'] = $this->category->get_categories($this->user_id);
        $this->call->view('user/categories/index', $data);
    }

    public function create() {
        if ($this->form_validation->submitted()) {
            $user_id = $this->user_id;
            $data = array(
                'user_id' => $user_id,
                'category_name' => $this->io->post('category_name'),
                'total_budget' => $this->io->post('total_budget'),
                'remaining_budget' => $this->io->post('total_budget'),
                'savings_goal' => $this->io->post('savings_goal')
            );
            
            if($this->category->add_category($data)) {
                set_flash_alert('success', 'Category has been added.');
            } else {
                set_flash_alert('danger', 'Category has not been added.');
            }
        }
        $this->call->view('user/categories/create');
    }
    

    public function update($id) {
        if ($this->form_validation->submitted()) {
            $data = [
                'category_name' => $this->io->post('category_name'),
                'total_budget' => $this->io->post('total_budget'),
                'savings_goal' => $this->io->post('savings_goal')
            ];
            
            if($this->category->update_category($data, $id)) {
                set_flash_alert('success', 'Category has been updated.');
            } else {
                set_flash_alert('danger', 'Category has not been updated.');
            }
        } 
        $data['c'] = $this->category->get_category_by_id($id);
        $this->call->view('user/categories/edit', $data);
    }

    
    public function delete($id) {
        if($this->category->delete_category($id)) {
            set_flash_alert('success', 'Category has been deleted.');
            redirect('categories');
        } else {
            set_flash_alert('danger', 'Category has not been deleted.');
            redirect('categories');
        }
    }
    
    
}
?>
