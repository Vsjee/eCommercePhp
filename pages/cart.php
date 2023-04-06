<?php
session_start();

if (isset($_POST["add_to_cart"])) {
  if (isset($_SESSION["shopping_cart"])) {
    $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
    if (!in_array($_GET["id"], $item_array_id)) {
      $count = count($_SESSION["shopping_cart"]);
      $item_array = array(
        'item_id'               =>     $_GET["id"],
        'item_name'               =>     $_POST["hidden_name"],
        'item_price'          =>     $_POST["hidden_price"],
        'item_quantity'          =>     $_POST["quantity"]
      );
      $_SESSION["shopping_cart"][$count] = $item_array;
    } else {
      echo '<script>alert("Item Already Added")</script>';
      echo '<script>window.location="catalogue.php"</script>';
    }
  } else {
    $item_array = array(
      'item_id'               =>     $_GET["id"],
      'item_name'               =>     $_POST["hidden_name"],
      'item_price'          =>     $_POST["hidden_price"],
      'item_quantity'          =>     $_POST["quantity"]
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
</head>

<body>
  <header>
    <section class="navbar navbar-expand-lg navbar-dark bg-dark">
      <article class="container">
        <a href="../index.php" class="navbar-brad link-warning">
          <strong>Tech Store</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <article class="collapse navbar-collapse" id="navbarHeader">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a href="./catalogue.php" class="nav-link active">Catalogo</a></li>
            <li class="nav-item"><a href="./registerProducts.php" class="nav-link active">Registrar Producto</a></li>
          </ul>
          <div class="cart_div">
            <a href="./cart.php" class="btn btn-warning">
              Carrito
              <span class="btn btn-success rounded-circle m-0 pl-1 pr-1">
                <?php echo count($_SESSION["shopping_cart"]) ?>
              </span>
            </a>
          </div>
        </article>
      </article>
    </section>
  </header>
  <div style="clear:both"></div>
  <br />
  <h3>Detalles orden</h3>
  <div class="table-responsive">
    <table class="table table-bordered">
      <tr>
        <th width="40%">Item Name</th>
        <th width="10%">Quantity</th>
        <th width="20%">Price</th>
        <th width="15%">Total</th>
        <th width="5%">Action</th>
      </tr>
      <?php
      if (!empty($_SESSION["shopping_cart"])) {
        $total = 0;
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
      ?>
          <tr>
            <td><?php echo $values["item_name"]; ?></td>
            <td><?php echo $values["item_quantity"]; ?></td>
            <td>$ <?php echo $values["item_price"]; ?></td>
            <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
            <td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
          </tr>
        <?php
          $total = $total + ($values["item_quantity"] * $values["item_price"]);
        }
        ?>
        <tr>
          <td colspan="3" align="right">Total</td>
          <td align="right">$ <?php echo number_format($total, 2); ?></td>
          <td></td>
        </tr>
      <?php
      }
      ?>
    </table>
  </div>
</body>

</html>