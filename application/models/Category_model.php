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
}