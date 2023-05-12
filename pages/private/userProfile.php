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
  $resulNumRows = mysqli_num_rows($result);
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
  <link rel="stylesheet" href="../../global.css">
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
    <section class="navbar navbar-expand-lg  navbar-light bg-light position-fixed w-100 top-0 nav">
      <article class="container">
        <a href="../../index.php" class="navbar-brad link-warning text-decoration-none text-info" style="transition: .3s ease-in-out;">
          <strong>Tech Store</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <article class="collapse navbar-collapse" id="navbarHeader">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a href="../catalogue.php" class="nav-link active link-info text-dark">Catalogo</a></li>
            <?php
            if ($isAdmin) {
            ?>
              <li class="nav-item"><a href="../registerProducts.php" class="nav-link active link-info text-dark">Registrar Producto</a></li>
            <?php } ?>
          </ul>
          <div>
            <?php
            if (!empty($_SESSION["user"])) {
            ?>
              <a href="../cart.php" class="btn btn-warning text-light">
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
              <a href="../../auth/logout.php" class="btn btn-info text-light">Logout</a>
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

  <main>
    <section class="container mt-5 pt-5 d-flex flex-column gap-5 align-items-center justify-content-evenly">
      <?php
      if ($isAdmin) {
      ?>
        <h4>Bienvenid@ otra vez
          <span class="text-info">admin <?php echo $_SESSION["user"] ?></span>
        </h4>
      <?php
      } else {
      ?>
        <h4>Bienvenid@ otra vez
          <span class="text-info">
            <?php echo $_SESSION["user"] ?>
          </span>
        </h4>
      <?php
      }
      ?>
    </section>

    <section class="mt-5 mb-5">
      <?php
      if ($isAdmin) {
      ?>
        <!-- ADMIN RENDER -->
        <h4 class="list__text--before">Lista de usuarios existenten en la app</h4>
        <?php
        if ($resulNumRows > 0) {
        ?>
          <!-- ADMIN RENDER IF EXISTS USERS IN THE DB -->
          <table class="table-responsive m-5">
            <thead>
              <th class="w-50">Nombre</th>
              <th class="w-50">Correo</th>
              <th class="w-25">Acción</th>
            </thead>
            <?php
            foreach ($usersListResult as $key => $value) {
            ?>
              <form method="post" action="../../utils/deleteUser.php">
                <tbody>
                  <td>
                    <?php echo $value["U_NAME"]; ?>
                  </td>
                  <td>
                    <?php echo $value["U_EMAIL"]; ?>
                  </td>
                  <td>
                    <input type="hidden" name="UserId" value="<?php echo $value['U_ID']; ?>">
                    <button class="btn btn-danger" type="submit">Delete</button>
                  </td>
                </tbody>
              </form>
            <?php
            }
            ?>
          </table>
        <?php
        } else {
        ?>
          <!-- ADMIN RENDER IF NOT EXISTS USER IN THE DB -->
          <h3 class="ist__text--before">No existen ususarios en la DB.</h3>
        <?php
        }
        ?>
        <h4 class="list__text--before">Ver graficas</h4>
        <a href="./graphics/graphics.php" class="list__text--before text-decoration-none text-info link-warning">Graficas</a>
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
        <h4 class="list__text--before">Asistente virtual Botyuda</h4>
        <a href="./chatbot/chatbot.php" class="list__text--before text-decoration-none text-info link-warning">Obtener ayuda</a>
      <?php
      }
      ?>
    </section>
  </main>
</body>

</html>