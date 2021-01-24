<?php

class Posts extends Controller
{
  public function __construct()
  {
    if (!isUserLoggedIn()) {
      redirect('users/login');
    }

    $this->postModel = $this->model('Post');
    $this->userModel = $this->model('User');
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
          // print_r($_SESSION);
          redirect('posts');
        } else {
          flashMessage('post_message', 'Failed to add post, something went wrong', "alert alert-danger");
          $this->view('posts/add', $data);
        }
      } else {
        $this->view('posts/add', $data);
      }
    } else {
      $data = [
        'title' => '',
        'body' => '',
        'user_id' => $_SESSION['user_id'],
        'title_err' => '',
        'body_err' => '',
      ];

      $this->view('posts/add', $data);
    }
  }

  public function edit($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // sanitize POST array

      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'id' => $id,
        'title' => trim($_POST['title']),
        'body' => trim($_POST['body']),
        'user_id' => $_SESSION['user_id'],
        'title_err' => '',
        'body_err' => '',
      ];
      $validPost = false;

      [$validPost, $data] = $this->validatePostData($data);
      if ($validPost) {
        if ($this->postModel->updatePost($data)) {
          flashMessage('post_message', 'Post Edited');
          // print_r($_SESSION);
          redirect('posts');
        } else {
          flashMessage('post_message', 'Failed to add post, something went wrong', "alert alert-danger");
          $this->view('posts/edit', $data);
        }
      } else {
        $this->view('posts/edit', $data);
      }
    } else {
      // get existing post from model
      $post = $this->postModel->getPostById($id);

      // check for the owner
      if ($post->user_id != $_SESSION['user_id']) {
        redirect('posts');
      }
      $data = [
        'id' => $id,
        'title' => $post->title,
        'body' => $post->body,
      ];

      $this->view('posts/edit', $data);
    }
  }

  public function show($id)
  {
    $post = $this->postModel->getPostById($id);
    $user = $this->userModel->getUserById($post->user_id);
    $data = [
      'post' => $post,
      'user' => $user
    ];
    $this->view('posts/show', $data);
  }

  public function delete($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $post = $this->postModel->getPostById($id);
      if ($post->user_id != $_SESSION['user_id']) {
        redirect('posts');
      }
      if ($this->postModel->deletePost($id)) {
        flashMessage('post_message', 'Post Deleted');
        redirect('posts');
      } else {
        flashMessage('post_message', 'Error occurred trying to delete', '"alert alert-danger"');
        redirect('posts');
      }
    }
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
