<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_dashboard_controller extends Controller {
    protected $user_id;
    public function __construct()
    {
        parent::__construct();
        $this->call->model('User_dashboard_model', 'dm');
        $this->user_id = $this->session->userdata('user_id');;
    }

    public function get_dashboard() {
        $data['budgets'] = $this->dm->get_budget_overview($this->user_id);
        $data['notifs'] = $this->dm->get_recent_notifications($this->user_id);
        $data['savings'] = $this->dm->check_savings_goals($this->user_id);

        return $this->call->view('user/dashboard', $data);
    }
}
?>
