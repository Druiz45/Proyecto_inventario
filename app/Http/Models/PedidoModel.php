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

    public function __construct($documento, $nombreProducto, $cliente = "", $producto = "", $abono = "", $anotacion = ""){
        $this->documento=$documento;
        $this->nombreProducto=$nombreProducto;
        $this->cliente = $cliente;
        $this->producto = $producto;
        $this->abono = $abono;
        $this->anotacion = $anotacion;
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

            $pattern = "/^.{1,100}+$/";

            if( !preg_match($pattern, trim($this->anotacion)) ){

                throw new Exception("La descripcion puede contener un maximo de 100 carasteres");

            }

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
        }

    }

    public function saveProducto(){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        $vendedor = $_SESSION['idUser'];
        
        try {
            $insert = $con->prepare("CALL createPedido(?,?,?)");
            $insert->bindParam(1, $this->producto, PDO::PARAM_INT);
            $insert->bindParam(2, $this->cliente, PDO::PARAM_INT);
            $insert->bindParam(3, $vendedor, PDO::PARAM_INT);
            $insert->execute();

            $insert->closeCursor();

            if(!$insert || !$insert->rowCount() > 0){

                throw new Exception("Error al registrar producto");

            }

            echo json_encode(["Producto registrado", "success"]);

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
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
                echo json_encode($this->getUserForProduct());
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

   public function getUserForProduct(){
        $pdo = new Conexion();
        $con = $pdo->conexion();
        
        try {
            $select = $con->prepare("CALL getProductForName(?)");
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

}