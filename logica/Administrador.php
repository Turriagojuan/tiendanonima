<?php

require_once ("./persistencia/Conexion.php");
require_once ("./persistencia/AdministradorDAO.php");
require_once ("./logica/Persona.php"); 

class Administrador extends Persona{    
    private $productos;

    public function getProductos(){
        return $this->productos;
    }

    public function setProductos($productos){
        $this->productos = $productos;
    }
    
    public function __construct($idPersona=0, $nombre="", $apellido="", $correo="", $clave=""){
        parent::__construct($idPersona, $nombre, $apellido, $correo, $clave);
    }
    
    public function autenticar(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $administradorDAO = new AdministradorDAO(null, null, null, $this -> correo, $this -> clave);
        $conexion -> ejecutarConsulta($administradorDAO -> autenticar());
        if($conexion -> numeroFilas() == 0){
            $conexion -> cerrarConexion();
            return false;
        }else{
            $registro = $conexion -> siguienteRegistro();
            $this -> idPersona = $registro[0];
            $conexion -> cerrarConexion();
            return true;
        }
    }
    
    public function consultar(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $administradorDAO = new AdministradorDAO($this -> idPersona);
        $conexion -> ejecutarConsulta($administradorDAO -> consultar());
        $registro = $conexion -> siguienteRegistro();
        $this -> nombre = $registro[0];
        $this -> apellido = $registro[1];
        $this -> correo = $registro[2];
        $conexion -> cerrarConexion();
    }
    public function crearProducto($nombre, $cantidad, $precioCompra, $precioVenta, $marcaId) {
        if ($nombre != "" && $precioCompra > 0 && $precioVenta > 0 && $cantidad > 0 && $marcaId != "") {
            $productoDAO = new ProductoDAO(null, $nombre, $cantidad, $precioCompra, $precioVenta, $marcaId);
            $conexion = new Conexion();
            $conexion->abrirConexion();
            $conexion->ejecutarConsulta($productoDAO->crearProducto());
            $conexion->cerrarConexion();
            return true; // Producto creado con éxito
        } else {
            return false; // Datos inválidos
        }
    }
}

?>




