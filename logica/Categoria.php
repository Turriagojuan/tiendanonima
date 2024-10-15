<?php
require_once ("./persistencia/Conexion.php");
require ("./persistencia/CategoriaDAO.php");

class Categoria{
    private $idCategoria;
    private $nombre;

    // Getters
    public function getIdCategoria() {
        return $this->idCategoria;
    }

    public function getNombre() {
        return $this->nombre;
    }

    // Setters
    public function setIdCategoria($idCategoria){  // Cambiado de setIdProducto a setIdCategoria
        $this->idCategoria = $idCategoria;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    // Constructor
    public function __construct($idCategoria=0, $nombre=""){
        $this->idCategoria = $idCategoria;
        $this->nombre = $nombre;
    }
    
    // Método para consultar todas las categorías
    public function consultarTodos(){
        $categorias = array();
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $categoriaDAO = new CategoriaDAO();
        $conexion->ejecutarConsulta($categoriaDAO->consultarTodos());
        while($registro = $conexion->siguienteRegistro()){
            $categoria = new Categoria($registro[0], $registro[1]);
            array_push($categorias, $categoria);
        }
        $conexion->cerrarConexion();
        return $categorias;        
    }
}
?>
