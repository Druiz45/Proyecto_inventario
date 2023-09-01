<?php

namespace App\Http\Models;
use config\Conexion;
use PDO;
use Exception;

class carteraModel {

    public function __construct(){
       
    }

   public function getCartera(){
        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {
            $idPerfil=$_SESSION["idPerfil"];

            $select = $con->prepare("CALL getCartera(?)");
            $select->bindParam(1, $idPerfil, PDO::PARAM_INT);

            $select->execute();

            $pedidos=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select){
                throw new Exception("Error");
            }

            return $pedidos;

        } catch (Exception $e) {
            return $e->getMessage();
            die;
        }
   }

}