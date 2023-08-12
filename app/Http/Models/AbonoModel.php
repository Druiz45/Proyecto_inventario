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

        $vendedor=$this->getDataVendedor();

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

    public function getDataVendedor(){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {
            $select = $con->prepare("CALL getVendedor(?)");
            $select->bindParam(1, $this->pedido, PDO::PARAM_INT);
            $select->execute();

            $dataVendedor=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select || !$select->rowCount() > 0){
                throw new Exception("error");
            }

            return $dataVendedor[0]["id"];

        } catch (Exception $e) {
            return ["error"];
            die;
        }
    }

}