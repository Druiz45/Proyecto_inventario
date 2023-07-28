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


    public function validateData(){

        try {
                        
            if( !trim($this->nombreProducto) || !trim($this->idCategoria) || !trim($this->descripcion)){

                throw new Exception("Porfavor complete todos los campos");

            }

            $pattern = "/^[0-9]{1,1}+$/";

            if( !preg_match($pattern, trim($this->idCategoria)) ){

                throw new Exception("La categoria seleccionada no es valida");

            }

            $pattern = "/^.{1,100}+$/";

            if( !preg_match($pattern, trim($this->descripcion)) ){

                throw new Exception("La descripcion puede contener un maximo de 100 carasteres");

            }
            
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }

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

            if(!$insert || !$insert->rowCount() > 0){

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

}
