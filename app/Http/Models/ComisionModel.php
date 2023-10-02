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
    protected $banco;

    public function __construct($vendedor="", $usuarioRegistrador="", $valorComision="", $pedido="", $banco=""){
        
        $this->vendedor = $vendedor;
        $this->usuarioRegistrador = $usuarioRegistrador;
        $this->valorComision = $valorComision;
        $this->pedido = $pedido;
        $this->banco = $banco;

    }

    public function validateDates(){
        
        try {

            if($this->banco==""){
                throw new Exception("Seleccione el banco");
            }

            $pattern = "/^[0-9]{1,6}+$/";

            if (!preg_match($pattern, trim($this->pedido))) {
                throw new Exception("Pedido invalido");
            }

            $pattern = "/^[0-9]{1,4}+$/";

            if (!preg_match($pattern, trim($this->vendedor))) {
                throw new Exception("Vendedor invalido");
            }

            $pattern = "/^[0-9]{1,7}+$/";

            if (!preg_match($pattern, trim($this->valorComision))) {
                throw new Exception("Comision invalida");
            }

            $pattern = "/^[0-9]{1,2}+$/";

            if (!preg_match($pattern, trim($this->banco))) {
                throw new Exception("Banco invalido");
            }

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function create(){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {

            $insert = $con->prepare("CALL createComision(?,?,?,?,?)");
            $insert->bindParam(1, $this->vendedor, PDO::PARAM_INT);
            $insert->bindParam(2, $this->usuarioRegistrador, PDO::PARAM_INT);
            $insert->bindParam(3, $this->valorComision, PDO::PARAM_INT);
            $insert->bindParam(4, $this->pedido, PDO::PARAM_INT);
            $insert->bindParam(5, $this->banco, PDO::PARAM_INT);
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

    public function validateDate(): array{

        date_default_timezone_set('America/Bogota');

        $fechaActual = date('Y-m-d');

        if( ( isset($_GET['startDate']) && trim($_GET['startDate']) ) 
             && (isset($_GET['finalDate']) && trim($_GET['finalDate'])) ){

            if(!strtotime($_GET['startDate']) || !strtotime($_GET['finalDate'])){
                header("Location: /".getUrl($_SERVER['SERVER_NAME'])."/comision/consultar");
            }

            return [

                'startDate' => $_GET['startDate'], 
                'finalDate' => $_GET['finalDate'],
                
            ];

        }else{

                return [
                'startDate' => $fechaActual, 
                'finalDate' => $fechaActual,
            ];

        }

    }

    public function getComisiones(){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {

            $idPerfil=$_SESSION["idPerfil"];

            $rango = $this->validateDate();

            $select = $con->prepare("CALL getComisiones(?,?,?)");
            $select->bindParam(1, $idPerfil, PDO::PARAM_INT);
            $select->bindParam(2, $rango['startDate'], PDO::PARAM_STR);
            $select->bindParam(3, $rango['finalDate'], PDO::PARAM_STR);
            $select->execute();

            $comisiones=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if (!$select || !$select->rowCount() > 0) {
                throw new Exception("No hay comisiones para mostrar");
            }

            return $comisiones;

        } catch (Exception $e) {
            // return $e->getMessage();
            return [];
            die;
        }
    }

}