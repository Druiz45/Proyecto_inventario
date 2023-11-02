<?php

namespace App\Http\Models;

use config\Conexion;
use PDO;
use Exception;

class PedidoModel
{

    protected $remision;
    protected $orden;
    protected $pedido;
    protected $factura;
    protected $fecha;
    protected $actaEntrega;
    protected $nombreCliente;
    protected $doc;
    protected $direccion;
    protected $telefono;
    protected $ciudad;
    protected $celular;
    protected $email;

    protected $codigoVendedor;
    protected $anotacion;

    protected $stock;
    protected $almacen;
    protected $fabrica;
    protected $bandeja;
    protected $braker;
    protected $otros;
    protected $efectivo;
    protected $cheque;
    protected $iva;
    protected $total;
    protected $banco;
    protected $abono;
    protected $saldo;
    protected $vendedor;
    protected $autorizo;
    protected $verifico;

    public function __construct(
        $remision = "",
        $orden = "",
        $pedido = "",
        $factura = "",
        $fecha = "",
        $actaEntrega = "",
        $nombreCliente = "",
        $doc = "",
        $direccion = "",
        $telefono = "",
        $ciudad = "",
        $celular = "",
        $email = "",

        $codigoVendedor = "",
        $anotacion = "",

        $stock = "",
        $almacen = "",
        $fabrica = "",
        $bandeja = "",
        $braker = "",
        $otros = "",
        $efectivo = "",
        $cheque = "",
        $iva = "",
        $total = "",
        $banco = "",
        $abono = "",
        $saldo = "",
        $vendedor = "",
        $autorizo = "",
        $verifico = "",

    ) {
        $this->remision = $remision;
        $this->orden = $orden;
        $this->pedido = $pedido;
        $this->factura = $factura;
        $this->fecha = $fecha;
        $this->actaEntrega = $actaEntrega;
        $this->nombreCliente = $nombreCliente;
        $this->doc = $doc;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->ciudad = $ciudad;
        $this->celular = $celular;
        $this->email = $email;

        $this->codigoVendedor = $codigoVendedor;
        $this->anotacion = $anotacion;

        $this->stock = $stock;
        $this->almacen = $almacen;
        $this->fabrica = $fabrica;
        $this->bandeja = $bandeja;
        $this->braker = $braker;
        $this->otros = $otros;
        $this->efectivo = $efectivo;
        $this->cheque = $cheque;
        $this->iva = $iva;
        $this->total = $total;
        $this->banco = $banco;
        $this->abono = $abono;
        $this->saldo = $saldo;
        $this->vendedor = $vendedor;
        $this->autorizo = $autorizo;
        $this->verifico = $verifico;
    }

    // public function __construct(
    //     $documento = "",
    //     $nombreProducto = "",
    //     $cliente = "",
    //     $producto = "",
    //     $abono = "",
    //     $anotacion = "",
    //     $fechaLimite = "",
    //     $pedido = "",
    //     $banco = "",
    // ) {
    //     $this->documento = $documento;
    //     $this->nombreProducto = $nombreProducto;
    //     $this->cliente = $cliente;
    //     $this->producto = $producto;
    //     $this->abono = $abono;
    //     $this->anotacion = $anotacion;
    //     $this->fechaLimite = $fechaLimite;
    //     $this->pedido = $pedido;
    //     $this->banco = $banco;
    // }

    public function validateData()
    {

        try {

            // $pattern = "/^[0-9]{1,5}+$/";

            // if (!preg_match($pattern, trim($this->cliente))) {

            //     throw new Exception("Porfavor revise el cliente seleccionado");
            // }

            // $pattern = "/^[0-9]{1,4}+$/";

            // if (!preg_match($pattern, trim($this->producto))) {

            //     throw new Exception("Porfavor revise el producto seleccionado");
            // }

            // $this->abono = str_replace(['.', '$'], "", $this->abono);

            // $pattern = "/^[0-9]{1,8}+$/";

            // if (!preg_match($pattern, trim($this->abono))) {

            //     throw new Exception("El valor del abono no es valido");
            // }

            // $timeStamp = strtotime($this->fechaLimite);

            // if (!$timeStamp) {
            //     throw new Exception("La fecha no es valida");
            // }

            // $fecha_convertida = date('Y-m-d', $timeStamp);

            // if ($fecha_convertida != $this->fechaLimite) {

            //     throw new Exception("La fecha no es valida");
            // }

            // $pattern = "/^.{0,100}+$/";

            // if (!preg_match($pattern, trim($this->anotacion))) {

            //     throw new Exception("La anotacion puede contener un maximo de 100 carasteres");
            // }

            // $pattern = "/^[0-9]{1,2}+$/";

            // if (!preg_match($pattern, trim($this->banco))) {
            //     throw new Exception("Banco invalido");
            // }

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    // public function createAbonoPedido()
    // {
    //     $pdo = new Conexion();
    //     $con = $pdo->conexion();

    //     $vendedor = $_SESSION["idUser"];

    //     try {
    //         $insert = $con->prepare("CALL createAbono(?,?,?)");
    //         $insert->bindParam(1, $this->abono, PDO::PARAM_INT);
    //         $insert->bindParam(2, $this->pedido, PDO::PARAM_INT);
    //         $insert->bindParam(3, $vendedor, PDO::PARAM_INT);
    //         $insert->execute();

    //         $insert->closeCursor();

    //         if (!$insert || !$insert->rowCount() > 0) {
    //             throw new Exception("error");
    //         }
    //     } catch (Exception $e) {
    //         echo json_encode("error");
    //         die;
    //     }
    // }

    public function savePedido()
    {
        $pdo = new Conexion();
        $con = $pdo->conexion();

        // $precio = $this->getDataProducto();
        // $vendedor = $_SESSION['idUser'];

        try {

            // if ($this->abono>$precio) {
            //     throw new Exception("El abono supera el precio del producto");
            // }

            $this->stock = (bool) $this->stock;
            $this->almacen = (bool) $this->almacen;
            $this->fabrica = (bool) $this->fabrica;
            $this->bandeja = (bool) $this->bandeja;
            $this->braker = (bool) $this->braker;
            $this->otros = (bool) $this->otros;
            $this->efectivo = (bool) $this->efectivo;
            $this->cheque = (bool) $this->cheque;
            $this->iva = (bool) $this->iva;

            $insert = $con->prepare("CALL createPedido(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $insert->bindParam(1, $this->remision, PDO::PARAM_STR);
            $insert->bindParam(2, $this->orden, PDO::PARAM_INT);
            $insert->bindParam(3, $this->pedido, PDO::PARAM_INT);
            $insert->bindParam(4, $this->factura, PDO::PARAM_STR);
            $insert->bindParam(5, $this->fecha, PDO::PARAM_STR);
            $insert->bindParam(6, $this->actaEntrega, PDO::PARAM_STR);
            $insert->bindParam(7, $this->nombreCliente, PDO::PARAM_STR);
            $insert->bindParam(8, $this->doc, PDO::PARAM_STR);
            $insert->bindParam(9, $this->direccion, PDO::PARAM_STR);
            $insert->bindParam(10, $this->telefono, PDO::PARAM_STR);
            $insert->bindParam(11, $this->ciudad, PDO::PARAM_STR);
            $insert->bindParam(12, $this->celular, PDO::PARAM_STR);
            $insert->bindParam(13, $this->email, PDO::PARAM_STR);
            $insert->bindParam(14, $this->codigoVendedor, PDO::PARAM_INT);
            $insert->bindParam(15, $this->anotacion, PDO::PARAM_STR);

            $insert->bindParam(16, $this->stock, PDO::PARAM_INT);
            $insert->bindParam(17, $this->almacen, PDO::PARAM_INT);
            $insert->bindParam(18, $this->fabrica, PDO::PARAM_INT);
            $insert->bindParam(19, $this->bandeja, PDO::PARAM_INT);
            $insert->bindParam(20, $this->braker, PDO::PARAM_INT);
            $insert->bindParam(21, $this->otros, PDO::PARAM_INT);
            $insert->bindParam(22, $this->efectivo, PDO::PARAM_INT);
            $insert->bindParam(23, $this->cheque, PDO::PARAM_INT);
            $insert->bindParam(24, $this->iva, PDO::PARAM_INT);

            $insert->bindParam(25, $this->total, PDO::PARAM_INT);
            $insert->bindParam(26, $this->banco, PDO::PARAM_INT);
            // $insert->bindParam(27, $this->abono, PDO::PARAM_INT);
            $insert->bindParam(27, $this->saldo, PDO::PARAM_INT);

            $insert->bindParam(28, $this->vendedor, PDO::PARAM_STR);
            $insert->bindParam(29, $this->autorizo, PDO::PARAM_STR);
            $insert->bindParam(30, $this->verifico, PDO::PARAM_STR);

            // $insert->bindParam(1, $this->producto, PDO::PARAM_INT);
            // $insert->bindParam(2, $this->cliente, PDO::PARAM_INT);
            // $insert->bindParam(3, $vendedor, PDO::PARAM_INT);
            // $insert->bindParam(4, $precio, PDO::PARAM_INT);
            // $insert->bindParam(5, $this->anotacion, PDO::PARAM_STR);
            // $insert->bindParam(6, $this->fechaLimite, PDO::PARAM_STR);
            // $insert->bindParam(7, $this->banco, PDO::PARAM_INT);

            $insert->execute();

            $insert->closeCursor();

            if (!$insert || !$insert->rowCount() > 0) {
                throw new Exception("Error al registrar el pedido");
            }

            // $this->pedido = $con->query("SELECT LAST_INSERT_ID()")->fetchColumn();

            // $this->createAbonoPedido();

            echo json_encode("Pedido registrado con exito!");
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    // public function updatePedido()
    // {
    //     $pdo = new Conexion();
    //     $con = $pdo->conexion();

    //     $precio = $this->getDataProducto();

    //     try {
    //         $update = $con->prepare("CALL updatePedido(?,?,?,?,?,?,?)");
    //         $update->bindParam(1, $this->producto, PDO::PARAM_INT);
    //         $update->bindParam(2, $this->cliente, PDO::PARAM_INT);
    //         $update->bindParam(3, $precio, PDO::PARAM_INT);
    //         $update->bindParam(4, $this->anotacion, PDO::PARAM_STR);
    //         $update->bindParam(5, $this->fechaLimite, PDO::PARAM_STR);
    //         $update->bindParam(6, $this->pedido, PDO::PARAM_INT);
    //         $update->bindParam(7, $this->banco, PDO::PARAM_INT);
    //         $update->execute();

    //         $update->closeCursor();

    //         if (!$update) {
    //             throw new Exception("Error al actualizar el pedido");
    //         }

    //         if (!$update->rowCount() > 0) {
    //             throw new Exception("No se hicieron cambios");
    //         }

    //         echo json_encode("Pedido actualizado con exito!");
    //     } catch (Exception $e) {
    //         echo json_encode($e->getMessage());
    //         die;
    //     }
    // }

    public function validateDataEstado($estado, $pedido)
    {

        $estate = ($estado == "aprobado") ? 2 : 3;

        $mensaje = ($estado == "aprobado") ? "La aprobacion no es valida" : "El estado no es valido";

        try {

            $pattern = "/^[0-9]{1,1}+$/";
            if (!preg_match($pattern, trim($estate))) {
                throw new Exception($mensaje);
            }

            $pattern = "/^[0-9]{1,6}+$/";
            if (!preg_match($pattern, trim($pedido))) {
                throw new Exception("El pedido no es valido");
            }
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function updateAprobacion($estado, $pedido)
    {
        $pdo = new Conexion();
        $con = $pdo->conexion();

        $aprobacion = ($estado == "aprobado") ? 2 : 3;

        try {
            $update = $con->prepare("CALL updateAprobacionPedido(?,?)");
            $update->bindParam(1, $pedido, PDO::PARAM_INT);
            $update->bindParam(2, $aprobacion, PDO::PARAM_INT);
            $update->execute();

            $update->closeCursor();

            if (!$update || !$update->rowCount() > 0) {
                throw new Exception("error");
            }

            echo json_encode("pedido");
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function updatePagoComision($idPedido, ComisionModel $comision)
    {
        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {
            $update = $con->prepare("CALL updatePagoComision(?)");
            $update->bindParam(1, $idPedido, PDO::PARAM_INT);
            $update->execute();

            $update->closeCursor();

            if (!$update) {
                throw new Exception("error");
            }

            if (!$update->rowCount() > 0) {
                throw new Exception("No se ha realizado ningun cambio en el estado del pago");
            }

            $comision->create();

            echo json_encode("pedido");
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    public function updateEstado($estado, $idPedido, InventarioModel $inventario)
    {

        $pdo = new Conexion();
        $con = $pdo->conexion();

        $estate = ($estado == "entregado") ? 2 : 3;

        try {

            $update = $con->prepare("CALL updateEstadoPedido(?,?)");
            $update->bindParam(1, $idPedido, PDO::PARAM_INT);
            $update->bindParam(2, $estate, PDO::PARAM_INT);
            $update->execute();

            $update->closeCursor();

            if (!$update || !$update->rowCount() > 0) {
                throw new Exception("error");
            }

            if ($estate == 2) {
                $inventario->restarStock();
                // echo json_encode("s,ss");
            }



            echo json_encode("pedido");
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }

    // public function getDataProducto()
    // {

    //     $pdo = new Conexion();
    //     $con = $pdo->conexion();


    //     try {
    //         $select = $con->prepare("CALL getDataProducto(?)");
    //         $select->bindParam(1, $this->producto, PDO::PARAM_INT);
    //         $select->execute();

    //         $row = $select->fetchAll(PDO::FETCH_ASSOC);

    //         $select->closeCursor();

    //         if (!$select || !$select->rowCount() > 0) {

    //             throw new Exception("No se encontro el producto");
    //         }

    //         return $row[0]['precio'];
    //     } catch (Exception $e) {
    //         return [];
    //         die;
    //     }
    // }

    // public function getInfoFormCreate()
    // {
    //     try {
    //         if (!trim($this->documento) || !trim($this->nombreProducto)) {
    //             throw new Exception("No hay resultados");
    //         }
    //         if ($this->documento != "vacio") {
    //             echo json_encode($this->getClienteForDoc());
    //         } elseif ($this->nombreProducto != "vacio") {
    //             echo json_encode($this->getProductForCoincidencia());
    //         }
    //     } catch (Exception $e) {
    //         echo json_encode($e->getMessage());
    //         die;
    //     }
    // }

    // public function getClienteForDoc()
    // {
    //     $pdo = new Conexion();
    //     $con = $pdo->conexion();

    //     try {
    //         $select = $con->prepare("CALL getClienteForDoc(?)");
    //         $select->bindParam(1, $this->documento, PDO::PARAM_STR);
    //         $select->execute();

    //         $clientes = $select->fetchAll(PDO::FETCH_ASSOC);

    //         $select->closeCursor();

    //         if (!$select || !$select->rowCount() > 0) {
    //             throw new Exception("No se encontraron clientes");
    //         }

    //         return $clientes;
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //         die;
    //     }
    // }

    // public function getProductForCoincidencia()
    // {
    //     $pdo = new Conexion();
    //     $con = $pdo->conexion();

    //     try {
    //         $select = $con->prepare("CALL getProductForCoincidencia(?)");
    //         $select->bindParam(1, $this->nombreProducto, PDO::PARAM_STR);
    //         $select->execute();

    //         $products = $select->fetchAll(PDO::FETCH_ASSOC);

    //         $select->closeCursor();

    //         if (!$select || !$select->rowCount() > 0) {
    //             throw new Exception("No se encontraron productos");
    //         }

    //         return $products;
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //         die;
    //     }
    // }

    public function validateDate(): array
    {

        date_default_timezone_set('America/Bogota');

        $fechaActual = date('Y-m-d');

        if ((isset($_GET['startDate']) && trim($_GET['startDate'])) && (isset($_GET['finalDate']) && $_GET['finalDate'])) {

            if (!strtotime($_GET['startDate']) || !strtotime($_GET['finalDate'])) {
                header("Location: /" . getUrl($_SERVER['SERVER_NAME']) . "/compra/consultar");
            }

            return [
                'fechaInicio' => $_GET['startDate'],
                'fechaFinal' => $_GET['finalDate'],
            ];
        } else {
            return [
                'fechaInicio' => $fechaActual,
                'fechaFinal' => $fechaActual,
            ];
        }
    }

    public function getPedidos()
    {
        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {
            // $idUser = $_SESSION["idUser"];
            $idPerfil = $_SESSION["idPerfil"];

            // if ($idPerfil == 1) {
            //     $select = $con->prepare("CALL getPedidosVendedor(?,?)");
            //     $select->bindParam(1, $idUser, PDO::PARAM_INT);
            //     $select->bindParam(2, $idPerfil, PDO::PARAM_INT);
            // } else if ($idPerfil == 3) {
            //     $rango = $this->validateDate();
            //     $select = $con->prepare("CALL getPedidos(?,?,?)");
            //     $select->bindParam(1, $idPerfil, PDO::PARAM_INT);
            //     $select->bindParam(2, $rango['fechaInicio'], PDO::PARAM_STR);
            //     $select->bindParam(3, $rango['fechaFinal'], PDO::PARAM_STR);
            // }

            $select = $con->prepare("CALL getPedidos(?)");
            $select->bindParam(1, $idPerfil, PDO::PARAM_INT);

            $select->execute();

            $pedidos = $select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if (!$select) {
                throw new Exception("Error");
            }

            return $pedidos;
        } catch (Exception $e) {
            return $e->getMessage();
            die;
        }
    }

    public function getResumenPedidos()
    {

        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {

            $rango = $this->validateDate();

            $idPerfil = $_SESSION["idPerfil"];

            $select = $con->prepare("CALL resumenPedidos(?,?,?)");
            $select->bindParam(1, $idPerfil, PDO::PARAM_INT);
            $select->bindParam(2, $rango['fechaInicio'], PDO::PARAM_STR);
            $select->bindParam(3, $rango['fechaFinal'], PDO::PARAM_STR);

            $select->execute();

            $resumen = $select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if (!$select) {
                throw new Exception("Error");
            }

            return $resumen;
        } catch (Exception $e) {
            return $e->getMessage();
            die;
        }
    }

    public function getPedido($idPedido)
    {

        $pdo = new Conexion();
        $con = $pdo->conexion();

        try {

            $idPerfil = $_SESSION["idPerfil"];

            $select = $con->prepare("CALL getPedido(?,?)");
            $select->bindParam(1, $idPedido, PDO::PARAM_INT);
            $select->bindParam(2, $idPerfil, PDO::PARAM_INT);
            $select->execute();

            $pedido = $select->fetchAll(PDO::FETCH_ASSOC);

            $select->closeCursor();

            if (!$select) {
                throw new Exception("Error");
            }

            echo json_encode($pedido);
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        }
    }
}
