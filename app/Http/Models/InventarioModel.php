<?php

namespace App\Http\Models;
use config\Conexion;
use PDO;
use Exception;

class InventarioModel{

    protected $producto;
    protected $stock;

    public function __construct($stock = "", $producto = ""){
        $this->producto = $producto;
        $this->stock = $stock;
    }
    
    public function validateData(){

        $pattern = "/^[0-9]{1,4}+$/";
        if( !preg_match($pattern, trim($this->producto)) ){
            throw new Exception("El producto es invalido");
        }
        if( !preg_match($pattern, trim($this->stock)) ){
            throw new Exception("El stock ingresado es invalido");
        }

    }

    public function create(){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {
            $insert = $con->prepare("CALL createInventario(?,?)");
            $insert->bindParam(1, $this->producto, PDO::PARAM_INT);
            $insert->bindParam(2, $this->stock, PDO::PARAM_INT);
            $insert->execute();

            $insert->closeCursor();

            if(!$insert || !$insert->rowCount() > 0){
                throw new Exception("error");
            }

        } catch (Exception $e) {
            echo json_encode("error");
            die;
        }
    }

    public function updateEstateInventario(){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {
            $idPerfil=$_SESSION["idPerfil"];

            $update = $con->prepare("CALL updateEstateInventario(?,?)");
            $update->bindParam(1, $idPerfil, PDO::PARAM_INT);
            $update->bindParam(2, $this->producto, PDO::PARAM_INT);
            $update->execute();

            $update->closeCursor();

            if(!$update || !$update->rowCount() > 0){
                throw new Exception("error");
            }

            echo json_encode("exito");

        } catch (Exception $e) {
            echo json_encode("error");
            die;
        }
    }

    public function getInventario(){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {

            $idPefil=$_SESSION["idPerfil"];

            $select = $con->prepare("CALL getInventario(?)");
            $select->bindParam(1, $idPefil, PDO::PARAM_INT);
            $select->execute();

            $inventario=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select || !$select->rowCount() > 0){
                throw new Exception("error");
            }
            
            return $inventario;

        } catch (Exception $e) {
            return [];
            die;
        }
    }

    public function updateStock(){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {

            $update = $con->prepare("CALL updateStock(?)");
            $update->bindParam(1, $this->producto, PDO::PARAM_INT);
            $update->execute();

            // $inventario=$select->fetchAll(PDO::FETCH_ASSOC);

            $update->closeCursor();

            if(!$update || !$update->rowCount() > 0){
                throw new Exception("error");
            }

            echo json_encode("exito");

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }

    }

}