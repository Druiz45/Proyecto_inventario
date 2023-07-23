<?php

namespace App\Http\Models;
use config\Conexion;
use PDO;

class RegistrarUserModel{

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

}