<?php

namespace App\Http;

class Response{

    protected $view;

    public function __construct($view){
        $this->view = $view;
    }

    public function getView(){
        return $this->view;
    }

    public function send(){
        $view = $this->getView();

        // $content = file_get_contents(viewPath($view));

        $content = viewPath($view);

        // echo strip_tags(file_get_contents($content));

        if( empty(strip_tags(file_get_contents($content))) ){
            require_once $content;
        }else{
            require_once viewPath('layout');
        }

        // require_once __DIR__ . "./../../views/layout.php";
    }
    
}