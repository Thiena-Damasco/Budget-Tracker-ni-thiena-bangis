<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_category_model extends Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    public function get_categories($user_id){
        return $this->db->table('categories')->where('user_id', $user_id)->get_all();
    }

    public function add_category($data){
        $bind = array(
            'user_id' => $data['user_id'],
            'category_name' => $data['category_name'],
            'total_budget' => $data['total_budget'],
            'remaining_budget' => $data['remaining_budget'],
            'savings_goal' => $data['savings_goal']
        );

        return $this->db->table('categories')->insert($bind);
    }

    public function update_category($data, $id){
        $bind = array(
            'category_name' => $data['category_name'],
            'total_budget' => $data['total_budget'],
            'savings_goal' => $data['savings_goal']
        );
        return $this->db->table('categories')->where('id', $id)->update($bind);
    }

    public function deduct($id, $deducted_amount) {
        $bind = array(
            'remaining_budget' => $deducted_amount
        );
        return $this->db->table('categories')->where('id', $id)->update($bind);
    }

    public function delete_category($id){
        return $this->db->table('categories')->where('id', $id)->delete();
    }

    public function get_category_by_id($id){
        return $this->db->table('categories')->where('id', $id)->get();
    }
    
}
?>
