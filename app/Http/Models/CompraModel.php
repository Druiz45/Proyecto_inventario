<?php

namespace App\Http\Models;
use config\Conexion;
use PDO;
use Exception;

class CompraModel{

    protected $documento;
    protected $nombreProducto;

    public function __construct($documento = "", $nombreProducto = ""){
        $this->documento = $documento;
        $this->nombreProducto = $nombreProducto;
    }

    public function getInfoFormCreate() {

        try {

            if(!trim($this->documento) || !trim($this->nombreProducto)){
                throw new Exception("No hay resultados");
            }

            if ($this->documento!="vacio"){
                echo json_encode($this->getProvedoresForDoc());
            }
            elseif ($this->nombreProducto!="vacio") {
                echo json_encode($this->getUserForProduct());
            }

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }

   }

   public function getUserForProduct(){
    $pdo = new Conexion();
    $con = $pdo->conexion();
    
    try {
        $select = $con->prepare("CALL getProductForName(?)");
        $select->bindParam(1, $this->nombreProducto, PDO::PARAM_STR);
        $select->execute();

        $products=$select->fetchAll(PDO::FETCH_ASSOC);

        $select->closeCursor();

        if(!$select || !$select->rowCount() > 0){
            throw new Exception("No se encontraron productos");
        }

        return ($products);

    } catch (Exception $e) {
        return ($e->getMessage());
        die;
    }
}

    public function getProvedoresForDoc(){

        $pdo = new Conexion();
        $con = $pdo->conexion();
        
        try {
            $select = $con->prepare("CALL getProvedoresForDoc(?)");
            $select->bindParam(1, $this->documento, PDO::PARAM_STR);
            $select->execute();

            $provedores=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select || !$select->rowCount() > 0){
                throw new Exception("No se encontraron provedores");
            }

            return ($provedores);

        } catch (Exception $e) {
            return ($e->getMessage());
            die;
        }

    }

}