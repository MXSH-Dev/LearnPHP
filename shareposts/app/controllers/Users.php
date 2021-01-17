<?php
class Users extends Controller {

    public function __construct(){}

    public function register(){
        
        // check for POST
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            // process register

        }else{
            // init data

            $data = [
                'name'=> '',
                'email'=>'',
                'password'=>'',
                'confirm_password'=>'',
                'name_err'=> '',
                'email_err'=>'',
                'password_err'=>'',
                'confirm_password_err'=>'',
            ];

            // load view

            $this->view('users/register',$data);

            echo 'load form';
        }
    }

    public function login(){

        echo 'login';
    }

    public function index(){
        echo '404';
    }

}