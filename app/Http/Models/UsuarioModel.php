<?php

namespace App\Http\Models;

use config\Conexion;
use Exception;
use PDO;

class UsuarioModel
{

    protected $nombres;
    protected $apellidos;
    protected $documento;
    protected $perfil;
    protected $email;
    protected $celular;
    protected $direccion;
    protected $pass;
    // protected $confirmPass;

    public function __construct($nombres = "", $apellidos = "", $documento = "",  $perfil = "",  $email = "", $celular = "", $direccion = "",){

        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->documento = $documento;
        $this->perfil = $perfil;
        $this->email = $email;
        $this->celular = $celular;
        $this->direccion = $direccion;
        $this->pass = $documento;
        // $this->confirmPass = $confirmPass;

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

    public function validateData(){
        try {

            if (
                !trim($this->nombres) || !trim($this->apellidos) || !trim($this->documento) || !trim($this->perfil)
                || !trim($this->email) || !trim($this->celular) || !trim($this->direccion)
            ) {

                throw new Exception("Porfavor complete todos los campos");
            }

            $pattern = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,50}+$/";

            if (!preg_match($pattern, trim($this->nombres))) {

                throw new Exception("Los nombres deben de contener minimo 3 y maximo 50 caracteres, no se permiten numeros o caracteres especiales");
            }

            if (!preg_match($pattern, trim($this->apellidos))) {

                throw new Exception("Los apellidos deben de contener minimo 3 y maximo 50 caracteres, no se permiten numeros o caracteres especiales");
            }

            $pattern = "/^[0-9]{6,12}+$/";

            if (!preg_match($pattern, trim($this->documento))) {

                throw new Exception("Los documento deben de contener solo numeros, un minimo de 6 y maximo 12");
            }

            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {

                throw new Exception("Este correo no es valido");
            }

            if (strlen($this->email) > 100) {
                throw new Exception("El correo electrónico supera los 100 caracteres permitidos.");
            }

            $pattern = "/^[0-9]{10,10}+$/";

            if (!preg_match($pattern, trim($this->celular))) {

                throw new Exception("El teléfono contiene caracteres no numéricos");
            }

            $pattern = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ#\s0-9-]{1,100}+$/";

            if (!preg_match($pattern, trim($this->direccion))) {

                throw new Exception("La direccion contine caracteres no permitidos");
            }

            $pattern = "/^[0-9]{1,1}+$/";

            if (!preg_match($pattern, trim($this->perfil))) {

                throw new Exception("El perfil seleccionado para este usuario no es valido");
            }
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
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

            if (!$insert || !$insert->rowCount() > 0) {

                throw new Exception("ERROR AL REGISTAR EL USUARIO");
            }

            echo json_encode("Usuario registrado exitosamente!");
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }

        // echo json_encode($registros);

    }

    public function getUsers(){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        $idUser = $_SESSION["idUser"];
        try {
            $param = 3;
            $select = $con->prepare("CALL getUsers(?,?)");
            $select->bindParam(1, $param, PDO::PARAM_INT);
            $select->bindParam(2, $idUser, PDO::PARAM_INT);
            $select->execute();

            $usuarios = $select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if (!$select) {

                throw new Exception("Error al consultar los usuarios");
            }
            return ($usuarios);
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }


    public function updateUser(){

        try {

            $pdo = new Conexion();
            $con = $pdo->conexion();

            $idUser = $_SESSION['idUser'];

            $update = $con->prepare("CALL updateUser(?,?,?,?,?,?,?)");
            $update->bindParam(1, $idUser, PDO::PARAM_INT);
            $update->bindParam(2, $this->documento, PDO::PARAM_STR);
            $update->bindParam(3, $this->nombres, PDO::PARAM_STR);
            $update->bindParam(4, $this->apellidos, PDO::PARAM_STR);
            $update->bindParam(5, $this->email, PDO::PARAM_STR);
            $update->bindParam(6, $this->celular, PDO::PARAM_STR);
            $update->bindParam(7, $this->direccion, PDO::PARAM_STR);
            $update->execute();

            $update->closeCursor();

            if (!$update) {
                throw new Exception("Ha ocurrido un error al intentar actualizar");
            }

            if (!$update->rowCount() > 0) {
                throw new Exception("No se han realizado cambios");
            }

            $_SESSION['user'] = $this->nombres;

            echo json_encode("Sus datos se han actualizado corretamente!");
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
        }
    }

    public function getDataUserLog(){

        try {

            $pdo = new Conexion();
            $con = $pdo->conexion();

            $idUser = $_SESSION['idUser'];

            $select = $con->prepare("CALL getDataUserLog(?)");
            $select->bindParam(1, $idUser, PDO::PARAM_INT);
            $select->execute();

            $registros = $select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if (!$select || !$select->rowCount() > 0) {
                throw new Exception("Eror");
            }

            echo json_encode($registros);
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
        }
    }

    public function decryptPass() {
        $key = hex2bin($this->getStrPar()); //Llave de encriptacion
        $cipher = 'aes-256-gcm';
        $decoded = base64_decode($this->pass); //Cadena a desencriptar
        $nonceSize = openssl_cipher_iv_length($cipher);
        $nonce = mb_substr($decoded, 0, $nonceSize, '8bit');
        $ciphertextWithTag = mb_substr($decoded, $nonceSize, null, '8bit');
        $ciphertext = mb_substr($ciphertextWithTag, 0, -16, '8bit');
        $tag = mb_substr($ciphertextWithTag, -16, null, '8bit');
        $plaintext = openssl_decrypt(
            $ciphertext,
            $cipher,
            $key,
            OPENSSL_RAW_DATA,
            $nonce,
            $tag
        );
        $this->pass = $plaintext;
    }


    public function encryptPass(){
        $key = hex2bin($this->getStrPar()); //Llave de encriptacion
        $cipher = 'aes-256-gcm'; 
        $tag = null; 
        $nonceSize = openssl_cipher_iv_length($cipher);
        $nonce = openssl_random_pseudo_bytes($nonceSize);
        $ciphertext = openssl_encrypt(
            $this->pass, //Cadena a encriptar
            $cipher,
            $key,
            OPENSSL_RAW_DATA,
            $nonce,
            $tag
        );
        $this->pass = base64_encode($nonce . $ciphertext . $tag);
    }

    public function logOut(){
        session_start();
        session_destroy();
        echo json_encode("./");
    }

    public function getStrPar(){
        if (strlen($this->documento) % 2 != 0) {
            $strPar = $this->documento . "a";
        } else {
            $strPar = $this->documento . "ab";
        }
        return $strPar;
    }
}
