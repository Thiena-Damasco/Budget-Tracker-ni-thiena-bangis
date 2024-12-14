<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_notification_model extends Model {
    
    public function __construct()
    {
        parent::__construct();
    }

    public function get_notifications($user_id){
        return $this->db->table('notifications')->where('user_id', $user_id)->order_by('timestamp', 'DESC')->get_all();
    }

    public function add_notification($data){
        $bind = array(
            'user_id' => $data['user_id'],
            'message' => $data['message']
        );

        return $this->db->table('notifications')->insert($bind);
    }

    public function mark_as_seen($id){
        $bind = array(
            'seen' => 1, 
        );
        
        return $this->db->table('notifications')->where('notification_id', $id)->update($bind);
    }
    
    public function delete_notification($id){
        return $this->db->table('notifications')->where('notification_id', $id)->delete();

    }

    public function get_notification_by_id($id){
        return $this->db->table('notifications')->where('notification_id', $id)->get();
    }

}
?>
