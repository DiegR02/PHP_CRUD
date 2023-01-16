<?php 
  include "templates/header.php"; 
  include "conexion.php";
  if (isset($_POST['submit'])) {
    $nombreFichero = $_FILES['imagen']['name'];
    $file_loc = $_FILES['imagen']['tmp_name'];        
    move_uploaded_file($file_loc,"uploads/".$nombreFichero); 

    $nombre=escapar($_POST["nombre"]);
    $descripcion=escapar($_POST["descripcion"]);
    $imagen=$_POST["imagen"];
    $precio=$_POST["precio"];
    $categoria=$_POST["categoria"];
    $consulta=$conexion->query("INSERT INTO productos (nombre, descripcion, imagen, precio, categoria) VALUES
      ('$nombre', '$descripcion', '$imagen', $precio, '$categoria')");
    echo "<p class='alert alert-success'> ✔️ $nombre added successfully</p>";

  }
?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-4">Add a product</h2>
      <hr>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="nombre">Name</label>
          <input type="text" name="nombre" id="nombre" class="form-control">
        </div>
        <div class="form-group">
          <label for="descripcion">Description</label>
          <input type="text" name="descripcion" id="descripcion" class="form-control">
        </div>
        <div class="form-group">
          <label for="imagen">Image</label>
          <input type="file" name="imagen" id="imagen" class="form-control">
        </div>
        <div class="form-group">
          <label for="precio">Precio</label>
          <input type="number" step=".01" min="0" name="precio" id="precio" class="form-control">
        </div>
        <div class="form-group">
          <label for="categoria">Category</label>
          <input type="text" name="categoria" id="categoria" class="form-control" accept="image/*">
        </div>
        <div class="form-group">
          <hr>
          <input type="submit" name="submit" class="btn btn-primary" value="Add">
          <a class="btn btn-primary" href="index.php">Return</a>
        </div>
      </form>
    </div>
  </div>
  
</div>

<?php include "templates/footer.php"; ?>