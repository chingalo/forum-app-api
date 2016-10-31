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
        $result = array('message'=>"",'status'=>0);
        if($this->getUserByUserName($data) === 0){
            $this->db->insert('users',$data);
            $result['message'] = "Account created";
            $result['status'] = 1;
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