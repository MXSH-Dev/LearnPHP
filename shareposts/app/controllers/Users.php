<?php
class Users extends Controller
{

  public function __construct()
  {
    $this->userModel = $this->model('User');
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
        // hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        if ($this->userModel->register($data)) {
          flashMessage('register_success', 'You are register and can log in now!');
          redirect('users/login');
        } else {
          die('failed to register user');
        };
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
        $loggedInUser = $this->userModel->login($data['email'], $data['password']);
        if ($loggedInUser) {
          $this->createUserSession($loggedInUser);
        } else {
          $data['password_err'] = 'Password incorrect';
          $this->view('users/login', $data);
        }
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

  public function logout()
  {
    unset($_SESSION['user_id']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    session_destroy();
    redirect("/users/login");
  }

  public function index()
  {
    echo '404';
  }

  public function createUserSession($user)
  {
    $_SESSION['user_id'] = $user->id;
    $_SESSION['user_email'] = $user->email;
    $_SESSION['user_name'] = $user->name;
    redirect('pages/index');
  }

  public function isUserLoggedIn()
  {
    if (isset($_SESSION['user_id'])) {
      return true;
    } else {
      return false;
    }
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
    } else {
      if ($this->userModel->findUserByEmail($inputData['email']) == true) {
        $inputData['email_err'] = 'Email already taken';
      }
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
    } elseif (!$this->userModel->findUserByEmail($inputData['email'])) {
      $inputData['email_err'] = 'No user found';
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
