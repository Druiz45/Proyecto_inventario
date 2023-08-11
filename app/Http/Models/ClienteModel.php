<?php

namespace App\Http\Models;

use config\Conexion;
use Exception;
use PDO;

class ClienteModel{

    protected $nombres;
    protected $apellidos;
    protected $documento;
    protected $email;
    protected $celular;
    protected $direccion;

    public function __construct($nombres = "", $apellidos = "", $documento = "", $email = "", $celular = "", $direccion = ""){

        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->documento = $documento;
        $this->email = $email;
        $this->celular = $celular;
        $this->direccion = $direccion;
        
    }

    public function createCliente(){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {

            $insert = $con->prepare("CALL createCliente(?,?,?,?,?,?)");
            $insert->bindParam(1, $this->documento, PDO::PARAM_STR);
            $insert->bindParam(2, $this->nombres, PDO::PARAM_STR);
            $insert->bindParam(3, $this->apellidos, PDO::PARAM_STR);
            $insert->bindParam(4, $this->email, PDO::PARAM_STR);
            $insert->bindParam(5, $this->celular, PDO::PARAM_STR);
            $insert->bindParam(6, $this->direccion, PDO::PARAM_STR);
            $insert->execute();

            $insert->closeCursor();

            if (!$insert || !$insert->rowCount() > 0) {

                throw new Exception("ERROR AL REGISTAR EL CLIENTE");
            }

            echo json_encode("Cliente registrado exitosamente!");
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }

    }

    public function validateData(){

        try {

            if (
                !trim($this->nombres) || !trim($this->apellidos) || !trim($this->documento)
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

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }

    }
    
}