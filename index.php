<?php
include_once './php/connection.php';
include_once './php/config.php';

session_start();

$feature_products_query = "SELECT P_ID, P_NAME, P_PRICE, P_AVAILABILITY, P_URL, P_DESCRIPTION, P_CATEGORY FROM products ORDER BY RAND() LIMIT 5";
$feature_products = mysqli_query($connection, $feature_products_query);

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Store</title>

    <link rel="stylesheet" href="./styles/productInfo.css">

    <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="./glider/glider.css">
</head>

<body>
    <header>
        <section class="navbar navbar-expand-lg navbar-dark bg-dark">
            <article class="container">
                <a href="./index.php" class="navbar-brad link-warning">
                    <strong>Tech Store</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <article class="collapse navbar-collapse" id="navbarHeader">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a href="./pages/catalogue.php" class="nav-link active">Catalogo</a></li>
                        <li class="nav-item"><a href="./pages/registerProducts.php" class="nav-link active">Registrar Producto</a></li>
                    </ul>
                    <a href="./pages/cart.php" class="btn btn-warning">
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
                    <a href="./auth/login/login.php" class="btn btn-success">Login</a>
                </article>
            </article>
        </section>
    </header>

    <main>
        <section class="container mt-5">
            <h1>Bienvenido a Tech store</h1>
            <p>Aqui encontraras todo tipo de productos electronicos, y de ultima generación con los mejores precios de toda colombia y el mundo! animate y busca tus productos favoritos.</p>
        </section>
        <section class="container mt-5">
            <h4 class="pt-5">Productos destacados del dia</h4>
            <div class="glider-contain">
                <div class="glider carouse">
                    <?php
                    foreach ($feature_products as $key => $value) {
                        $id = encryptor('encrypt', $value['P_ID']);
                    ?>
                        <!-- here the feature prod -->
                        <div class="carousel__item">
                            <a class="prod" href="./pages/productInfo.php?id=<?php echo $id ?>">
                                <h5><?php echo $value['P_NAME'] ?></h5>
                                <img src="<?php
                                            if ($value["P_URL"]) {
                                                echo $value["P_URL"];
                                            } else {
                                                echo "https://www.fml.com.mx/wp-content/uploads/2016/04/Race-Registration-Image-Not-Found.png";
                                            } ?>" alt="<?php echo $value['P_NAME'] ?>" title="<?php echo $value['P_NAME'] ?>" class="item__img">
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>

    <script src="./glider/glider.js"></script>
    <script src="./js/gliderInit.js"></script>
</body>

</html>