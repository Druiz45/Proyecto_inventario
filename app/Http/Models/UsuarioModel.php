<?php

namespace App\Http\Models;

use config\Conexion;
use Exception;
use PDO;
use \SendGrid\Mail\Mail;

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
    protected $newPass; 
    protected $newPassConfirm; 
    protected $passActual;
    protected $nombreEmpresa;
    protected $nitEmpresa;

    public function __construct($nombres = "", $apellidos = "", $documento = "",  $email = "", $celular = "",
    $direccion = "", $perfil = "", $pass = "", $nombreEmpresa = null, $nitEmpresa = null,
    /*$newPass = "", $newPassConfirm = "", $passActual = "",*/){

        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->documento = $documento;
        $this->perfil = $perfil;
        $this->email = $email;
        $this->celular = $celular;
        $this->direccion = $direccion;
        $this->pass = $pass;
        $this->nombreEmpresa = $nombreEmpresa;
        $this->nitEmpresa = $nitEmpresa;
        // $this->newPass = $newPass;
        // $this->newPassConfirm = $newPassConfirm; 
        // $this->passActual = $passActual;

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

            if(isset($_POST['nombre-empresa']) && isset($_POST['nit-empresa'])){
                if(!trim($this->nombreEmpresa) || !trim($this->nitEmpresa)){
                    throw new Exception("Porfavor complete todos los campos");
                }
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

            $insert = $con->prepare("CALL createUser(?,?,?,?,?,?,?,?,?,?)");
            $insert->bindParam(1, $this->documento, PDO::PARAM_STR);
            $insert->bindParam(2, $this->perfil, PDO::PARAM_INT);
            $insert->bindParam(3, $this->nombres, PDO::PARAM_STR);
            $insert->bindParam(4, $this->apellidos, PDO::PARAM_STR);
            $insert->bindParam(5, $this->email, PDO::PARAM_STR);
            $insert->bindParam(6, $this->celular, PDO::PARAM_STR);
            $insert->bindParam(7, $this->direccion, PDO::PARAM_STR);
            $insert->bindParam(8, $this->pass, PDO::PARAM_STR);
            $insert->bindParam(9, $this->nombreEmpresa, PDO::PARAM_STR);
            $insert->bindParam(10, $this->nitEmpresa, PDO::PARAM_STR);
            $insert->execute();

            $insert->closeCursor();

            if (!$insert || !$insert->rowCount() > 0) {

                throw new Exception("ERROR AL REGISTAR EL USUARIO");
            }

            echo json_encode("Usuario registrado exitosamente!");
        } catch (Exception $e) {
            if ($e->getCode() == 23000) {
                echo "Error: El valor ya existe en la base de datos.";
            }else{
                echo json_encode($e->getMessage());
            }
        }

        // echo json_encode($registros);

    }

    public function getUsers(){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        $idUser = $_SESSION["idUser"];
        $idPerfil = $_SESSION['idPerfil'];
        try {
            $select = $con->prepare("CALL getUsers(?,?)");
            $select->bindParam(1, $idPerfil, PDO::PARAM_INT);
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
            die;
        }
    }


    public function actualizarEstadoUser($userToUpdate, $estado){

        try {

            $pdo = new Conexion();
            $con = $pdo->conexion();

            // $idUser = $_SESSION['idUser'];
            $idPerfil = $_SESSION['idPerfil'];
            $state = $estado == "deshabilitar" ? 0 : 1;
            $message = $estado == "deshabilitar" ? "deshabilito" : "habilito";

            $errorMessage = $estado == "deshabilitar" ? "deshabilitado" : "habilitado";

            $update = $con->prepare("CALL updateEstadoUser(?,?,?)");
            $update->bindParam(1, $userToUpdate, PDO::PARAM_INT);
            $update->bindParam(2, $state, PDO::PARAM_INT);
            $update->bindParam(3, $idPerfil, PDO::PARAM_INT);
            $update->execute();

            $update->closeCursor();

            if (!$update) {
                throw new Exception("Ha ocurrido un error al intentar $estado");
            }

            if (!$update->rowCount() > 0) {
                throw new Exception("No se $errorMessage usuarios");
            }

            echo json_encode("El usuario se $message correctamente");
            
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
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
                throw new Exception("Error");
            }

            echo json_encode($registros);
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
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

    public function updatePass(){
        try {

            $pdo = new Conexion();
            $con = $pdo->conexion();

            $idUser = $_SESSION['idUser'];
            $this->pass=$this->newPass;
            $this->encryptPass();

            $update = $con->prepare("CALL updatePass(?,?)");
            $update->bindParam(1, $idUser, PDO::PARAM_INT);
            $update->bindParam(2, $this->pass, PDO::PARAM_STR);
            $update->execute();

            $update->closeCursor();

            if (!$update || !$update->rowCount() > 0) {
                throw new Exception("Error");
            }

            echo json_encode(["Contraseña actualizada", "success"]);
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function validateNewPass(){
        try {

            if (!trim($this->newPass) || !trim($this->newPassConfirm) || !trim($this->passActual)){
                throw new Exception("Completa los campos");
            }

            $this->decryptPass();

            if ($this->passActual!=$this->pass) {
                throw new Exception("La contraseña actual no corresponde");
            }

            if ($this->newPass!=$this->newPassConfirm) {
                throw new Exception("La contraseña de confirmacion es distintan");
            }

            $patron = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#.$($)$-$_])[A-Za-z\d$@$!%*?&#.$($)$-$_]{8,15}$/';

            if (!preg_match($patron, $this->newPass)) {
                throw new Exception("La nueva contraseña debe contener de 10 a 15 caracteres, al menos una letra mayúscula y una minuscula, un caracter especial, un numero y ningun espacio en blanco.");
            }

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function validateRecoverPass($email){
        try {
            if ( !trim($email) ) {

                throw new Exception("Porfavor ingrese un email");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                throw new Exception("Este email no es valido");
            }
    
            if (strlen($email) > 100) {
                throw new Exception("El correo electrónico supera los 100 caracteres permitidos.");
            }

            $pdo = new Conexion();
            $con = $pdo->conexion();

            $select = $con->prepare("CALL getDataUserRecoverPass(?)");
            $select->bindParam(1, $email, PDO::PARAM_STR);
            $select->execute();

            $dataUser = $select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if (!$select) {
                throw new Exception("Ha ocurrido un error");
            }

            if (!$select->rowCount() > 0) {
                throw new Exception("Este correo no se en cuentra registrado en nuestra base de datos");
            }

            if($dataUser[0]['estado'] != 1){
                throw new Exception("El usuario al que pertenece este correo esta deshabilitado");
            }

            return $dataUser;

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function getIdUserEncryp(UsuarioModel $user, array $dataUser){
        $user->pass=$dataUser[0]['id'];
        $user->documento = $dataUser[0]['documento'];
        $user->encryptPass();
        return $user->pass;
        // echo json_encode($user->pass);
    }

    public function getTokenPass(array $dataUser){
        return $dataUser[0]['uId'];
        // echo json_encode($user->pass);
    }

    public function recoverPass($correo, $idUser, $token){

        $urlLocal = getUrl($_SERVER['SERVER_NAME']);

        $url = ($urlLocal == 'inventario/public') ? "http://{$_SERVER['SERVER_NAME']}/$urlLocal/password/change/?user=$idUser&token=$token":
                                                    "https://{$_SERVER['SERVER_NAME']}/$urlLocal/password/change/?user=$idUser&token=$token";

        $email = new Mail();
        $email->setFrom("sisas@comunisoft.com", "Makfrio");
        $email->setSubject("Recuperacion de contraseña");
        $email->addTo("pruebascorreode484@gmail.com", "Correo De");
        $email->addContent("text/plain", "Esto es una prueba para el software de inventario de Makfrio");
        $email->addContent(
            "text/html", "<strong>Porfavor ingrese al siguiente enlace para restablecer su contraseña: <a href='$url'>Cambiar contraseña</a> </strong>"
        );
        // $sendgrid = new \SendGrid(getenv('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'));
        $sendgrid = new \SendGrid('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');
        try {
            // $response = $sendgrid->send($email);
            // echo "<pre>";
            // print $response->statusCode() . "\n";
            // print_r($response->headers());
            // print $response->body() . "\n";
            // echo "<pre>";
            $response = $sendgrid->send($email);
            $statusCode = $response->statusCode();
            $headers = $response->headers();
            $body = $response->body();
    
            // Preparar una respuesta en formato JSON
            $responseData = [
                'statusCode' => $statusCode,
                'headers' => $headers,
                'body' => $body
            ];
    
            // Establecer el encabezado de respuesta como JSON
            // header('Content-Type: application/json');
    
            // Enviar la respuesta JSON al cliente
            echo json_encode($responseData['statusCode']);
        } catch (Exception $e) {
            echo json_encode('Caught exception: '.  $e->getMessage(). "\n");
        }
        
    }
}
