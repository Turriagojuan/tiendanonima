<?php 
class ProductoDAO {
    private $idProducto;
    private $nombre;
    private $cantidad;
    private $precioCompra;
    private $precioVenta;
    private $marcaId;  // Asegúrate de que este atributo esté presente

    public function __construct($idProducto=0, $nombre="", $cantidad=0, $precioCompra=0, $precioVenta=0, $marcaId=0) {
        $this->idProducto = $idProducto;
        $this->nombre = $nombre;
        $this->cantidad = $cantidad;
        $this->precioCompra = $precioCompra;
        $this->precioVenta = $precioVenta;
        $this->marcaId = $marcaId;  // Inicializa correctamente este valor
    }

    // Método para insertar un nuevo producto en la base de datos
    public function crearProducto() {
        // Asegúrate de que todos los valores estén presentes y correctos en la consulta SQL
        return "INSERT INTO Producto (nombre, cantidad, precioCompra, precioVenta, Marca_idMarca) VALUES (
                '" . $this->nombre . "',
                " . $this->cantidad . ",
                " . $this->precioCompra . ",
                " . $this->precioVenta . ",
                " . $this->marcaId . ")";
    }

    public function consultarTodos() {
        return "SELECT idProducto, nombre, cantidad, precioCompra, precioVenta, Marca_idMarca 
                FROM Producto";
    }
}