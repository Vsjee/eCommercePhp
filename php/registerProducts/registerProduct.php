<?php 
  include_once '../connection.php';

  $Nombre = $_POST['Nombre'];
  $Precio = $_POST['Precio'];
  $Url = $_POST['Url'];
  $Descripcion = $_POST['Descripcion'];
  $Descripcion = $_POST['Descripcion'];
  $Categoria = $_POST['Categoria'];

  $product_exists = "SELECT `P_NAME` FROM `products` WHERE P_NAME = '$Nombre'";
  $query_if_product_exists = mysqli_query($connection, $product_exists);

  if(mysqli_num_rows($query_if_product_exists)>0) {
    echo '<script>
      alert("The product already exist, try other one.");
      window.history.go(-1);
    </script>';
  } else {
    $P_DISCOUNT_D = 0;	
    $P_AVAILABILITY_D = true;
    $query_insert_data = "INSERT INTO products (
      `P_NAME`, 
      `P_PRICE`, 
      `P_DISCOUNT`, 
      `P_AVAILABILITY`, 
      `P_URL`, 
      `P_DESCRIPTION`,
      `P_CATEGORY`
    ) VALUES (
      '$Nombre',
      '$Precio',
      '$P_DISCOUNT_D',
      '$P_AVAILABILITY_D',
      '$Url',
      '$Descripcion',
      '$Categoria'
      )";
    $insert_data = mysqli_query($connection, $query_insert_data);

    if(!$query_insert_data) {
      echo '<script>
        alert("Error when try to save data");
        window.history.go(-1);
      </script>';
    } else {
      echo '<script>
        alert("Registro exitoso");
        window.history.go(-1);
      </script>';
    }
  }

  mysqli_close($connection);
?>