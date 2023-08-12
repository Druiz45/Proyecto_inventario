<?php

namespace App\Http\Models;
use config\Conexion;
use PDO;
use Exception;

class AbonoModel{

    protected $abono;
    protected $pedido;

    public function __construct($abono = "", $pedido = "",){
        $this->abono = $abono;
        $this->pedido = $pedido;
    }

    public function createAbono(){
        $pdo = new Conexion();
        $con = $pdo->conexion();
        
        $this->abono = str_replace(['.','$'],"",$this->abono);

        $vendedor=$_SESSION["idUser"];

        try {
            $insert = $con->prepare("CALL createAbono(?,?,?)");
            $insert->bindParam(1, $this->abono, PDO::PARAM_INT);
            $insert->bindParam(2, $this->pedido, PDO::PARAM_INT);
            $insert->bindParam(3, $vendedor, PDO::PARAM_INT);
            $insert->execute();

            $insert->closeCursor();

            if(!$insert || !$insert->rowCount() > 0){
                throw new Exception("error");
            }

            echo json_encode("exito");

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function getAbonos($pedido){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {
            $select = $con->prepare("CALL getAbonos(?)");
            $select->bindParam(1, $pedido, PDO::PARAM_INT);
            $select->execute();

            $abonos=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select || !$select->rowCount() > 0){
                throw new Exception("error");
            }

            return $abonos;

        } catch (Exception $e) {
            return [];
            die;
        }
    }

}