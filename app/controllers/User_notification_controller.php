<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_notification_controller extends Controller {
    protected $user_id;
    
    public function __construct()
    {
        parent::__construct();
        $this->call->model('User_notification_model', 'notification');
        $this->user_id = $this->session->userdata('user_id');;
    }

    public function index() {
        $data['notifications'] = $this->notification->get_notifications($this->user_id);
        $this->call->view('user/notifications/index', $data);
    }

}
?>
