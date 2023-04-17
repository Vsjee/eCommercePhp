<?php
session_start();

if (empty($_SESSION["user"])) {
  header("Location: ../../auth/login.php");
  exit();
} else {
  echo "Soy un mensaje secreto";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>

  <!-- bootstrap cdn -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
  <header>
    <section class="navbar navbar-expand-lg navbar-dark bg-dark">
      <article class="container">
        <a href="../../index.php" class="navbar-brad link-warning">
          <strong>Tech Store</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <article class="collapse navbar-collapse" id="navbarHeader">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a href="../../pages/catalogue.php" class="nav-link active">Catalogo</a></li>
            <li class="nav-item"><a href="../../pages/registerProducts.php" class="nav-link active">Registrar Producto</a></li>
          </ul>
          <div class="cart_div">
            <a href="../../pages/cart.php" class="btn btn-warning">
              Carrito
              <span>
                <?php
                if ($_SESSION["shopping_cart"]) {
                  echo count($_SESSION["shopping_cart"]);
                } else {
                  echo 0;
                }
                ?>
              </span>
            </a>
            <a href="../../auth/login/login.php" class="btn btn-primary">Logout</a>
          </div>
        </article>
      </article>
    </section>
  </header>

  <main>
    <section class="container mt-5 d-flex flex-column gap-5 align-items-center justify-content-evenly">
      <h3>User</h3>
      <h4>Bienvenid@ otra vez <?php echo $_SESSION["user"] ?></h4>
    </section>
  </main>
</body>

</html>