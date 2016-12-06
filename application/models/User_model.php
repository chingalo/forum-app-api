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
        $result = array('message' => "", 'status' => 0, 'user_id' => "");
        if ($this->getUserByUserNameAndEmail($data) === 0) {
            $this->db->insert('users', $data);
            $user = $this->getUser($data);
            $result['message'] = "Account has been created created successfully";
            $result['status'] = 1;
            $result['user_id'] = $user->user_id;
        } else {
            $result['message'] = "Account has already created";
        }
        return $result;
    }

    function getUserByUserNameAndEmail($data)
    {
        $sql = "SELECT * FROM users WHERE  username = '" .$data['username']. "' and email = '".$data['email']."'";
        $result = $this->db->query($sql);
        return $result->num_rows();
    }

    function setPassword($data){
        $sql = "UPDATE users SET password ='".$data['password']."' WHERE user_id ='".$data['user_id']."'";
        $this->db->query($sql);
    }


    function getUserByEmail($email){
        $sql = "SELECT * FROM users WHERE   email = '".$email."'";
        $result = $this->db->query($sql);
        return $result->row();
    }

    function getUser($data)
    {
        $sql = "SELECT * FROM users WHERE  username = '" . $data['username'] . "' AND password = '" . $data['password'] . "'";
        $result = $this->db->query($sql);
        return $result->row();
    }

    function getAll()
    {
        $sql = "SELECT * FROM users ";
        $result = $this->db->query($sql);
        return $result->result();
    }

    function getCurrentDate()
    {
        date_default_timezone_set('Africa/Dar_es_Salaam');
        $date = date("Y-m-d");
        return $date;
    }


}
