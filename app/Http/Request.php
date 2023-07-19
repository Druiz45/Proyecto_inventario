<?php

namespace App\Http;

use Exception;

class Request{

    protected $segments = [];
    protected $controller;
    protected $method;

    public function __construct(){

        $this->segments = explode('/', $_SERVER['REQUEST_URI']);

        // echo"<pre>";
        //     var_dump($this->segments);
        // echo"</pre>";

        if( $this->segments[1] == "inventario"){

            $url_local = $this->segments;

            array_splice($url_local, 0, 2);

        }else{
            
            $url_local = $this->segments;

            array_splice($url_local, 0, 1);
            
        }

            // array_splice($url_local, 1, 1);
            // unset($url_local[count($url_local)-1]);
    
            array_values($url_local);

            $this->segments = $url_local;

        // echo"<pre>";
        //     var_dump($this->segments);
        // echo"</pre>";

        $this->setController();
        $this->setMethod();
        
    }

    public function setController(){
        $this->controller = empty($this->segments[1]) ? 'index' : $this->segments[1];
    }

    public function setMethod(){
        $this->method = empty($this->segments[2]) ? 'index' : $this->segments[2];
    }

    public function getController(){
        $controller = ucfirst($this->controller);

        return "App\Http\Controllers\\{$controller}Controller";
    }

    public function getMethod(){
        return $this->method;
    }

    public function send(){
        $controller = $this->getController();
        $method = $this->getMethod();

        $reponse = call_user_func([
            new $controller,
            $method
        ]);

        // $reponse->send();

        try{

            if(!$reponse instanceof Response){
                throw new Exception('No se ha encontrado el recurso');
            }

            $reponse->send();

        }catch(Exception $e){
            echo $e->getMessage();
            die;
        }
    }

}