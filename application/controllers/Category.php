<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: chingalo
 * Date: 10/30/16
 * Time: 9:11 AM
 */
class Category extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Method: PUT, GET, POST, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token');
    }

    //for categories
    function getALlCategories()
    {
        $data = $this->Category_model->getAll();
        echo json_encode($data);
    }

    //routes for user categories
    function getUserCategories()
    {
        $postData = file_get_contents("php://input");
        $dataObject = json_decode($postData);

        @$userId = $dataObject->data->user_id;
        $data = array(
            'user_id' => $userId
        );

        $result = $this->Category_model->getUserCategories($data);
        echo json_encode($result);

    }

    function addUserCategories()
    {
        $postData = file_get_contents("php://input");
        $dataObject = json_decode($postData);

        @$userId = $dataObject->data->user_id;
        @$cat_id = $dataObject->data->cat_id;
        $data = array(
            'user_id' => $userId,
            'cat_id' => $cat_id
        );
        $result = $this->Category_model->addUserCategories($data);
        echo json_encode($result);

    }

    //routes for category entities
    function saveCategoryEntity()
    {
        $postData = file_get_contents("php://input");
        $dataObject = json_decode($postData);
        //cat_id user_id title description posted_date
        @$cat_id = $dataObject->data->cat_id;
        @$user_id = $dataObject->data->user_id;
        @$title = $dataObject->data->title;
        @$description = $dataObject->data->description;
        $data = array(
            "cat_id" =>$cat_id,
            "user_id" => $user_id,
            "title" => $title,
            "description" => $description,
            "posted_date" => $this->User_model->getCurrentDate()
        );

        $result = $this->Category_entity_model->addCategoryEntity($data);
        echo json_encode($result);


    }

    function getCategoryEntities(){
        $postData = file_get_contents("php://input");
        $dataObject = json_decode($postData);
        @$categoryIds = $dataObject->data->categoryIds;

        $result = $this->Category_entity_model->getCategoryEntities($categoryIds);
        echo json_encode($result);
    }


    //comments
    function saveComment(){
        $postData = file_get_contents("php://input");
        $dataObject = json_decode($postData);
        @$user_id = $dataObject->data->user_id;
        @$eid = $dataObject->data->eid;
        @$description = $dataObject->data->description;
        $data = array(
            "eid" => $eid,
            "user_id"=>$user_id,
            "description"=>$description,
            "posted_date" => $this->User_model->getCurrentDate()
        );

        $result = $this->Comment_model->addComment($data);
        echo json_encode($result);
    }

    function getComments(){

        $topicId = $this->uri->segment(2);

        $result =  $this->Comment_model->getCommentsByTopic($topicId);
        echo json_encode($result);
    }


    //universities
    function getUserUniversities(){
        $result =  $this->University_model->getUniversities();
        echo json_encode($result);
    }


}