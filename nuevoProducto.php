<?php 

session_start();
if (!isset($_SESSION["id"])) {
    header("Location: iniciarSesion.php");
}

require_once("persistencia/ProductoDAO.php");
require_once("logica/Marca.php");
require_once("logica/Administrador.php");

$error = false;
$success = false;

// Obtener las marcas disponibles
$marca = new Marca();
$marcasDisponibles = $marca->consultarTodos();

// Instanciamos al administrador autenticado
$administrador = new Administrador($_SESSION["id"]);
$administrador->consultar();

if (isset($_POST["crearProducto"])) {
    $nombre = $_POST["nombre"];
    $precioCompra = $_POST["precioCompra"];
    $precioVenta = $_POST["precioVenta"];
    $cantidad = $_POST["cantidad"];
    $marcaId = $_POST["marca"];

    // El administrador crea el producto
    if ($administrador->crearProducto($nombre, $cantidad, $precioCompra, $precioVenta, $marcaId)) {
        $success = true;
    } else {
        $error = true;
    }
}
?>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include("encabezado.php"); ?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-4"></div>
            <div class="col-4">
                <div class="card border-primary">
                    <div class="card-header text-bg-info">
                        <h4>Nuevo Producto</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="nuevoProducto.php">
                            <div class="mb-3">
                                <input type="text" name="nombre" class="form-control" placeholder="Nombre del Producto" required>
                            </div>
                            <div class="mb-3">
                                <input type="number" name="precioCompra" class="form-control" placeholder="Precio Compra" min="0.01" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <input type="number" name="precioVenta" class="form-control" placeholder="Precio Venta" min="0.01" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <input type="number" name="cantidad" class="form-control" placeholder="Cantidad" min="1" required>
                            </div>
                            <div class="mb-3">
                                <select name="marca" class="form-control" required>
                                    <option value="">Seleccione una Marca</option>
                                    <?php foreach($marcasDisponibles as $marca) { ?>
                                        <option value="<?php echo $marca->getIdMarca(); ?>"><?php echo $marca->getNombre(); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button type="submit" name="crearProducto" class="btn btn-primary">Crear Producto</button>
                            <?php if($error){ ?>
                                <div class="alert alert-danger mt-3" role="alert">Error en los datos. Por favor, inténtalo de nuevo.</div>
                            <?php } ?>
                            <?php if($success){ ?>
                                <div class="alert alert-success mt-3" role="alert">Producto creado con éxito.</div>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

