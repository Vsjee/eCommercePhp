<?php
include_once '../../php/connection.php';
include_once '../../php/config.php';

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- bootstrap cdn -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- css -->
  <link rel="stylesheet" href="../styleForm.css">
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
          </div>
        </article>
      </article>
    </section>
  </header>

  <main>
    <section class="container mt-5 d-flex flex-column gap-5 align-items-center justify-content-evenly">
      <h3>Login</h3>
      <form method="post" action="./logingPhp.php" class="d-flex flex-column gap-4 form ">
        <input type="text" class="form_input" name="Email" placeholder="Your email">
        <input type="password" class="form_input" name="Password" placeholder="Your password">
        <input type="submit" name="login_user" class="form_submit">
      </form>
      <a href="../signin/signin.php">No tienes cuenta? create una.</a>
    </section>
  </main>
</body>

</html>