<?php

namespace App\Http\Models;

use config\Conexion;
use Exception;
use PDO;

class CategoriaModel{

    protected $nombre;

    public function __construct($nombre = ""){
        $this->nombre = $nombre;
    }

    public function validateData(){

        try {
                        
            if( !trim($this->nombre) ){

                throw new Exception("El nombre de la categoria no puede ser vacio");

            }

            $pattern = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9]{1,50}$/";

            if( !preg_match($pattern, trim($this->nombre)) ){

                throw new Exception("El nombre de la categoria no puede pasar de 50 caracteres");

            }
            
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }

    }

    public function createCategoria(){

        $pdo = new Conexion();
        $con = $pdo->conexion();
        
        try {
            $insert = $con->prepare("CALL createCategoria(?)");
            $insert->bindParam(1, $this->nombre, PDO::PARAM_STR);
            $insert->execute();

            $insert->closeCursor();

            if(!$insert || !$insert->rowCount() > 0){

                throw new Exception("Error al registrar la categoria");

            }

            echo json_encode("Categoria registrada");

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }

    }

    public function getCategorias(){

        try {

            $pdo = new Conexion();
            $con = $pdo->conexion();
    
            $param = 1;
    
            $select = $con->prepare("CALL getCategorias(?)");
            $select->bindParam(1, $param, PDO::PARAM_INT);
            $select->execute();
    
            $categorias = $select->fetchAll(PDO::FETCH_ASSOC);
    
            $select->closeCursor();
    
            return $categorias;
            
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }

    }

    public function updateCategoria($idCategoria){

        try {
            
            $pdo = new Conexion();
            $con = $pdo->conexion();
    
            $idPerfil = $_SESSION['idPerfil'];
    
            $update = $con->prepare("CALL updateCategoria(?,?,?)");
            $update->bindParam(1, $idPerfil, PDO::PARAM_INT);
            $update->bindParam(2, $idCategoria, PDO::PARAM_INT);
            $update->bindParam(3, $this->nombre, PDO::PARAM_STR);
            $update->execute();
    
            $update->closeCursor();
    
            if (!$update) {
                throw new Exception("Ha ocurrido un error al intentar actualizar");
            }
    
            if (!$update->rowCount() > 0) {
                throw new Exception("No se han hecho cambios");
            }
    
            echo json_encode("La categoria se actualizo correctamente");
            
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

}
