<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class admin_model_model extends Model {
    
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
    }
    public function get_user_count() {
        return $this->db->table('users')->select('COUNT(*) as count')->get()['count'];
    }

    public function get_category_count() {
        return $this->db->table('categories')->select('COUNT(*) as count')->get()['count'];
    }

    public function get_transaction_count() {
        return $this->db->table('transactions')->select('COUNT(*) as count')->get()['count'];
    }

    public function get_total_budget() {
        return $this->db->table('categories')->select('SUM(total_budget) as total')->get()['total'];
    }

    public function get_recent_transactions($limit = 5) {
        return $this->db->table('transactions')
            ->select('transactions.*, categories.category_name, users.firstname, users.lastname')
            ->join('categories', 'categories.id = transactions.category_id')
            ->join('users', 'users.user_id = transactions.user_id')
            ->limit($limit)
            ->order_by('timestamp', 'DESC')
            ->get_all();
    }

    public function get_category_totals() {
        return $this->db->table('categories')
            ->select('category_name, SUM(total_budget) as total')
            ->group_by('category_name')
            ->get_all();
    }

    public function get_users() {
        return $this->db->table('users')
            ->select('user_id, firstname, lastname, email, gender, created_at')
            ->get_all();
    }

    public function get_user_feedback() {
        return $this->db->table('user_feedback')
            ->select('user_feedback.*, users.firstname, users.lastname')
            ->join('users', 'users.user_id = user_feedback.user_id')
            ->order_by('submitted_at', 'DESC')
            ->get_all();
    }

    public function get_categories() {
        return $this->db->table('categories')
            ->select('categories.*, users.firstname, users.lastname')
            ->join('users', 'users.user_id = categories.user_id')
            ->get_all();
    }

    public function get_transactions() {
        return $this->db->table('transactions')
            ->select('transactions.*, categories.category_name, users.firstname, users.lastname')
            ->join('categories', 'categories.id = transactions.category_id')
            ->join('users', 'users.user_id = transactions.user_id')
            ->order_by('timestamp', 'DESC')
            ->get_all();
    }

    public function get_notifications() {
        return $this->db->table('notifications')
            ->select('notifications.*, users.firstname, users.lastname')
            ->join('users', 'users.user_id = notifications.user_id')
            ->order_by('timestamp', 'DESC')
            ->get_all();
    }

    public function get_log_history() {
        return $this->db->table('log_history')
            ->select('log_history.*, users.firstname, users.lastname')
            ->join('users', 'users.user_id = log_history.user_id')
            ->order_by('login_time', 'DESC')
            ->get_all();
    }
}
?>
