<?php

/**
 * Created by PhpStorm.
 * User: chingalo
 * Date: 10/30/16
 * Time: 10:05 AM
 */
class User_model extends CI_Model
{

    function add($data)
    {
        $result = array('message'=>"",'status'=>0,'user_id'=>"");
        if($this->getUserByUserName($data) === 0){
            $this->db->insert('users',$data);
            $user = $this->getUser($data);
            $result['message'] = "Account has been created created successfully";
            $result['status'] = 1;
            $result['user_id'] = $user->user_id;
        }
        else{
            $result['message'] = "Account has already created";
        }
        return $result;
    }

    function getUserByUserName($data)
    {
        $sql = "SELECT * FROM users WHERE  username = '".$data['username']."'";
        $result = $this->db->query($sql);
        return $result->num_rows();
    }

    function getUser($data)
    {
        $sql = "SELECT * FROM users WHERE  username = '".$data['username']."' AND password = '".$data['password']."'";
        $result = $this->db->query($sql);
        return $result->row();
    }

    function getAll(){
        $sql = "SELECT * FROM users ";
        $result = $this->db->query($sql);
        return $result->result();
    }



}