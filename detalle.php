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
</div>

<?php include "templates/footer.php";?>

