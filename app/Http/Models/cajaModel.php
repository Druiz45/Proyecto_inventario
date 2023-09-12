<?php

namespace App\Http\Models;
use config\Conexion;
use PDO;
use Exception;

class cajaModel{

    protected $fechaInicio;
    protected $fechaFinal;

    public function __construct($fechaInicio, $fechaFinal) {
        
        $this->fechaInicio = $fechaInicio;
        $this->fechaFinal = $fechaFinal;

    }

    public function validateDate(): cajaModel{

        date_default_timezone_set('America/Bogota');

        $fechaActual = date('Y-m-d');

        if( ( isset($_GET['startDate']) && trim($_GET['startDate']) ) && (isset($_GET['finalDate']) && $_GET['finalDate']) ){

            if(!strtotime($_GET['startDate']) || !strtotime($_GET['finalDate'])){
                header("Location: /".getUrl($_SERVER['SERVER_NAME'])."/caja/consultar");
            }

            return new cajaModel($_GET['startDate'], $_GET['finalDate']);

        }else{
            return new cajaModel($fechaActual, $fechaActual);
        }

    }


    public function getCajaPedidos(){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        $caja = $this->validateDate();

        try {
            $idPerfil=$_SESSION["idPerfil"];

            $select = $con->prepare("CALL getCajaPedidos(?,?,?)");
            $select->bindParam(1, $idPerfil, PDO::PARAM_INT);
            $select->bindParam(2, $caja->fechaInicio, PDO::PARAM_STR);
            $select->bindParam(3, $caja->fechaFinal, PDO::PARAM_STR);

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

        $caja = $this->validateDate();

        try {
            $idPerfil=$_SESSION["idPerfil"];

            $select = $con->prepare("CALL getCajaIngresos(?,?,?)");
            $select->bindParam(1, $idPerfil, PDO::PARAM_INT);
            $select->bindParam(2, $caja->fechaInicio, PDO::PARAM_STR);
            $select->bindParam(3, $caja->fechaFinal, PDO::PARAM_STR);

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

    public function getCajaGastos(){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        $caja = $this->validateDate();

        try {
            $idPerfil=$_SESSION["idPerfil"];

            $select = $con->prepare("CALL getCajaGastos(?,?,?)");
            $select->bindParam(1, $idPerfil, PDO::PARAM_INT);
            $select->bindParam(2, $caja->fechaInicio, PDO::PARAM_STR);
            $select->bindParam(3, $caja->fechaFinal, PDO::PARAM_STR);

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

    public function getResumenGastos(){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        $caja = $this->validateDate();

        try {
            $idPerfil=$_SESSION["idPerfil"];

            $select = $con->prepare("CALL resumenGastos(?,?,?)");
            $select->bindParam(1, $idPerfil, PDO::PARAM_INT);
            $select->bindParam(2, $caja->fechaInicio, PDO::PARAM_STR);
            $select->bindParam(3, $caja->fechaFinal, PDO::PARAM_STR);

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

    public function getOrdenesCompra(){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        $caja = $this->validateDate();

        try {
            $idPerfil=$_SESSION["idPerfil"];

            $select = $con->prepare("CALL getCajaOrdenesCompra(?,?,?)");
            $select->bindParam(1, $idPerfil, PDO::PARAM_INT);
            $select->bindParam(2, $caja->fechaInicio, PDO::PARAM_STR);
            $select->bindParam(3, $caja->fechaFinal, PDO::PARAM_STR);

            $select->execute();

            $abonos=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select){
                throw new Exception("Error");
            }

            return $abonos;

        } catch (Exception $e) {
            return $e->getMessage();
            die;
        }

    }

    public function getComisiones(){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        $caja = $this->validateDate();

        try {
            $idPerfil=$_SESSION["idPerfil"];

            $select = $con->prepare("CALL getCajaComisiones(?,?,?)");
            $select->bindParam(1, $idPerfil, PDO::PARAM_INT);
            $select->bindParam(2, $caja->fechaInicio, PDO::PARAM_STR);
            $select->bindParam(3, $caja->fechaFinal, PDO::PARAM_STR);

            $select->execute();

            $abonos=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select){
                throw new Exception("Error");
            }

            return $abonos;

        } catch (Exception $e) {
            return $e->getMessage();
            die;
        }

    }

}