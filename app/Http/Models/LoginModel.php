<?php

namespace App\Http\Models;
use config\Conexion;
use Exception;
use PDO;

class LoginModel extends UsuarioModel {

    protected $documento;
    protected $pass;
    protected $email;
    protected $passEncrypt;

    public function __construct($email = "", $documento = "", $pass = "", $passEncrypt = ""){
        
        $this->documento = $documento;
        $this->pass = $pass;
        $this->email = $email;
        $this->passEncrypt = $passEncrypt;

    }

    public function getDataSesion(){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {
            
            $select = $con->prepare("CALL getDataSesion(?)");
            $select->bindParam(1, $this->email, PDO::PARAM_STR);
            $select->execute();
    
            $dataSesion=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select || !$select->rowCount() > 0){

                throw new Exception("El usuario no existe");

            }

            $this->documento=$dataSesion[0]["documento"];
            $this->passEncrypt=$dataSesion[0]["clave"];
            $this->pass=$dataSesion[0]["clave"];
            $this->decrypt();

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function iniciarSesion($pass){
        session_start();
        try {
            
            if ($this->pass!=$pass){
                throw new Exception("La contraseña no coincide");
            }
    
            $_SESSION["documento"]=$this->documento;
            $_SESSION["pass"]=$this->passEncrypt;
            echo json_encode("home");

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
        
    }

}



