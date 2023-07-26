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
    protected $usuario;
    protected $idUser;

    public function __construct($email = "", $documento = "", $pass = "", $passEncrypt = "", $usuario = "", $idUser = ""){
        
        $this->documento = $documento;
        $this->pass = $pass;
        $this->email = $email;
        $this->passEncrypt = $passEncrypt;
        $this->usuario = $usuario;
        $this->idUser = $idUser;

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
            $this->usuario=$dataSesion[0]["usuario"];
            $this->idUser=$dataSesion[0]["id"];
            $this->decryptPass();

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function iniciarSesion($pass){
        try {
            
            if ($this->pass!=$pass){
                throw new Exception("La contraseña no coincide");
            }
    
            $_SESSION["documento"]=$this->documento;
            $_SESSION["pass"]=$this->passEncrypt;
            $_SESSION["user"]=$this->usuario;
            $_SESSION["idUser"]=$this->idUser;
            echo json_encode(["home"]);

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
        
    }

}



