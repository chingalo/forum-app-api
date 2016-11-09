<?php

/**
 * Created by PhpStorm.
 * User: chingalo
 * Date: 11/5/16
 * Time: 8:44 AM
 */
class Comment_model extends CI_Model
{

    function addComment($data){
        $result = array('message'=>"",'status'=>0);
        $this->db->insert('comments',$data);
        $result['message'] = "success";
        $result['status'] = 1;

        return $result;
    }

    function getCommentsByTopic($topicId){
        $sql = "SELECT comments.comment_id, comments.description, comments.posted_date, users.full_name FROM `comments` JOIN users ON users.user_id = comments.user_id WHERE comments.eid ='".$topicId."'";
        $result = $this->db->query($sql);
        return $result->result();
    }
}