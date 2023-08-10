<?php

namespace App\Http\Models;
use config\Conexion;
use PDO;
use Exception;

class PedidoModel{

    protected $documento;
    protected $nombreProducto;
    protected $cliente;
    protected $producto;
    protected $abono;
    protected $anotacion;
    protected $fechaLimite;

    public function __construct($documento="", $nombreProducto="", $cliente="", $producto="", $abono="", $anotacion="", $fechaLimite=""){
        $this->documento=$documento;
        $this->nombreProducto=$nombreProducto;
        $this->cliente = $cliente;
        $this->producto = $producto;
        $this->abono = $abono;
        $this->anotacion = $anotacion;
        $this->fechaLimite = $fechaLimite;
    }

    public function validateData(){

        try {

            // if( !trim($this->documento) || !trim($this->nombreProducto) ){

            //     throw new Exception("Porfavor complete todos los campos");

            // }

            // $pattern = "/^[0-9]{6,12}+$/";

            // if( !preg_match($pattern, trim($this->documento)) ){

            //     throw new Exception("Los documentos deben de contener solo numeros, un minimo de 6 y maximo 12");

            // }

            $pattern = "/^[0-9]{1,5}+$/";

            if( !preg_match($pattern, trim($this->cliente)) ){

                throw new Exception("Porfavor revise el cliente seleccionado");

            }

            $pattern = "/^[0-9]{1,4}+$/";

            if( !preg_match($pattern, trim($this->producto)) ){

                throw new Exception("Porfavor revise el producto seleccionado");

            }

            $this->abono = str_replace(['.','$'],"",$this->abono);

            $pattern = "/^[0-9]{1,8}+$/";

            if( !preg_match($pattern, trim($this->abono)) ){

                throw new Exception("El valor del abono no es valido");

            }

            $timeStamp = strtotime($this->fechaLimite);

            if(!$timeStamp){
                throw new Exception("La fecha no es valida");
            }

            $fecha_convertida = date('Y-m-d', $timeStamp);

            if($fecha_convertida != $this->fechaLimite){

                throw new Exception("La fecha no es valida");

            }

            $pattern = "/^.{0,100}+$/";

            if( !preg_match($pattern, trim($this->anotacion)) ){

                throw new Exception("La anotacion puede contener un maximo de 100 carasteres");

            }

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }

    }

    public function savePedido(){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        $precio = $this->getDataProducto();
        $vendedor = $_SESSION['idUser'];
        
        try {
            $insert = $con->prepare("CALL createPedido(?,?,?,?,?,?,?)");
            $insert->bindParam(1, $this->producto, PDO::PARAM_INT);
            $insert->bindParam(2, $this->cliente, PDO::PARAM_INT);
            $insert->bindParam(3, $vendedor, PDO::PARAM_INT);
            $insert->bindParam(4, $precio, PDO::PARAM_INT);
            $insert->bindParam(5, $this->abono, PDO::PARAM_INT);
            $insert->bindParam(6, $this->anotacion, PDO::PARAM_STR);
            $insert->bindParam(7, $this->fechaLimite, PDO::PARAM_STR);
            $insert->execute();

            $insert->closeCursor();

            if(!$insert || !$insert->rowCount() > 0){

                throw new Exception("Error al registrar el pedido");

            }

            echo json_encode("Pedido registrado con exito!");

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function updatePedido($idPedido){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        $precio = $this->getDataProducto();
        
        try {
            $update = $con->prepare("CALL updatePedido(?,?,?,?,?,?)");
            $update->bindParam(1, $this->producto, PDO::PARAM_INT);
            $update->bindParam(2, $this->cliente, PDO::PARAM_INT);
            $update->bindParam(3, $precio, PDO::PARAM_INT);
            $update->bindParam(4, $this->anotacion, PDO::PARAM_STR);
            $update->bindParam(5, $this->fechaLimite, PDO::PARAM_STR);
            $update->bindParam(6, $idPedido, PDO::PARAM_INT);
            $update->execute();

            $update->closeCursor();

            if(!$update){
                throw new Exception("Error al actualizar el pedido");
            }

            if(!$update->rowCount() > 0){
                throw new Exception("No se hicieron cambios");
            }

            echo json_encode("Pedido actualizado con exito!");

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function getDataProducto(){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        
        try {
            $select = $con->prepare("CALL getDataProducto(?)");
            $select->bindParam(1, $this->producto, PDO::PARAM_INT);
            $select->execute();

            $row = $select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select || !$select->rowCount() > 0){

                throw new Exception("No se encontro el producto");

            }

            return $row[0]['precio'];

        } catch (Exception $e) {
                return [];
            die;
        }
    }

   public function getInfoFormCreate() {

        try {

            if(!trim($this->documento) || !trim($this->nombreProducto)){
                throw new Exception("No hay resultados");
            }

            if ($this->documento!="vacio"){
                echo json_encode($this->getClienteForDoc());
            }
            elseif ($this->nombreProducto!="vacio") {
                echo json_encode($this->getProductForCoincidencia());
            }

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }

   }

   public function getClienteForDoc(){
        $pdo = new Conexion();
        $con = $pdo->conexion();
        
        try {
            $select = $con->prepare("CALL getClienteForDoc(?)");
            $select->bindParam(1, $this->documento, PDO::PARAM_STR);
            $select->execute();

            $clientes=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select || !$select->rowCount() > 0){
                throw new Exception("No se encontraron clientes");
            }

            return $clientes;

        } catch (Exception $e) {
            return $e->getMessage();
            die;
        }
   }

   public function getProductForCoincidencia(){
        $pdo = new Conexion();
        $con = $pdo->conexion();
        
        try {
            $select = $con->prepare("CALL getProductForCoincidencia(?)");
            $select->bindParam(1, $this->nombreProducto, PDO::PARAM_STR);
            $select->execute();

            $products=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select || !$select->rowCount() > 0){
                throw new Exception("No se encontraron productos");
            }

            return $products;

        } catch (Exception $e) {
            return $e->getMessage();
            die;
        }
   }

   public function getPedidos(){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {
            $idUser=$_SESSION["idUser"];
            $idPerfil=$_SESSION["idPerfil"];

            if ($idPerfil==1){
                $select = $con->prepare("CALL getPedidosVendedor(?,?)");
                $select->bindParam(1, $idUser, PDO::PARAM_INT);
                $select->bindParam(2, $idPerfil, PDO::PARAM_INT);
            }
            else if ($idPerfil==3){
                $select = $con->prepare("CALL getPedidos(?)");
                $select->bindParam(1, $idPerfil, PDO::PARAM_INT);
            }

            $select->execute();

            $pedidos=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select){
                throw new Exception("Error");
            }

            return $pedidos;

        } catch (Exception $e) {
            return $e->getMessage();
            die;
        }
   }

   public function getPedido($idPedido){
    $pdo = new Conexion();
    $con = $pdo->conexion();

    try {
        $idPerfil=$_SESSION["idPerfil"];

        $select = $con->prepare("CALL getPedido(?,?)");
        $select->bindParam(1, $idPedido, PDO::PARAM_INT);
        $select->bindParam(2, $idPerfil, PDO::PARAM_INT);
        $select->execute();

        $pedido=$select->fetchAll(PDO::FETCH_ASSOC);

        $select->closeCursor();

        if(!$select){
            throw new Exception("Error");
        }

        echo json_encode($pedido);

    } catch (Exception $e) {
        echo json_encode($e->getMessage());
        die;
    }
}

}