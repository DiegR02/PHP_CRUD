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
            if (isset($_POST['apellido']) ) {
                $apellido=$_POST['apellido'];
                $consultaSQL = "SELECT * FROM productos WHERE nombre LIKE '%$nombre%'";
                $titulo = ($nombre!="") ? 'Lista de productos (' . $_POST['nombre'] . ')': 'Lista de productos';
            } else {
                $consultaSQL = "SELECT * FROM productos";
                $titulo = 'List of products';
            }   
            
            echo "<h1 class='mt-3'>$titulo</h1>";
        ?>        
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
        <?php                 
                 
            $consulta=$conexion->query($consultaSQL);    
            while($elemento=$consulta->fetch_object()){  
                $id = $elemento->id;
                $nombre = $elemento->nombre;
                $descripcion = $elemento->descripcion;
                $imagen = $elemento->imagen;
                $precio = $elemento->precio;
                $categoria = $elemento->categoria;
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$nombre</td>";
                echo "<td>$descripcion</td>";
                echo "<td>$precio</td>";
                echo "<td>$categoria</td>";
                echo "<td><img src='uploads/$imagen' alt='' width='200' class='ml-lg-5 order-1 order-lg-2'></td>";
                echo "<td><form action='editar.php?id=$id' method='post''><input type='submit' value='✏️Edit'></form>";
                echo "<td><form action='borrar.php?id=$id' method='post' onSubmit='return confirm(\"Are you sure?\")'><input type='submit' value='🗑️Delete'></form>";
                
                echo "</tr>";
            }
        ?>
            </tbody>
        </table>
    </div>

<?php 
    include "templates/footer.php"; 
?>
