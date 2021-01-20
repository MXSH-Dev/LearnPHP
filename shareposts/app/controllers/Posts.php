<?php

class Posts extends Controller
{
  public function __construct()
  {
    if (!isUserLoggedIn()) {
      redirect('users/login');
    }

    $this->postModel = $this->model('Post');
  }

  public function index()
  {
    $posts = $this->postModel->getPosts();

    $data = [
      'posts' => $posts
    ];

    $this->view('posts/index', $data);
  }

  public function add()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // sanitize POST array

      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'title' => trim($_POST['title']),
        'body' => trim($_POST['body']),
        'user_id' => $_SESSION['user_id'],
        'title_err' => '',
        'body_err' => '',
      ];
      $validPost = false;

      [$validPost, $data] = $this->validatePostData($data);

      if ($validPost) {
        if ($this->postModel->addPost($data)) {
          flashMessage('post_message', 'Post Added');
          $this->index();
        } else {
          flashMessage('post_message', 'Failed to add post, something went wrong', "alert alert-danger");
          $this->view('posts/add', $data);
        }
      } else {
        $this->view('posts/add', $data);
      }
    }

    $data = [
      'title' => '',
      'body' => '',
      'user_id' => $_SESSION['user_id'],
      'title_err' => '',
      'body_err' => '',
    ];

    $this->view('posts/add', $data);
  }

  private function validatePostData($postData)
  {

    if (empty($postData['title'])) {
      $postData['title_err'] = "Please enter title";
    }

    if (empty($postData['body'])) {
      $postData['body_err'] = "Please enter body text";
    }

    if (empty($postData['title_err']) && empty($postData['body_err'])) {
      return [true, $postData];
    } else {
      return [false, $postData];
    }
  }
}
