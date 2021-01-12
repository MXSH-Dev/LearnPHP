<?php

// App core class
// Creates URL & loads core controller
// URL FORMAT - /controller/method/params

class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
        // print_r($this->getUrl());
        $url = $this->getUrl();

        // look for controllers handle first value
        // ucwords captalize first letter
        if(isset($url[0])){
          if(file_exists('../app/controllers/'. ucwords($url[0]).'.php')){
            // if exists set as controller
            $this->currentController = ucwords($url[0]);
            // unset 0 index
            unset($url[0]);
          }
        }

        // Require the controller
        require_once('../app/controllers/'.$this->currentController.'.php');

        // instiate controller class
        $this->currentController = new $this->currentController();

        // check for second part of url
        if(isset($url[1])){
          // check to see if method exists in controller
          if(method_exists($this->currentController,$url[1])){
            $this->currentMethod = $url[1];
            unset($url[1]);
          }
        }

        // echo $this->currentMethod;
        $this->params = $url ? array_values($url):[];

        // call a call back with array of params
        call_user_func_array([$this->currentController,$this->currentMethod],$this->params);
    }

    public function getUrl(){
        if(isset($_GET['url'])){
          // trim right end '/'
          $url= rtrim($_GET['url'],'/');
          $url= filter_var($url,FILTER_SANITIZE_URL);
          $url = explode('/',$url);
          return $url;
        }
    }
}