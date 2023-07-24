<?php

namespace App\Http\Models;
use config\Conexion;
use Exception;
use PDO;

class UsuarioModel{

    protected $nombres;
    protected $apellidos;
    protected $documento;
    protected $perfil;
    protected $email;
    protected $celular;
    protected $direccion;
    protected $pass;
    protected $confirmPass;

    public function __construct($nombres = "", $apellidos = "", $documento = "", $perfil = "", $email = "", $celular = "", $direccion = "", $pass = "", $confirmPass = ""){
        
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->documento = $documento;
        $this->perfil = $perfil;
        $this->email = $email;
        $this->celular = $celular;
        $this->direccion = $direccion;
        $this->pass = $pass;
        $this->confirmPass = $confirmPass;

    }

    public function getPerfiles(){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        $param = 3;

        $select = $con->prepare("CALL getPerfiles(?)");
        $select->bindParam(1, $param, PDO::PARAM_INT);
        $select->execute();

        $registros = $select->fetchAll(PDO::FETCH_ASSOC);

        $select->closeCursor();

        echo json_encode($registros);

    }

    public function createUser(){
        
        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {
            
            $insert = $con->prepare("CALL createUser(?,?,?,?,?,?,?,?)");
            $insert->bindParam(1, $this->documento, PDO::PARAM_STR);
            $insert->bindParam(2, $this->perfil, PDO::PARAM_INT);
            $insert->bindParam(3, $this->nombres, PDO::PARAM_STR);
            $insert->bindParam(4, $this->apellidos, PDO::PARAM_STR);
            $insert->bindParam(5, $this->email, PDO::PARAM_STR);
            $insert->bindParam(6, $this->celular, PDO::PARAM_STR);
            $insert->bindParam(7, $this->direccion, PDO::PARAM_STR);
            $insert->bindParam(8, $this->pass, PDO::PARAM_STR);
            $insert->execute();
    
            $insert->closeCursor();

            if(!$insert || !$insert->rowCount() > 0){

                throw new Exception("ERROR AL REGISTAR EL USUARIO");

            }

            echo json_encode($_POST);

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }

        // echo json_encode($registros);

    }

}