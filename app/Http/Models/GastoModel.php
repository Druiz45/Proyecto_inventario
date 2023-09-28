<?php

namespace App\Http\Models;
use config\Conexion;
use PDO;
use Exception;

class GastoModel{

    protected $valorGasto;
    protected $tipoGasto;
    protected $descripcion;
    protected $banco;

    public function __construct($valorGasto="", $tipoGasto="", $descripcion="", $banco=""){
        $this->valorGasto = $valorGasto;
        $this->tipoGasto = $tipoGasto;
        $this->descripcion = $descripcion;
        $this->banco = $banco;
    }

    public function validateData(){

        try {
                        
            if(!trim($this->valorGasto) || !trim($this->tipoGasto) || !trim($this->descripcion)){

                throw new Exception("Porfavor complete todos los campos");

            }

            $pattern = "/^[0-9]{1,2}+$/";

            if( !preg_match($pattern, trim($this->tipoGasto)) ){

                throw new Exception("El tipo de gasto seleccionado no es valido");

            }

            $this->valorGasto = str_replace(['.','$'],"",$this->valorGasto);

            $pattern = "/^[0-9]{2,8}+$/";

            if( !preg_match($pattern, trim($this->valorGasto)) ){

                throw new Exception("El valor del gasto no es valido");

            }

            $pattern = "/^.{0,100}+$/";

            if( !preg_match($pattern, trim($this->descripcion)) ){

                throw new Exception("La descripcion puede contener un maximo de 100 carasteres");

            }
            
            $pattern = "/^.{0,20}+$/";

            if (!preg_match($pattern, trim($this->banco))) {
                throw new Exception("El nombre del banco no debe superar 20 caracteres.");
            }

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }

    }

    public function getInfoFormCreate(){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        $idPerfil=$_SESSION["idPerfil"];

        try {
            $select = $con->prepare("CALL getTiposGasto(?)");
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

    public function getInfoFormUpdate($idGasto){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        $idPerfil=$_SESSION["idPerfil"];

        try {
            $select = $con->prepare("CALL getGastoToUpdate(?,?)");
            $select->bindParam(1, $idPerfil, PDO::PARAM_INT);
            $select->bindParam(2, $idGasto, PDO::PARAM_INT);
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

    public function validateDate(): array
    {

        date_default_timezone_set('America/Bogota');

        $fechaActual = date('Y-m-d');

        if ((isset($_GET['startDate']) && trim($_GET['startDate'])) && (isset($_GET['finalDate']) && $_GET['finalDate'])) {

            if (!strtotime($_GET['startDate']) || !strtotime($_GET['finalDate'])) {
                header("Location: /" . getUrl($_SERVER['SERVER_NAME']) . "/compra/consultar");
            }

            return [
                'fechaInicio' => $_GET['startDate'],
                'fechaFinal' => $_GET['finalDate'],
            ];
        } else {
            return [
                'fechaInicio' => $fechaActual,
                'fechaFinal' => $fechaActual,
            ];
        }
    }

    public function getGastos(){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        $idPerfil=$_SESSION["idPerfil"];

        $rango = $this->validateDate();

        try {
            $select = $con->prepare("CALL getGastos(?,?,?)");
            $select->bindParam(1, $idPerfil, PDO::PARAM_INT);
            $select->bindParam(2, $rango['fechaInicio'], PDO::PARAM_STR);
            $select->bindParam(3, $rango['fechaFinal'], PDO::PARAM_STR);
            $select->execute();

            $gastos=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select){
                throw new Exception("error");
            }

            // if(!$select->rowCount() > 0){
            //     throw new Exception("No se encontraron resultados");
            // }

            return $gastos;

        } catch (Exception $e) {
            return $e->getMessage();
            die;
        }

    }

    public function createGasto(){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        $idUser=$_SESSION["idUser"];

        try {
            $insert = $con->prepare("CALL createGasto(?,?,?,?,?)");
            $insert->bindParam(1, $idUser, PDO::PARAM_INT);
            $insert->bindParam(2, $this->tipoGasto, PDO::PARAM_INT);
            $insert->bindParam(3, $this->valorGasto, PDO::PARAM_INT);
            $insert->bindParam(4, $this->descripcion, PDO::PARAM_STR);
            $insert->bindParam(5, $this->banco, PDO::PARAM_INT);
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

    public function updateGasto($idGasto){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        $idPerfil=$_SESSION["idPerfil"];

        try {
            $insert = $con->prepare("CALL updateGasto(?,?,?,?,?,?)");
            $insert->bindParam(1, $this->tipoGasto, PDO::PARAM_INT);
            $insert->bindParam(2, $this->valorGasto, PDO::PARAM_INT);
            $insert->bindParam(3, $this->descripcion, PDO::PARAM_STR);
            $insert->bindParam(4, $idGasto, PDO::PARAM_INT);
            $insert->bindParam(5, $idPerfil, PDO::PARAM_INT);
            $insert->bindParam(6, $this->banco, PDO::PARAM_INT);
            $insert->execute();

            $insert->closeCursor();

            if(!$insert){
                throw new Exception("error");
            }

            if(!$insert->rowCount() > 0){
                throw new Exception("No se han realizado cambios");
            }

            echo json_encode("exito");

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

}