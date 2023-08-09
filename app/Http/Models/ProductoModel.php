<?php

namespace App\Http\Models;
use config\Conexion;
use Exception;
use PDO;

class ProductoModel{

    protected $nombreProducto; 
    protected $idCategoria; 
    protected $descripcion;
    protected $valorProducto;

    public function __construct($nombreProducto = "", $idCategoria = "", $descripcion = "", $valorProducto = ""){
        
       $this->nombreProducto=$nombreProducto;
       $this->idCategoria=$idCategoria;
       $this->descripcion=$descripcion;
       $this->valorProducto=$valorProducto;

    }


    public function validateData(){

        try {
                        
            if(!trim($this->nombreProducto) || !trim($this->idCategoria) || !trim($this->valorProducto)){

                throw new Exception("Porfavor complete todos los campos");

            }

            $pattern = "/^[0-9]{1,1}+$/";

            if( !preg_match($pattern, trim($this->idCategoria)) ){

                throw new Exception("La categoria seleccionada no es valida");

            }

            $this->valorProducto = str_replace(['.','$'],"",$this->valorProducto);

            $pattern = "/^[0-9]{2,8}+$/";

            if( !preg_match($pattern, trim($this->valorProducto)) ){

                throw new Exception("El valor del producto no es valido");

            }

            $pattern = "/^.{0,100}+$/";

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
            $insert = $con->prepare("CALL saveProducto(?,?,?,?)");
            $insert->bindParam(1, $this->nombreProducto, PDO::PARAM_STR);
            $insert->bindParam(2, $this->idCategoria, PDO::PARAM_INT);
            $insert->bindParam(3, $this->descripcion, PDO::PARAM_STR);
            $insert->bindParam(4, $this->valorProducto, PDO::PARAM_INT);
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

    public function actualizarEstadoProducto($estado, $producto){
        
        try {

            $pdo = new Conexion();
            $con = $pdo->conexion();

            // $idUser = $_SESSION['idUser'];
            $idPerfil = $_SESSION['idPerfil'];
            $state = $estado == "deshabilitar" ? 0 : 1;

            $update = $con->prepare("CALL updateEstadoProducto(?,?,?)");
            $update->bindParam(1, $state, PDO::PARAM_INT);
            $update->bindParam(2, $producto, PDO::PARAM_INT);
            $update->bindParam(3, $idPerfil, PDO::PARAM_INT);
            $update->execute();

            $update->closeCursor();

            if (!$update) {
                throw new Exception("Ha ocurrido un error al intentar Eliminar");
            }

            if (!$update->rowCount() > 0) {
                throw new Exception("No se han Eliminado registros");
            }

            echo json_encode("El producto se elimino correctamente");
            
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }

    }

    public function updateProducto($idProducto){

        try {

            $pdo = new Conexion();
            $con = $pdo->conexion();

            // $idUser = $_SESSION['idUser'];
            // // $idPerfil = $_SESSION['idPerfil'];
            // $state = $estado == "deshabilitar" ? 0 : 1;

            $update = $con->prepare("CALL updateProducto(?,?,?,?,?)");
            $update->bindParam(1, $this->nombreProducto, PDO::PARAM_STR);
            $update->bindParam(2, $this->valorProducto, PDO::PARAM_INT);
            $update->bindParam(3, $this->descripcion, PDO::PARAM_STR);
            $update->bindParam(4, $this->idCategoria, PDO::PARAM_INT);
            $update->bindParam(5, $idProducto, PDO::PARAM_INT);
            $update->execute();

            $update->closeCursor();

            if (!$update) {
                throw new Exception("Ha ocurrido un error al intentar actualizar");
            }

            if (!$update->rowCount() > 0) {
                throw new Exception("No se han hecho cambios");
            }

            echo json_encode(["El producto se actualizo correctamente", "success"]);
            
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

                throw new Exception("Error");

            }

            return ($productos);

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function getDataProductoForId($idProducto){

        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {
            $select = $con->prepare("CALL getDataProductoForId(?)");
            $select->bindParam(1, $idProducto, PDO::PARAM_INT);
            $select->execute();

            $producto=$select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if(!$select || !$select->rowCount() > 0){

                throw new Exception("Error");

            }

            echo json_encode($producto);

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

}
