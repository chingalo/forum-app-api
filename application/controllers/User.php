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

    function sendForgetPasswordVerificationCode(){

        $postData = file_get_contents("php://input");
        $dataObject = json_decode($postData);

        @$email = $dataObject->data->email;
        @$code = $dataObject->data->code;

        $user = $this->User_model->getUserByEmail($email);
        $name  = "";        
	    if($user->full_name){
            $name = $user->full_name;
        }
        $from_name = "noreply@evc.co.tz";
        $from_email = "noreply@evc.co.tz";
        $to = $email;
        $subject = 'UIN PASSWORD CHANGE VERIFICATION CODE';
        $message = "Dear ".$name ."\r\n"."If your tries to change password ,verification code is ".$code;
        $headers = 'From: '.$from_name. "\r\n" .
            'Reply-To: '.$from_email. "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $result = array(
            'status'=>"",
            'message' =>""
        );
        if(mail($to, $subject, $message, $headers)){
            $result["status"] = "200";
            $result["message"] = "success";
        }else{
            $result["status"] = "404";
            $result["message"] = "fail";
        }
        echo json_encode($result);
    }

    function updatePassword(){
        $postData = file_get_contents("php://input");
        $dataObject = json_decode($postData);

        @$email = $dataObject->data->email;
        @$password = $dataObject->data->password;

        $user = $this->User_model->getUserByEmail($email);
        $result = array(
            'status'=>"200",
            'message' =>"success"
        );
        if($user->user_id){
            $data = array(
                'user_id'=>$user->user_id,
                'password'=>md5($password),
            );
            $this->User_model->setPassword($data);
        }else{
            $result["status"] = "404";
            $result["message"] = "e-mail does not exit";
        }
        echo json_encode($result);
    }

}
