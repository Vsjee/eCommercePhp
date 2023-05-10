<?php
include '../../php/config.php';
include '../../php/connection.php';

session_start();

$isAdmin = false;

if (empty($_SESSION["user"])) {
  header("Location: ../../auth/login.php");
  exit();
} else {
  echo '<script>console.log("Soy un mensaje secreto, estamos en tu perfil.")</script>';
  $userName = $_SESSION["user"];
  $userQuery = "SELECT U_NAME, P_TYPE FROM `users` WHERE U_NAME = '$userName'";
  $result = mysqli_query($connection, $userQuery);
  $result = mysqli_fetch_array($result);

  if ($result["P_TYPE"] == "admin") {
    $isAdmin = true;
    $usersListQuery = "SELECT U_ID, U_NAME, U_EMAIL, U_PASSWORD, P_TYPE FROM `users`";
    $usersListResult = mysqli_query($connection, $usersListQuery);
  } else {
    $isAdmin = false;
  }
}

mysqli_close($connection);
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
  <style>
    .list__text--before {
      margin-left: 5%;
      margin-top: 5rem;
    }

    .list {
      display: grid;
      grid-auto-rows: 24rem;
      grid-template-columns: repeat(auto-fill, minmax(min(100%, 18rem), 1fr));
      grid-auto-flow: dense;
      gap: 2rem;
      margin: 5rem 2%;
      padding: 0;
      list-style: none;
    }

    .img {
      width: 100%;
      height: 250px;
      object-fit: cover;
    }
  </style>
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
                if (!empty($_SESSION["shopping_cart"])) {
                  echo count($_SESSION["shopping_cart"]);
                } else {
                  echo 0;
                }
                ?>
              </span>
            </a>
            <a href="../../auth/logout.php" class="btn btn-primary">Logout</a>
          </div>
        </article>
      </article>
    </section>
  </header>

  <main>
    <section class="container mt-5 d-flex flex-column gap-5 align-items-center justify-content-evenly">
      <?php
      if ($isAdmin) {
      ?>
        <h4>Bienvenid@ otra vez Admin <?php echo $_SESSION["user"] ?></h4>
      <?php
      } else {
      ?>
        <h4>Bienvenid@ otra vez <?php echo $_SESSION["user"] ?></h4>
      <?php
      }
      ?>
    </section>

    <section class="mt-5">
      <?php
      if ($isAdmin) {
      ?>
        <!-- ADMIN RENDER -->
        <h4 class="list__text--before">Lista de usuarios existenten en la app</h4>
        <table class="table-responsive m-5">
          <thead>
            <th class="w-50">user name</th>
            <th class="w-50">user email</th>
            <th class="w-25">delete</th>
          </thead>
          <?php
          foreach ($usersListResult as $key => $value) {
          ?>
            <tbody>
              <td>
                <?php echo $value["U_NAME"]; ?>
              </td>
              <td>
                <?php echo $value["U_EMAIL"]; ?>
              </td>
              <td>
                <button class="btn btn-danger">Delete</button>
              </td>
            </tbody>
          <?php
          }
          ?>
        </table>
        <h4 class="list__text--before">Ver graficas</h4>
        <a href="" class="list__text--before">Graficas</a>
        <a href="./chatbot/chatbot.php" class="list__text--before">Obtener ayuda</a>
      <?php
      } else {
      ?>
        <!-- USER RENDER -->
        <h5 class="list__text--before">Listado productos que tienes en tu carrito</h5>
        <ul class="list">
          <?php
          if (!empty($_SESSION["shopping_cart"])) {
            $total = 0;
            foreach ($_SESSION["shopping_cart"] as $keys => $values) {
              $id = encryptor("encrypt", $values["item_id"]);
          ?>
              <li>
                <a href="../productInfo.php?id=<?php echo $id ?>">
                  <img src="<?php
                            if ($values["item_img"]) {
                              echo $values["item_img"];
                            } else {
                              echo "https://www.fml.com.mx/wp-content/uploads/2016/04/Race-Registration-Image-Not-Found.png";
                            } ?>" alt="<?php echo $values["item_name"] ?>" title="<?php echo $values["item_name"] ?>" class="img">

                </a>
                <p>Producto: <?php echo $values["item_name"] ?></p>
                <p>Precio: <?php echo $values["item_price"] ?></p>
              </li>
          <?php
            }
          }
          ?>
        </ul>
      <?php
      }
      ?>
    </section>
  </main>
</body>

</html>