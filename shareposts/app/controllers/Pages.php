<?php

class Pages extends Controller {
    public function __construct(){
        // echo "Pages loaded \n";
        // $this->postModel = $this->model('Post');

    }
    
    public function index(){
        // $posts = $this->postModel->getPosts();
        $data = [
            'title'=>'welcome to shareposts',
            'description' => 'Simple social network built on the Core MVC Framework'
        ];
        $this->view('pages/index',$data);
    }

    public function about(){
        $data = [
            'title'=>'About',
            'description' => 'App to share posts with other users'
        ];
        $this->view('pages/about',$data);
    }
}