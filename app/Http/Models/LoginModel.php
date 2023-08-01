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
    protected $idPerfil;
    protected $ultimoLog;
    protected $fechaCreacion;
    protected $getPass;

    public function __construct($email = "", $getPass = "", $documento = "", $pass = "", $passEncrypt = "", $usuario = "",
    $idUser = "", $idPerfil = "", $ultimoLog = "", $fechaCreacion = ""){
        
        $this->documento = $documento;
        $this->pass = $pass;
        $this->email = $email;
        $this->passEncrypt = $passEncrypt;
        $this->usuario = $usuario;
        $this->idUser = $idUser;
        $this->idPerfil = $idPerfil;
        $this->ultimoLog = $ultimoLog;
        $this->fechaCreacion = $fechaCreacion;
        $this->getPass = $getPass;

    }

    public function getDataSesion(){

        try {

            if(!trim($this->email) && !trim($this->getPass)){

                throw new Exception("Porfavor Complete los campos");

            }

            $pdo = new Conexion();
            $con = $pdo->conexion();
            
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
            $this->idPerfil=$dataSesion[0]["idPerfil"];
            $this->ultimoLog=$dataSesion[0]['ultimo_log'];
            $this->fechaCreacion=$dataSesion[0]['fecha_creacion'];
            $this->decryptPass();

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function setUltimoLog(){
    
        try {
        
            $pdo = new Conexion();
            $con = $pdo->conexion();
            
            $update = $con->prepare("CALL setUltimoLog(?)");
            $update->bindParam(1, $this->idUser, PDO::PARAM_STR);
            $update->execute();

            $update->closeCursor();

            if(!$update){

                throw new Exception("No se pudo actualizar la sesion");

            }

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function iniciarSesion(){
        
        try {
            
            if ($this->pass != $this->getPass){
                throw new Exception("La contraseña no coincide");
            }
    
            $_SESSION["documento"] = $this->documento;
            $_SESSION["pass"] = $this->passEncrypt;
            $_SESSION["user"] = $this->usuario;
            $_SESSION["idUser"] = $this->idUser;
            $_SESSION["idPerfil"] = $this->idPerfil;
            $_SESSION['ultimoLog'] = $this->ultimoLog;
            $_SESSION['fechaCreacion'] = $this->fechaCreacion;

            $this->setUltimoLog();

            echo json_encode(["home"]);

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
        
    }

}



