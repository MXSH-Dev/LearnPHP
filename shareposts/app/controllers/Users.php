<?php
class Users extends Controller
{

    public function __construct()
    {
    }

    public function register()
    {
        // check for POST
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // process register

            // sanitize POST Data 
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // init data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];
            $validInput = false;

            [$validInput, $data] = $this->validteRegister($data);

            if ($validInput == false) {
                $this->view('users/register', $data);
            } else {
                echo 'register success';
            }

            // print_r($data);
        } else {
            // init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];
            // load view
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        // check for POST
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // process login

            // sanitize POST Data 
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
            ];
            $validInput = false;

            [$validInput, $data] = $this->validteLogin($data);

            if ($validInput == false) {
                $this->view('users/login', $data);
            } else {
                echo 'login success';
            }
        } else {
            // init data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];
            // load view
            $this->view('users/login', $data);
        }
    }

    public function index()
    {
        echo '404';
    }

    private function validteRegister($inputData)
    {
        // valdiate name
        if (empty($inputData['name'])) {
            $inputData['name_err'] = 'Please enter name';
        }
        // validate email
        if (empty($inputData['email'])) {
            $inputData['email_err'] = 'Please enter email';
        }
        // validate password
        if (empty($inputData['password'])) {
            $inputData['password_err'] = 'Please enter password';
        } elseif (strlen($inputData['password']) < 6) {
            $inputData['password_err'] = 'Password need to be 6 chars or longer';
        }

        // validate confirm password
        if (empty($inputData['confirm_password'])) {
            $inputData['confirm_password_err'] = 'Please confirm password';
        } elseif ($inputData['password'] != $inputData['confirm_password']) {
            $inputData['confirm_password_err'] = 'Passwords does not match';
        }

        if (
            empty($inputData['name_err']) &&
            empty($inputData['email_err']) &&
            empty($inputData['password_err']) &&
            empty($inputData['confirm_password_err'])
        ) {
            return [true, $inputData];
        } else {
            return [false, $inputData];
        }
    }

    private function validteLogin($inputData)
    {
        // validate email
        if (empty($inputData['email'])) {
            $inputData['email_err'] = 'Please enter email';
        }
        // validate password
        if (empty($inputData['password'])) {
            $inputData['password_err'] = 'Please enter password';
        } elseif (strlen($inputData['password']) < 6) {
            $inputData['password_err'] = 'Password need to be 6 chars or longer';
        }

        if (
            empty($inputData['email_err']) &&
            empty($inputData['password_err'])
        ) {
            return [true, $inputData];
        } else {
            return [false, $inputData];
        }
    }
}
