<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_feedback_ratings_model extends Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_ratings_feedbacks() {
        return $this->db->table('user_feedback as uf')
                        ->left_join('users as u', 'uf.user_id=u.user_id')
                        ->order_by('submitted_at', 'DESC')
                        ->get_all();
    }

    public function add_feedback_rating($data) {
        $bind = [
            'user_id' => $data['user_id'],
            'feedback_text' => $data['feedback_text'],
            'rating' => $data['rating']
        ];
        return $this->db->table('user_feedback')->insert($bind);
    }

    public function update_feedback($data, $id) {
        $bind = [
            'feedback_text' => $data['feedback_text'],
            'rating' => $data['rating'],
        ];
        return $this->db->table('user_feedback')->where('id', $id)->update($bind); // Correct table name
    }

    public function delete_feedback($id) {
        return $this->db->table('user_feedback')->where('id', $id)->delete();
    }

    public function get_feedback_by_id($id) {
        return $this->db->table('user_feedback')->where('id', $id)->get();
    }
}
?>
