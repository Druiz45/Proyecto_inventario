<?php

namespace App\Http\Models;
use config\Conexion;
use PDO;

class HomeModel{

    public function dataUser(){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        $param = 1;

        $select = $con->prepare("CALL selectUsuarios(?)");
        $select->bindParam(1, $param, PDO::PARAM_INT);
        $select->execute();

        $registros = $select->fetchAll(PDO::FETCH_ASSOC);

        $select->closeCursor();

        echo json_encode($registros);

    }

}