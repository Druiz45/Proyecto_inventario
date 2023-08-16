<?php

namespace App\Http\Models;

use config\Conexion;
use Exception;
use PDO;

class CategoriaModel{

    public function getCategorias(){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        $param = 1;

        $select = $con->prepare("CALL getCategorias(?)");
        $select->bindParam(1, $param, PDO::PARAM_INT);
        $select->execute();

        $categorias = $select->fetchAll(PDO::FETCH_ASSOC);

        $select->closeCursor();

        return $categorias;
    }

}
