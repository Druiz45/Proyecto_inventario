<?php

use App\Http\Response;
// use Carbon\Carbon;

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
            return "public";
        }
    }

}

if(!function_exists('getClass')){

    function getClass($class){

        $clase = explode('App\Http\Controllers\\', $class);

        return $clase[1];
    }

}

if(!function_exists('getFecha')){

    function getFecha($date){

        $hora = substr($date, 11, 2);

        $estadoDia = $hora >= 0 && $hora <= 11 ? 'a.m.':'p.m';

        date_default_timezone_set('America/Bogota');
        setlocale(LC_TIME, "spanish");

        // setlocale(LC_TIME, 'es_ES.UTF-8');
        $fechaObjeto = strtotime($date);
        $fechaFormateada = utf8_encode(strftime('%A %d de %B de %Y a las %I:%M %p', $fechaObjeto));
        
        return $fechaFormateada." ".$estadoDia;
    }

}

if(!function_exists('getFechaSinHora')){

    function getFechaSinHora($date){

        date_default_timezone_set('America/Bogota');
        setlocale(LC_TIME, "spanish");

        // setlocale(LC_TIME, 'es_ES.UTF-8');
        $fechaObjeto = strtotime($date);
        $fechaFormateada = utf8_encode(strftime('%A %d de %B de %Y', $fechaObjeto));
        
        return $fechaFormateada;
    }

}

if(!function_exists('validateLogin')){
    function validateLogin(){
        if (!isset($_SESSION["idUser"])){
            header("Location: /".getUrl($_SERVER['SERVER_NAME'])."");
            die;
        }

    }
}

if(!function_exists('validateLogOut')){
    function validateLogOut(){
        if (isset($_SESSION["idUser"])){
            header("Location: ./home");
            die;
        }
    }
}

if(!function_exists('numberFormat')){

    function numberFormat($numero){

        return "$".number_format($numero , 0, '.', '.');
    }

}

if(!function_exists('getEstadoComision')){

    function getEstadoComision($estadoComision){

        if($estadoComision == 0){
            $estado = "En espera";
            $fondo = "#B1B1B1";
        }else{
            $estado = "Pagada";
            $fondo = "#00A016";
        }

        $infoEstadoComision = [
            'estado' => $estado,
            'fondo' => $fondo,
        ];

        return $infoEstadoComision;

    }

}

if(!function_exists('getEstadoPedido')){

    function getEstadoPedido($estadoPedido){

        if($estadoPedido == 1){
            $estado = "En espera";
            $fondo = "#B1B1B1";
        }elseif($estadoPedido == 2){
            $estado = "Entregado";
            $fondo = "#00A016";
        }else{
            $estado = "Anulado";
            $fondo = "#ED0505";
        }

        $infoEstadoPedido = [
            'estado' => $estado,
            'fondo' => $fondo,
        ];

        return $infoEstadoPedido;

    }

}

if(!function_exists('getEstadoAprobacionPedido')){

    function getEstadoAprobacionPedido($estadoAprobacion){

        if($estadoAprobacion == 1){
            $estado = "En espera";
            $fondo = "#B1B1B1";
        }elseif($estadoAprobacion == 2){
            $estado = "Aprobado";
            $fondo = "#00A016";
        }else{
            $estado = "No aprobado";
            $fondo = "#ED0505";
        }

        $infoEstadoAprobacion = [
            'estado' => $estado,
            'fondo' => $fondo,
        ];

        return $infoEstadoAprobacion;

    }

}

if(!function_exists('getEstadoOrdenCompra')){

    function getEstadoOrdenCompra($estadoOrdenCompra){

        if($estadoOrdenCompra == 1){
            $estado = "Pendiente";
            $fondo = "#B1B1B1";
        }elseif($estadoOrdenCompra == 2){
            $estado = "Recibido";
            $fondo = "#00A016";
        }elseif($estadoOrdenCompra == 3){
            $estado = "Pagado";
            $fondo = "#DED700";
        }else{
            $estado = "Anulado";
            $fondo = "#ED0505";
        }

        $infoEstadoAprobacion = [
            'estado' => $estado,
            'fondo' => $fondo,
        ];

        return $infoEstadoAprobacion;

    }

}