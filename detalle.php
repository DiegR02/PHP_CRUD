<?php    
include "conexion.php";  
include "templates/header.php";
?>

<div class="container">
    <?php
        if (!isset($_GET['id'])) {        
            echo "El producto no existe";        
        }else{
            $id = $_GET['id'];
            $consultaSQL = "SELECT * FROM productos WHERE id =" . $id;    
            $sentencia = $conexion->query($consultaSQL);            
            $producto = $sentencia->fetch_object();  
        }if ($id) {            
            $nombre = $producto->nombre;
            $descripcion = $producto->descripcion;
            $imagen = $producto->imagen;
            $precio = $producto->precio;            
            $categoria = $producto->categoria;  
        
           
        }else{            
            echo 'No se ha encontrado el producto';
        }    
    ?>

    <?php
    $consulta = $conexion->query($consultaSQL);
    while ($elemento = $consulta->fetch_object()) {
        $id = $elemento->id;
        $nombre = $elemento->nombre;
        $descripcion = $elemento->descripcion;
        $imagen = $elemento->imagen;
        $precio = $elemento->precio;
        $categoria = $elemento->categoria;

        echo '<div class="container mt-5 mb-5">';
        echo '<div class="row d-flex justify-content-center">';
        echo '<div class="col-md-10">';
        echo '<div class="card">';
        echo '<div class="row">';
        echo '<div class="col-md-6">';
        echo '<div class="images p-3">';
        echo '<div class="text-center p-4"> <img id="main-image" src="crud/uploads/' . $imagen . '" width="250" /> </div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="col-md-6">';
        echo '<div class="product p-4">';
        echo '<div class="d-flex justify-content-between align-items-center">';
        echo '</div>';
        echo '<div class="mt-4 mb-3"> <span class="text-uppercase text-muted brand">' . $categoria . '</span>';
        echo '<h5 class="text-uppercase">' . $nombre . '</h5>';
        echo '<div class="price d-flex flex-row align-items-center"> <span class="act-price">€</span>';
        echo '<div class="ml-2">' . $precio . '</div>';
        echo '</div>';
        echo '</div>';
        echo '<p class="about"> ' . $descripcion . ' </p>';
        echo '<div class="sizes mt-5">';
        echo '<h6 class="text-uppercase">Size</h6> <label class="radio"> <input type="radio" name="size" value="S" checked> <span>S</span> </label> <label class="radio"> <input type="radio" name="size" value="M"> <span>M</span> </label> <label class="radio"> <input type="radio" name="size" value="L"> <span>L</span> </label> <label class="radio"> <input type="radio" name="size" value="XL"> <span>XL</span> </label> <label class="radio"> <input type="radio" name="size" value="XXL"> <span>XXL</span> </label>';
        echo "<hr>";
        echo "<form action='index.php?id=$id' method='post'>
        <button type='submit' class='btn btn-outline-primary'>Return</button>
        </form>";
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }


    ?>
    
</div>

<?php include "templates/footer.php";?>

