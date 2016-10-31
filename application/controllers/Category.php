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
    function __construct(){
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Method: PUT, GET, POST, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token');
    }

    function getALlCategories()
    {
        $data = $this->Category_model->getAll();
        echo json_encode($data);
    }

    function getCategory()
    {

    }

    function addCategory(){

    }
}