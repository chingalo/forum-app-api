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

    }

    function getCategoryEntities(){
        $postData = file_get_contents("php://input");
        $dataObject = json_decode($postData);
        @$categoryIds = $dataObject->data->categoryIds;

        $result = $this->Category_entity_model->getCategoryEntities($categoryIds);
        echo json_encode($result);
    }
}