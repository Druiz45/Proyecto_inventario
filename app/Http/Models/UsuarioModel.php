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

            echo json_encode("Usuario registrado exitosamente!");

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }

        // echo json_encode($registros);

    }

    public function decrypt($message,$encryption_key){
        $key = hex2bin($encryption_key);
        $message = base64_decode($message);
        $nonceSize = openssl_cipher_iv_length('aes-256-ctr');
        $nonce = mb_substr($message, 0, $nonceSize, '8bit');
        $ciphertext = mb_substr($message, $nonceSize, null, '8bit');
        $plaintext= openssl_decrypt(
          $ciphertext,
          'aes-256-ctr',
          $key,
          OPENSSL_RAW_DATA,
          $nonce
        );
        return $plaintext;
    }

    public function encrypt(){
        $key = hex2bin($this->getStrPar());
        $nonceSize = openssl_cipher_iv_length('aes-256-ctr');
        $nonce = openssl_random_pseudo_bytes($nonceSize);
        $ciphertext = openssl_encrypt(
          $this->pass,
          'aes-256-ctr',
          $key,
          OPENSSL_RAW_DATA,
          $nonce
          );
        $this->pass=base64_encode($nonce.$ciphertext);
    }

    public function getStrPar() {
        if (strlen($this->documento)%2 == 0) {
          $strPar = $this->documento."*";
        }
        else {
            $strPar = $this->documento."**";
        }
      return $strPar;
    }

    public function validateData(){
        try {
            
            if( !trim($this->nombres) ){

                throw new Exception("Porfavor complete todos los campos");

            }

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

}