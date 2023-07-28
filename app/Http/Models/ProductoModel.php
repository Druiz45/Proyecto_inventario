<?php

namespace App\Http\Models;
use config\Conexion;
use Exception;
use PDO;

class ProductoModel{

    protected $nombreProducto; 
    protected $idCategoria; 
    protected $descripcion;

    public function __construct($nombreProducto = "", $idCategoria = "", $descripcion = "",){
        
       $this->nombreProducto=$nombreProducto;
       $this->idCategoria=$idCategoria;
       $this->descripcion=$descripcion;

    }

    public function saveProducto(){
        $pdo = new Conexion();
        $con = $pdo->conexion();
        
        try {
            $insert = $con->prepare("CALL saveProducto(?,?,?)");
            $insert->bindParam(1, $this->nombreProducto, PDO::PARAM_STR);
            $insert->bindParam(2, $this->idCategoria, PDO::PARAM_INT);
            $insert->bindParam(3, $this->descripcion, PDO::PARAM_STR);
            $insert->execute();

            $insert->closeCursor();

            if(!$insert){

                throw new Exception("Error al registrar producto");

            }

            echo json_encode(["Producto registrado", "success"]);

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function getCategorias(){
        $pdo = new Conexion();
        $con = $pdo->conexion();
        $n=1;
        try {
            $select = $con->prepare("CALL getCategorias(?)");
            $select->bindParam(1, $n, PDO::PARAM_STR);
            $select->execute();

            $categorias=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select || !$select->rowCount() > 0){

                throw new Exception("Error al mostrar categorias");

            }

            echo json_encode($categorias);

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function getProductos(){
        $pdo = new Conexion();
        $con = $pdo->conexion();
        $n=1;
        try {
            $select = $con->prepare("CALL getProductos(?)");
            $select->bindParam(1, $n, PDO::PARAM_STR);
            $select->execute();

            $productos=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select || !$select->rowCount() > 0){

                throw new Exception("Error al mostrar categorias");

            }

            return ($productos);

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

}
