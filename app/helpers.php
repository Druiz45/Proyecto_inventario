<?php

use App\Http\Response;

if(!function_exists('view')){

    function view($view){
        return new Response($view);
    }

}

if(!function_exists('viewPath')){

    function viewPath($view){
        return __DIR__ . "./../views/$view.php";
    }

}

if(!function_exists('setTitle')){

    function setTitle(){

        $title = "";

        $uri = explode('/', $_SERVER['REQUEST_URI']);

        // echo"<pre>";
        //     var_dump($this->segments);
        // echo"</pre>";

        if( $uri[1] == "inventario"){

            $url_local = $uri;

            array_splice($url_local, 0, 2);

        }else{
            
            $url_local = $uri;

            array_splice($url_local, 0, 1);
            
        }
    
            array_values($url_local);

            $uri = $url_local;

            $posiciones = count($uri);

            if( $posiciones == 2 && empty($uri[1]) ){
                $title = "Inicio de sesion";
            }elseif( $posiciones == 2 && !empty($uri[1]) ){
                $title = $uri[1];
            }elseif($posiciones == 3){
                $title = $uri[2]." ".$uri[1];
            }

        return $title;
    }

}


if(!function_exists('getUrl')){

    function getUrl($url){
        if ($url == "localhost" || $url == "127.0.0.1"){
            return "inventario/public";
        }
        else {
            return "public/";
        }
    }

}