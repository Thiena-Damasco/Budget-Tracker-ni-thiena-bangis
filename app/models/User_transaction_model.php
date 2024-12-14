<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_transaction_model extends Model {
    
    public function __construct()
    {
        parent::__construct();
    }

    public function get_transactions($user_id){
        return $this->db->table('transactions as t')
                        ->join('categories as c', 't.category_id = c.id')
                        ->where('t.user_id', $user_id)
                        ->order_by('t.timestamp', 'DESC')
                        ->get_all();
    }

    public function add_transaction($data){
        $bind = array(
            'user_id' => $data['user_id'],
            'category_id' => $data['category_id'],
            'amount' => $data['amount'],
            'remaining_amount' => $data['remaining_amount']
        );

        return $this->db->table('transactions')->insert($bind);
    }

    public function get_transaction_by_id($id){
        return $this->db->table('transactions')->where('id', $id)->get();
    }
}
?>
