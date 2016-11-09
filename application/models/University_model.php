<?php

/**
 * Created by PhpStorm.
 * User: chingalo
 * Date: 11/9/16
 * Time: 10:08 AM
 */
class University_model extends CI_Model
{
    function getUniversities(){
        $sql = "SELECT * FROM university ORDER BY  university.uni_name ASC  ";
        $result = $this->db->query($sql);
        return $result->result();
    }

}