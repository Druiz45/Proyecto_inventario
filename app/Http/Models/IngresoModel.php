<?php

namespace App\Http\Models;
use config\Conexion;
use PDO;
use Exception;

class IngresoModel{

    protected $valorIngreso;
    protected $tipoIngreso;
    protected $descripcion;

    public function __construct($valorIngreso="", $tipoIngreso="", $descripcion=""){
        $this->valorIngreso = $valorIngreso;
        $this->tipoIngreso = $tipoIngreso;
        $this->descripcion = $descripcion;
    }

    public function validateData(){

        try {
                        
            if(!trim($this->valorIngreso) || !trim($this->tipoIngreso) || !trim($this->descripcion)){

                throw new Exception("Porfavor complete todos los campos");

            }

            $pattern = "/^[0-9]{1,2}+$/";

            if( !preg_match($pattern, trim($this->tipoIngreso)) ){

                throw new Exception("El tipo de ingreso seleccionado no es valido");

            }

            $this->valorIngreso = str_replace(['.','$'],"",$this->valorIngreso);

            $pattern = "/^[0-9]{2,8}+$/";

            if( !preg_match($pattern, trim($this->valorIngreso)) ){

                throw new Exception("El valor del ingreso no es valido");

            }

            $pattern = "/^.{0,100}+$/";

            if( !preg_match($pattern, trim($this->descripcion)) ){

                throw new Exception("La descripcion puede contener un maximo de 100 carasteres");

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
            $select = $con->prepare("CALL getTiposIngreso(?)");
            $select->bindParam(1, $idPerfil, PDO::PARAM_INT);
            $select->execute();

            $ingresos=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select){
                throw new Exception("error");
            }

            if(!$select->rowCount() > 0){
                throw new Exception("No se encontraron resultados");
            }

            echo json_encode($ingresos);

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function getInfoFormUpdate($idIngreso){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        $idPerfil=$_SESSION["idPerfil"];

        try {
            $select = $con->prepare("CALL getIngresoToUpdate(?,?)");
            $select->bindParam(1, $idIngreso, PDO::PARAM_INT);
            $select->bindParam(2, $idPerfil, PDO::PARAM_INT);
            $select->execute();

            $ingreso=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select){
                throw new Exception("error");
            }

            if(!$select->rowCount() > 0){
                throw new Exception("No se encontraron resultados");
            }

            echo json_encode($ingreso);

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
                header("Location: /" . getUrl($_SERVER['SERVER_NAME']) . "/ingreso/consultar");
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

    public function getIngresos(){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        $idPerfil=$_SESSION["idPerfil"];
        $rango = $this->validateDate();

        try {
            $select = $con->prepare("CALL getIngresos(?,?,?)");
            $select->bindParam(1, $idPerfil, PDO::PARAM_INT);
            $select->bindParam(2, $rango['fechaInicio'], PDO::PARAM_STR);
            $select->bindParam(3, $rango['fechaFinal'], PDO::PARAM_STR);
            $select->execute();

            $ingresos=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select){
                throw new Exception("error");
            }

            // if(!$select->rowCount() > 0){
            //     throw new Exception("No se encontraron resultados");
            // }

            return $ingresos;

        } catch (Exception $e) {
            return $e->getMessage();
            die;
        }

    }

    public function createIngreso(){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        $idUser=$_SESSION["idUser"];

        try {
            $insert = $con->prepare("CALL createIngreso(?,?,?,?)");
            $insert->bindParam(1, $idUser, PDO::PARAM_INT);
            $insert->bindParam(2, $this->tipoIngreso, PDO::PARAM_INT);
            $insert->bindParam(3, $this->valorIngreso, PDO::PARAM_INT);
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