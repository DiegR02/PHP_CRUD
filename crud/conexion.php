<?php 
    $conexion=new mysqli("localhost", "root", "");
    
    $consulta="CREATE DATABASE IF NOT EXISTS tienda;";
    $conexion->query($consulta);
  
    $conexion->select_db("tienda");
    $consulta="CREATE TABLE IF NOT EXISTS productos (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(30) NOT NULL,
        descripcion TEXT,
        imagen VARCHAR(255),
        precio DECIMAL(6,2),
        categoria VARCHAR(30)
      );";
    $conexion->query($consulta);

    $consulta="SELECT nombre FROM productos";
    $resultado=$conexion->query($consulta);    
    if($resultado->num_rows<1){
        
        $consulta="INSERT INTO productos (nombre, descripcion, imagen, precio, categoria) 
        VALUES ('Pantalones Adidas', 'Pantalones deportivos de la marca Adidas', 'pantalonesadidas.jpg', 40, 'Pantalones'),
        ('Sudadera Nike', 'PSudadera de algodón Nike color blanco, Sudadera', 'sudaderanike.jpg', 50, 'Sudadera');";
        
        $conexion->query($consulta);

    };

    function escapar($html) {
        return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
    }

    function csrf() {
        session_start();
      
        if (empty($_SESSION['csrf'])) {
          if (function_exists('random_bytes')) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
          } else if (function_exists('mcrypt_create_iv')) {
            $_SESSION['csrf'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
          } else {
            $_SESSION['csrf'] = bin2hex(openssl_random_pseudo_bytes(32));
          }
        }
    }
?>