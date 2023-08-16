<?php

namespace App\Http\Models;
use config\Conexion;
use PDO;
use Exception;

class CompraModel{

    protected $documento;
    protected $nombreProducto;
    protected $proveedor;
    protected $producto;
    protected $valorProducto;
    protected $abonoProducto;
    protected $fechaLimite;
    protected $anotacion;

    public function __construct($documento = "", $nombreProducto = "", $proveedor = "", $producto = "",
    $valorProducto = "", $abonoProducto = "", $fechaLimite = "", $anotacion = ""){
        $this->documento = $documento;
        $this->nombreProducto = $nombreProducto;
        $this->proveedor = $proveedor;
        $this->producto = $producto;
        $this->valorProducto = $valorProducto;
        $this->abonoProducto = $abonoProducto;
        $this->fechaLimite = $fechaLimite;
        $this->anotacion = $anotacion;
    }

    public function getInfoFormCreate() {

        try {

            if(!trim($this->documento) || !trim($this->nombreProducto)){
                throw new Exception("No hay resultados");
            }

            if ($this->documento!="vacio"){
                echo json_encode($this->getProvedoresForDoc());
            }
            elseif ($this->nombreProducto!="vacio") {
                echo json_encode($this->getUserForProduct());
            }

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }

   }

   public function getUserForProduct(){
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

        return ($products);

    } catch (Exception $e) {
        return ($e->getMessage());
        die;
    }
}

    public function getProvedoresForDoc(){
        $pdo = new Conexion();
        $con = $pdo->conexion();
        
        try {
            $select = $con->prepare("CALL getProvedoresForDoc(?)");
            $select->bindParam(1, $this->documento, PDO::PARAM_STR);
            $select->execute();

            $provedores=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select || !$select->rowCount() > 0){
                throw new Exception("No se encontraron provedores");
            }

            return ($provedores);

        } catch (Exception $e) {
            return ($e->getMessage());
            die;
        }

    }

    public function updateCompra(){
        $pdo = new Conexion();
        $con = $pdo->conexion();
        
        try {
            $update = $con->prepare("CALL updateCompra(?,?,?,?,?)");
            $update->bindParam(1, $this->proveedor, PDO::PARAM_INT);
            $update->bindParam(2, $this->producto, PDO::PARAM_INT);
            $update->bindParam(3, $this->valorProducto, PDO::PARAM_INT);
            $update->bindParam(4, $this->anotacion, PDO::PARAM_STR);
            $update->bindParam(5, $this->fechaLimite, PDO::PARAM_STR);
            $update->execute();

            $update->closeCursor();

            if(!$update){
                throw new Exception("error");
            }

            if(!$update->rowCount() > 0){
                throw new Exception("No se hicieron cambios");
            }

            echo json_encode("exito");

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function getCompra($compra){
        $pdo = new Conexion();
        $con = $pdo->conexion();
        
        try {
            $select = $con->prepare("CALL getCompra(?)");
            $select->bindParam(1, $compra, PDO::PARAM_STR);
            $select->execute();

            $compra=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select || !$select->rowCount() > 0){
                throw new Exception("No encontrado");
            }

            echo json_encode($compra);

        } catch (Exception $e) {
            json_encode($e->getMessage());
            die;
        }
    }

    public function validateDataCompra(){
        try {

            if($this->proveedor=="vacio" || $this->producto=="vacio" || $this->valorProducto=="vacio" ||
            $this->abonoProducto=="vacio" ||  $this->fechaLimite=="vacio" || $this->anotacion=="vacio"){

                throw new Exception("Porfavor complete los campos");

            }

            $pattern = "/^[0-9]{1,5}+$/";

            if( !preg_match($pattern, trim($this->proveedor)) ){

                throw new Exception("Porfavor revise el proveedor seleccionado");

            }

            $pattern = "/^[0-9]{1,4}+$/";

            if( !preg_match($pattern, trim($this->producto)) ){

                throw new Exception("Porfavor revise el producto seleccionado");

            }

            $this->abonoProducto = str_replace(['.','$'],"",$this->abonoProducto);

            $pattern = "/^[0-9]{1,8}+$/";

            if( !preg_match($pattern, trim($this->abonoProducto)) ){

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

            $this->valorProducto = str_replace(['.','$'],"",$this->valorProducto);

            $pattern = "/^[0-9]{1,8}+$/";

            if( !preg_match($pattern, trim($this->valorProducto)) ){

                throw new Exception("El valor del producto no es valido");

            }

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function saveCompra(){
        $pdo = new Conexion();
        $con = $pdo->conexion();
        
        $idUser=$_SESSION["idUser"];

        try {
            $insert = $con->prepare("CALL createCompra(?,?,?,?,?,?,?)");
            $insert->bindParam(1, $idUser, PDO::PARAM_INT);
            $insert->bindParam(2, $this->proveedor, PDO::PARAM_INT);
            $insert->bindParam(3, $this->producto, PDO::PARAM_INT);
            $insert->bindParam(4, $this->valorProducto, PDO::PARAM_INT);
            $insert->bindParam(5, $this->abonoProducto, PDO::PARAM_INT);
            $insert->bindParam(6, $this->anotacion, PDO::PARAM_STR);
            $insert->bindParam(7, $this->fechaLimite, PDO::PARAM_STR);
            $insert->execute();

            $insert->closeCursor();

            if(!$insert || !$insert->rowCount() > 0){

                throw new Exception("Error");

            }

            echo json_encode(["Compra registrada con exito", "success"]);

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function getCompras(){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        $idUser=$_SESSION["idUser"];
        $idPerfil=$_SESSION["idPerfil"];

        try {
            if ($idPerfil==2 || $idPerfil==1) {
                $select = $con->prepare("CALL getComprasVP(?,?)");
                $select->bindParam(1, $idUser, PDO::PARAM_INT);
                $select->bindParam(2, $idPerfil, PDO::PARAM_INT);
            }
            else {
                $select = $con->prepare("CALL getCompras(?)");
                $select->bindParam(1, $idPerfil, PDO::PARAM_INT);
            }

            $select->execute();

            $compras=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select){
                throw new Exception("Error al consultar compras");
            }

           return $compras;

        } catch (Exception $e) {
            return ($e->getMessage());
            die;
        }
    }

}