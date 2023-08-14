<?php

namespace App\Http\Models;
use config\Conexion;
use PDO;
use Exception;

class InventarioModel{

    protected $producto;
    protected $stock;

    public function __construct($producto = "", $stock = ""){
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

}