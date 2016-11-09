<?php

/**
 * Created by PhpStorm.
 * User: chingalo
 * Date: 11/3/16
 * Time: 7:52 AM
 */
class Category_entity_model extends CI_Model
{

    function addCategoryEntity($data){
        $result = array('message'=>"",'status'=>0);
        $this->db->insert('categories_entity',$data);
        $result['message'] = "success";
        $result['status'] = 1;
        return $result;
    }

    function getCategoryEntities($categoryId)
    {
        $ids = "";
        for ($index = 0; $index < sizeof($categoryId); $index++) {
            if($index == 0){
                $ids = $ids.$categoryId[$index];
            }else{
                $ids = $ids ."','" .$categoryId[$index];
            }
        }
        $sql = "SELECT categories_entity.eid AS id, categories_entity.cat_id, categories_entity.title, categories_entity.description, categories_entity.posted_date, users.full_name AS poster, ( SELECT COUNT(*) FROM comments WHERE comments.eid = categories_entity.eid ) AS numberOfComents FROM categories_entity JOIN users ON users.user_id = categories_entity.user_id WHERE categories_entity.cat_id IN('".$ids."') GROUP BY categories_entity.eid DESC";
        $result = $this->db->query($sql);
		return $result->result();

    }

}
