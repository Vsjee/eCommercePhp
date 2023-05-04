<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registrar producto</title>

  <!-- bootstrap cdn -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
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
            <li class="nav-item">
              <a href="./catalogue.php" class="nav-link active">Catalogo</a>
            </li>
            <li class="nav-item">
              <a href="./registerProducts.php" class="nav-link active">Registrar Producto</a>
            </li>
          </ul>
          <div>
            <?php
            if (!empty($_SESSION["user"])) {
            ?>
              <a href="./cart.php" class="btn btn-warning">
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
              <a href="../pages/private/userProfile.php" class="btn btn-success">Profile</a>
            <?php
            } else {
            ?>
              <a href="../auth/login/login.php" class="btn btn-primary">Login</a>
            <?php
            }
            ?>
          </div>
        </article>
      </article>
    </section>
  </header>

  <main>
    <section class="container mt-5">
      <h3 class="text-center">Registrar producto</h3>
      <form action="../php/registerProducts/registerProduct.php" method="post" class="d-flex flex-column gap-4 justify-content-center align-items-center pt-5 pb-5">
        <input type="text" name="Nombre" placeholder="Nombre del producto" required class="w-75 p-1" />
        <input type="number" name="Precio" placeholder="Precio del producto" required class="w-75 p-1" />
        <input type="text" name="Url" placeholder="Url (imagen del producto)" required class="w-75 p-1" />
        <div class="d-flex gap-5">
          <label for="select">Categoria</label>
          <select name="Categoria" id="categoria">
            <option value="electronic">Electronicos</option>
            <option value="mobile">Mobiles</option>
            <option value="computer">Computadores</option>
            <option value="hardware">Hardware</option>
            <option value="hearphones">Audiculares</option>
            <option value="toy">Juguetes</option>
          </select>
        </div>
        <textarea type="text" name="Descripcion" placeholder="Descripcion de producto max 300 characteres" required class="w-75 p-1" style="height: 200px; resize: none"></textarea>
        <button class="btn btn-danger">Registrar</button>
      </form>
    </section>
  </main>
</body>

</html>