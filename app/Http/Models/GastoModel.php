<?php

namespace App\Http\Models;
use config\Conexion;
use PDO;
use Exception;

class GastoModel{

    protected $valorGasto;
    protected $tipoGasto;
    protected $descripcion;

    public function __construct($valorGasto="", $tipoGasto="", $descripcion=""){
        $this->valorGasto = $valorGasto;
        $this->tipoGasto = $tipoGasto;
        $this->descripcion = $descripcion;
    }

    public function getInfoFormCreate(){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        $idPerfil=$_SESSION["idPerfil"];

        try {
            $select = $con->prepare("CALL getGastos(?)");
            $select->bindParam(1, $idPerfil, PDO::PARAM_INT);
            $select->execute();

            $gastos=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select){
                throw new Exception("error");
            }

            if(!$select->rowCount() > 0){
                throw new Exception("No se encontraron resultados");
            }

            echo json_encode($gastos);

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function createGasto(){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        $idUser=$_SESSION["idUser"];

        try {
            $insert = $con->prepare("CALL createGasto(?,?,?,?)");
            $insert->bindParam(1, $idUser, PDO::PARAM_INT);
            $insert->bindParam(2, $this->tipoGasto, PDO::PARAM_INT);
            $insert->bindParam(3, $this->valorGasto, PDO::PARAM_INT);
            $insert->bindParam(4, $this->descripcion, PDO::PARAM_STR);
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

}