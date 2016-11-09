<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: chingalo
 * Date: 10/30/16
 * Time: 10:01 AM
 */
class User extends CI_Controller
{
    function __construct(){
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Method: PUT, GET, POST, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token');
    }

    function authenticate(){
        $postData = file_get_contents("php://input");
        $dataObject = json_decode($postData);

        @$username = $dataObject->data->username;
        @$password = $dataObject->data->password;

        $data = array(
            'username'=>$username,
            'password'=>md5($password)
        );
        $result = $this->User_model->getUser($data);
        echo json_encode($result);

    }

    function register(){
        $postData = file_get_contents("php://input");
        $dataObject = json_decode($postData);

        @$username = $dataObject->data->username;
        @$full_name = $dataObject->data->fullName;
        @$password = $dataObject->data->password;
        @$phone_number = $dataObject->data->mobileNumber;
        @$email = $dataObject->data->email;
        @$uni_id = $dataObject->data->uni_id;

        $data = array(
            'uni_id'=> $uni_id,
            'username'=>$username,
            'full_name'=>$full_name,
            'password'=>md5($password),
            'email'=>$email,
            'phone_number'=>$phone_number,
            'status' =>""
        );
        $result = $this->User_model->add($data);
        echo json_encode($result);

    }

}
