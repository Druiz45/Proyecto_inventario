<?php

namespace App\Http\Models;

use config\Conexion;
use Exception;
use PDO;

class ComisionModel{

    protected $vendedor;
    protected $usuarioRegistrador;
    protected $valorComision;
    protected $pedido;

    public function __construct($vendedor="", $usuarioRegistrador="", $valorComision="", $pedido=""){
        
        $this->vendedor = $vendedor;
        $this->usuarioRegistrador = $usuarioRegistrador;
        $this->valorComision = $valorComision;
        $this->pedido = $pedido;

    }

    public function create(){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {

            $insert = $con->prepare("CALL createComision(?,?,?,?)");
            $insert->bindParam(1, $this->vendedor, PDO::PARAM_INT);
            $insert->bindParam(2, $this->usuarioRegistrador, PDO::PARAM_INT);
            $insert->bindParam(3, $this->valorComision, PDO::PARAM_INT);
            $insert->bindParam(4, $this->pedido, PDO::PARAM_INT);
            $insert->execute();

            $insert->closeCursor();

            if (!$insert || !$insert->rowCount() > 0) {

                throw new Exception("ERROR AL REGISTAR la comision");
            }

            // echo json_encode("");
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }

    }

    public function getComisiones(){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {

            $idPerfil=$_SESSION["idPerfil"];

            $select = $con->prepare("CALL getComisiones(?)");
            $select->bindParam(1, $idPerfil, PDO::PARAM_INT);
            $select->execute();

            $comisiones=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if (!$select || !$select->rowCount() > 0) {
                throw new Exception("No hay comisiones para mostrar");
            }

            return $comisiones;

        } catch (Exception $e) {
            return $e->getMessage();
            die;
        }
    }

}