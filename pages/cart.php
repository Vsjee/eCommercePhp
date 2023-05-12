<?php

include_once '../php/config.php';

session_start();

if (isset($_POST["add_to_cart"])) {
  if (isset($_SESSION["shopping_cart"])) {
    $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
    if (!in_array($_GET["id"], $item_array_id)) {
      $count = count($_SESSION["shopping_cart"]);
      $item_array = array(
        'item_id'       => $_GET["id"],
        'item_name'     => $_POST["hidden_name"],
        'item_price'    => $_POST["hidden_price"],
        'item_quantity' => $_POST["quantity"],
        'item_img'      => $_POST["hidden_img"]
      );
      $_SESSION["shopping_cart"][$count] = $item_array;
    } else {
      echo '<script>alert("Item Already Added")</script>';
      echo '<script>window.location="catalogue.php"</script>';
    }
  } else {
    $item_array = array(
      'item_id'       => $_GET["id"],
      'item_name'     => $_POST["hidden_name"],
      'item_price'    => $_POST["hidden_price"],
      'item_quantity' => $_POST["quantity"],
      'item_img'      => $_POST["hidden_img"]
    );
    $_SESSION["shopping_cart"][0] = $item_array;
  }
}
if (isset($_GET["action"])) {
  if ($_GET["action"] == "delete") {
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
      if ($values["item_id"] == $_GET["id"]) {
        unset($_SESSION["shopping_cart"][$keys]);
        echo '<script>alert("Item Removed")</script>';
        echo '<script>window.location="cart.php"</script>';
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Catalogo</title>

  <!-- bootstrap cdn -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <style>
    .img {
      object-fit: cover;
      height: 150px;
    }
  </style>
  <link rel="stylesheet" href="../global.css">
</head>

<body>
  <header>
    <section class="navbar navbar-expand-lg  navbar-light bg-light position-fixed w-100 top-0 nav">
      <article class="container">
        <a href="../index.php" class="navbar-brad link-warning text-decoration-none text-info">
          <strong>Tech Store</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <article class="collapse navbar-collapse" id="navbarHeader">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a href="./catalogue.php" class="nav-link active link-info text-dark">Catalogo</a></li>
          </ul>
          <div>
            <?php
            if (!empty($_SESSION["user"])) {
            ?>
              <a href="./cart.php" class="btn btn-warning text-light">
                Carrito
                <span>
                  <?php
                  if (!empty($_SESSION["shopping_cart"])) {
                    echo count($_SESSION["shopping_cart"]);
                  } else {
                    echo 0;
                  }
                  ?>
                </span>
              </a>
              <a href="../pages/private/userProfile.php" class="btn btn-info text-light">Profile</a>
            <?php
            } else {
            ?>
              <a href="../auth/login/login.php" class="btn btn-info text-light">Login</a>
            <?php
            }
            ?>
          </div>
        </article>
      </article>
    </section>
  </header>

  <div style="clear:both"></div>
  <br />
  <h3>Detalles orden</h3>
  <div class="table-responsive mt-5 pt-4 mb-5">
    <table class="table table-bordered container">
      <tr>
        <th width="10%">Producto</th>
        <th width="10%">Nombre</th>
        <th width="10%">Cantidad</th>
        <th width="10%">Precio</th>
        <th width="15%">Total</th>
        <th width="5%">Acción</th>
      </tr>
      <?php
      if (!empty($_SESSION["shopping_cart"])) {
        $total = 0;
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
          $id = encryptor('encrypt', $values['item_id']);
      ?>
          <tr>
            <td>
              <a href="./productInfo.php?id=<?php echo $id ?>">
                <img src="<?php
                          if ($values["item_img"]) {
                            echo $values["item_img"];
                          } else {
                            echo "https://www.fml.com.mx/wp-content/uploads/2016/04/Race-Registration-Image-Not-Found.png";
                          } ?>" alt="<?php echo $values["item_name"]; ?>" title="<?php echo $values["item_name"]; ?>" class="w-100 img">
            </td>
            </a>
            <td>
              <a href="./productInfo.php?id=<?php echo $id ?>" class="text-decoration-none link-primary text-info">
                <?php echo $values["item_name"]; ?>
              </a>
            </td>
            <td><?php echo $values["item_quantity"]; ?></td>
            <td>$ <?php echo $values["item_price"]; ?></td>
            <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
            <td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="btn btn-danger text-light">Eliminar</span></a></td>
          </tr>
        <?php
          $total = $total + ($values["item_quantity"] * $values["item_price"]);
        }
        ?>
        <tr>
          <td></td>
          <td colspan="4" align="right">Total</td>
          <td align="right">$ <?php echo number_format($total, 2); ?></td>
        </tr>
      <?php
      }
      ?>
    </table>
  </div>
</body>

</html>