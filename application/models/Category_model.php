<?php

/**
 * Created by PhpStorm.
 * User: chingalo
 * Date: 10/30/16
 * Time: 9:22 AM
 */
class Category_model extends CI_Model
{
    function getAll(){
        $sql = "SELECT * FROM categories ";
        $result = $this->db->query($sql);
        return $result->result();
    }

    function getUserCategories($data){
        $sql = "SELECT categories.cat_id,categories.cat_name,categories.description,categories.created_date FROM categories_user JOIN categories ON categories_user.cat_id = categories.cat_id  WHERE  user_id = '".$data['user_id']."'";
        $result = $this->db->query($sql);
        return $result->result();
    }

    function addUserCategories($data){
        $result = array('message'=>"",'status'=>0);
        $sql = "DELETE FROM `categories_user` WHERE user_id = '".$data->user_id."'";
        $this->db->query($sql);
        $this->db->insert('categories_user',$data);
        $result['message'] = "success";
        $result['status'] = 1;
        return $result;

    }
}