<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_feedback_ratings_controller extends Controller {
    protected $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->call->model('User_feedback_ratings_model', 'ufr');
        $this->user_id = $this->session->userdata('user_id');
    }

    public function index() {
        $data['feedback'] = $this->ufr->get_ratings_feedbacks($this->user_id); 
        $this->call->view('user/feedback/index', $data);
    }

    public function create() {
        if ($this->form_validation->submitted()) {
            $data = [
                'user_id' => $this->user_id,
                'feedback_text' => $this->io->post('feedback_text'),
                'rating' => $this->io->post('rating'),
            ];
            
            if ($this->ufr->add_feedback_rating($data)) {
                redirect('feedback');
            } else {
                $this->call->view('user/feedback/create', ['error' => 'Failed to add feedback']);
            }
        }     
        $data['feedback'] = $this->ufr->get_ratings_feedbacks();
        $this->call->view('user/feedback/create', $data); 
    }

    public function update($id) {
        if ($this->form_validation->submitted()) {
            $data = [
                'user_id' => $this->user_id,
                'feedback_text' => $this->io->post('feedback_text'),
                'rating' => $this->io->post('rating'),
            ];
            
            if ($this->ufr->update_feedback($data, $id)) { // Correct method call
                set_flash_alert('success', 'Feedback has been updated.');
            } else {
                set_flash_alert('danger', 'Feedback has not been updated.');
            }
        } 
        $data['c'] = $this->ufr->get_feedback_by_id($id); // Correct method call
        $this->call->view('user/feedback/edit', $data);
    }

    public function delete($id) {
        if($this->ufr->delete_feedback($id)) { // Correct method call
            set_flash_alert('success', 'Feedback has been deleted.');
            redirect('feedback');
        } else {
            set_flash_alert('danger', 'Feedback has not been deleted.');
            redirect('feedback');
        }
    }
}
?>
