<?php

namespace App\Http\Models;
use config\Conexion;
use PDO;
use Exception;

class AbonoCompraModel extends CompraModel{

    protected $abono;
    protected $compra;


    public function __construct($abono="", $compra=""){
        $this->abono=$abono;
        $this->compra=$compra;
    }

    public function validateData(){
        try {
           
            $this->abono = str_replace(['.','$'],"",$this->abono);

            $pattern = "/^[0-9]{1,8}+$/";
            if( !preg_match($pattern, trim($this->abono)) ){
                throw new Exception("El valor del abono no es valido");
            }

            $pattern = "/^[0-9]{1,4}+$/";
            if( !preg_match($pattern, trim($this->compra)) ){
                throw new Exception("La orden de compra no es valido");
            }
        

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

   public function create($restante){
    $pdo = new Conexion();
    $con = $pdo->conexion();
    
    $user=$_SESSION["idUser"];

    try {
        $insert = $con->prepare("CALL createAbonoCompra(?,?,?)");
        $insert->bindParam(1, $this->abono, PDO::PARAM_INT);
        $insert->bindParam(2, $this->compra, PDO::PARAM_INT);
        $insert->bindParam(3, $user, PDO::PARAM_INT);
        $insert->execute();

        $insert->closeCursor();

        if(!$insert || !$insert->rowCount() > 0){
            throw new Exception("error");
        }
        if (($restante-$this->abono)==0){
            $this->updateEstate("Pagar", $this->compra);
        }
        else{
            echo json_encode("exito");
        }

    } catch (Exception $e) {
        echo json_encode($e->getMessage());
        die;
    }
   }

   public function getAbonos($compra){
    $pdo = new Conexion();
    $con = $pdo->conexion();

    try {
        $select = $con->prepare("CALL getAbonosCompra(?)");
        $select->bindParam(1, $compra, PDO::PARAM_INT);
        $select->execute();

        $abonos=$select->fetchAll(PDO::FETCH_ASSOC);

        $select->closeCursor();

        if(!$select || !$select->rowCount() > 0){
            throw new Exception("error");
        }

        return $abonos;

    } catch (Exception $e) {
        return [];
        die;
    }
   }

}