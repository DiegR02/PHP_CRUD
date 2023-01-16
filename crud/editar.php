<?php
    include "conexion.php";    

    if (!isset($_GET['id'])) {        
        echo "El producto no existe";        
    }else{
        $id = $_GET['id'];
        $consultaSQL = "SELECT * FROM productos WHERE id =" . $id;    
        $sentencia = $conexion->query($consultaSQL);            
        $producto = $sentencia->fetch_object();    
        if ($id) {            
            $nombre = $producto->nombre;
            $descripcion = $producto->descripcion;
            $imagen = $producto->imagen;
            $precio = $producto->precio;            
            $categoria = $producto->categoria;            
        }else{            
            echo 'No se ha encontrado el producto';
        }
        
    }
    
    if (isset($_POST['submit'])) {    
        $id = $_GET['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $categoria = $_POST['categoria'];
        $imagen = $_POST['imagen'];
       
        if(isset($_FILES['imagen']['name']) && $_FILES['imagen']['name']!=""){ 
          $imagen = $_FILES['imagen']['name'];             
          $file_loc = $_FILES['imagen']['tmp_name'];
          move_uploaded_file($file_loc,"uploads/".$imagen); 
          $consultaSQL = "UPDATE productos SET  nombre = '$nombre', descripcion = '$descripcion', precio = $precio,  categoria = '$categoria', ";
          $consultaSQL .= "imagen = '$imagen' WHERE id = $id";  
        }else{
          $consultaSQL = "UPDATE productos SET  nombre = '$nombre', descripcion = '$descripcion', precio = $precio,  categoria = '$categoria' ";
          $consultaSQL .= " WHERE id = $id";
        }        
        $consulta = $conexion->query($consultaSQL);        
        header("Status: 301 Moved Permanently");
        header("Location: index.php");
        exit;
    }    
?>

<?php require "templates/header.php"; ?>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="mt-4">Editing <?= escapar($nombre)?></h2>
        <hr>
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="nombre">Name</label>
            <input type="text" name="nombre" id="nombre" value="<?= escapar($nombre) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="descripcion">Description</label>
            <input type="text" name="descripcion" id="descripcion" value="<?= escapar($descripcion) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="precio">Price</label>
            <input type="text" step=".01" min="0" name="precio" id="precio" value="<?= escapar($precio) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="categoria">Category</label>
            <input type="text" name="categoria" id="categoria" value="<?= escapar($categoria) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="imagen">Image</label>
            <input type="file" name="imagen" id="imagen" class="form-control" accept="uploads/*">
          </div>
          <?php
            if($imagen!=""){
              echo "<br><img src='uploads/$imagen' style='width: 100px'><br>";
            }
          ?>
          <div class="form-group">
            <hr>
            <input type="submit" name="submit" class="btn btn-primary" value="Update">
            <a class="btn btn-primary" href="index.php">Return</a>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php require "templates/footer.php"; ?>