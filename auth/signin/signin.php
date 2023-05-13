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
  <link rel="icon" type="image/x-icon" href="../../assets/images/favicon.ico">
  <title>Sign In</title>

  <!-- bootstrap cdn -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- css -->
  <link rel="stylesheet" href="../styleForm.css">
  <link rel="stylesheet" href="../../global.css">

  <style>
    @keyframes background-pan {
      from {
        background-position: 0% center;
      }

      to {
        background-position: -200% center;
      }
    }

    .fancy__text {
      animation: background-pan 4s linear infinite;
      background: linear-gradient(90deg, rgb(179, 227, 252), rgb(48, 183, 255), rgb(179, 227, 252), rgb(48, 183, 255), rgb(179, 227, 252));
      background-size: 200%;
      background-clip: border-box;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      white-space: nowrap;
    }
  </style>
</head>

<body>
  <header>
    <section class="navbar navbar-expand-lg  navbar-light bg-light position-fixed w-100 top-0 nav">
      <article class="container">
        <a href="../../index.php" class="navbar-brad link-warning text-decoration-none text-info">
          <strong>Tech Store</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <article class="collapse navbar-collapse" id="navbarHeader">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a href="../../pages/catalogue.php" class="nav-link active link-info text-dark">Catalogo</a></li>
          </ul>
        </article>
      </article>
    </section>
  </header>

  <main>
    <section class="container mt-5 mb-5 pt-5 d-flex flex-column gap-5 align-items-center justify-content-evenly">
      <h3>REGISTRO</h3>
      <form method="post" action="./signinPhp.php" class="d-flex flex-column gap-4 form">
        <input type="text" class="form_input" name="Name" placeholder="Your name">
        <input type="text" class="form_input" name="Email" placeholder="Your email">
        <input type="password" class="form_input" name="Password" placeholder="Your password">
        <input type="password" class="form_input" name="PasswordConfirm" placeholder="Confirm password">
        <input type="submit" name="login_user" class="form_submit" value="Crear cuenta">
      </form>
      <a href="../login/login.php" class="text-decoration-none link-warning text-danger">Ya estas registrado? Inicia sessión</a>
    </section>
  </main>

  <footer class="bg-light text-center mt-5">
    Develop by <strong><span class="fancy__text">David Hernandez</span></strong>
  </footer>

</body>

</html>