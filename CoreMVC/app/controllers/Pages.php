<?php

class Pages {
    public function __construct()
    {
        // echo "Pages loaded \n";
    }
    
    public function index(){
        
    }

    public function about($id){
        echo "This is about with id = $id";
    }
}