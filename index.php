<?php
include "conexion.php";
include "templates/header.php";

csrf();
if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
    die();
}
?>

<div class="container">
    <?php
    if (isset($_POST['apellido'])) {
        $apellido = $_POST['apellido'];
        $consultaSQL = "SELECT * FROM productos WHERE apellido LIKE '%$apellido%'";
        $titulo = ($apellido != "") ? 'Lista de productos (' . $_POST['apellido'] . ')' : 'Lista de alumnos';
    } else {
        $consultaSQL = "SELECT * FROM productos";
        $titulo = 'List of products';
    }

    echo "<h1 align='center' class='mt-3'>$titulo</h1>";
    ?>
    <!-- -->

    <?php
    $consulta = $conexion->query($consultaSQL);
    while ($elemento = $consulta->fetch_object()) {
        $id = $elemento->id;
        $nombre = $elemento->nombre;
        $descripcion = $elemento->descripcion;
        $imagen = $elemento->imagen;
        $precio = $elemento->precio;
        $categoria = $elemento->categoria;

        echo "<div class='container py-5'>";
        echo "<div class='row'>";
        echo "<div class='col-lg-8 mx-auto'>";
        echo "<!-- List group-->";
        echo "<ul class='list-group shadow'>";
        echo "<!-- list group item-->";
        echo "<li class='list-group-item'>";
        echo "<!-- Custom content-->";
        echo "<div class='media align-items-lg-center flex-column flex-lg-row p-3'>";
        echo "<div class='media-body order-2 order-lg-1'>";
        echo "<h5 class='mt-0 font-weight-bold mb-2'>$nombre</h5>";
        echo "<p class='font-italic text-muted mb-0 small'>$descripcion, $categoria</p>";
        echo "<div class='d-flex align-items-center justify-content-between mt-1'>";
        echo "<h6 class='font-weight-bold my-2'>$precio €</h6>";
        echo "<ul class='list-inline small'>";
        echo "<li class='list-inline-item m-0'><i class='fa fa-star text-success'></i></li>";
        echo "<li class='list-inline-item m-0'><i class='fa fa-star text-success'></i></li>";
        echo "<li class='list-inline-item m-0'><i class='fa fa-star text-success'></i></li>";
        echo "<li class='list-inline-item m-0'><i class='fa fa-star text-success'></i></li>";
        echo "<li class='list-inline-item m-0'><i class='fa fa-star-o text-gray'></i></li>";
        echo "</ul>";
        echo "</div>";
        echo "</div><img src='crud/uploads/$imagen' alt='' width='200' class='ml-lg-5 order-1 order-lg-2'>";
        echo "<hr>";
        echo "<form action='detalle.php?id=$id' method='post'>
        <button type='submit' class='btn btn-outline-primary'>More information</button>
        </form>";

        echo "</div> <!-- End -->";
        echo "</li> <!-- End -->";
        echo "</ul> <!-- End -->";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
    ?>
</div>

<?php
include "templates/footer.php";
?>