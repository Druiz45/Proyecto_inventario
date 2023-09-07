<?php

namespace App\Http\Models;
use config\Conexion;
use PDO;
use Exception;

class cajaModel{

    protected $fechaActual;

    public function __construct() {
        
        $this->fechaActual = date('Y-m-d');

    }


    public function getCajaPedidos(){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {
            $idPerfil=$_SESSION["idPerfil"];

            $select = $con->prepare("CALL getCajaPedidos(?)");
            $select->bindParam(1, $idPerfil, PDO::PARAM_INT);

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

    public function getCajaIngresos(){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {
            $idPerfil=$_SESSION["idPerfil"];

            $select = $con->prepare("CALL getCajaIngresos(?)");
            $select->bindParam(1, $idPerfil, PDO::PARAM_INT);

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

}