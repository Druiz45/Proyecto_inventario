<?php

namespace App\Http\Models;
use config\Conexion;
use PDO;
use Exception;

class BancoModel{

    protected $banco;

    public function __construct($banco = ""){
        $this->banco = $banco;
    }

    public function validateData(){
        try {

            if($this->banco==""){
                throw new Exception("Complete el campo");
            }

            $pattern = "/^.{0,20}+$/";

            if (!preg_match($pattern, trim($this->banco))) {
                throw new Exception("El nombre del Banco no debe superar los 20 caracteres.");
            }
            
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function getBancos(){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        $n=1;

        try {
            $select = $con->prepare("CALL getBancos(?)");
            $select->bindParam(1, $n, PDO::PARAM_INT);
            $select->execute();

            $bancos=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select){
                throw new Exception("error");
            }

            if(!$select->rowCount() > 0){
                throw new Exception("No se encontraron resultados");
            }

            return ($bancos);

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }

    }

    public function createBanco(){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {
            $insert = $con->prepare("CALL createBanco(?)");
            $insert->bindParam(1, $this->banco, PDO::PARAM_STR);
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

    public function updateBanco($idbanco){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {
            $update = $con->prepare("CALL updateBanco(?,?)");
            $update->bindParam(1, $this->banco, PDO::PARAM_STR);
            $update->bindParam(2, $idbanco, PDO::PARAM_INT);
            $update->execute();

            $update->closeCursor();

            if(!$update || !$update->rowCount() > 0){
                throw new Exception("error");
            }

            echo json_encode("exito");

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }

    }

    public function updateEstate($idBanco, $estado){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        $estate=($estado=="Deshabilitar" ? 0 : 1);

        try {
            $update = $con->prepare("CALL updateEstadoBanco(?,?)");
            $update->bindParam(1, $estate, PDO::PARAM_INT);
            $update->bindParam(2, $idBanco, PDO::PARAM_INT);
            $update->execute();

            $update->closeCursor();

            if(!$update){
                throw new Exception("error");
            }

            if(!$update->rowCount() > 0){
                throw new Exception("No se hicieron cambios");
            }

            echo json_encode("exito");

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }

    }

}