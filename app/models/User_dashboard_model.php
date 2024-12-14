<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_dashboard_model extends Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    public function get_budget_overview($user_id) {
        return $this->db->table('categories')
                        ->select('category_name, total_budget, remaining_budget, savings_goal, CASE WHEN remaining_budget < (total_budget * 0.1) THEN "Below 10%" ELSE "Sufficient" END AS budget_status')
                        ->where('user_id', $user_id)->get_all();
    }

    public function get_recent_notifications($user_id) {
        return $this->db->table('notifications')->where('user_id', $user_id)->order_by('timestamp', 'DESC')->limit(5)->get_all();
    }

    public function check_savings_goals($user_id) {
        
        return $this->db->table('categories')
                        ->select('category_name, savings_goal, (total_budget - remaining_budget) AS spent, CASE 
                                WHEN (total_budget - remaining_budget) >= savings_goal THEN "Goal Met"
                                ELSE "Goal Not Met"
                            END AS savings_status')->where('user_id', $user_id)->get_all();
    }

}   
?>
