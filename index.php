<?php 
    include_once './php/connection.php';

    $query = "SELECT P_ID, P_NAME, P_PRICE, P_AVAILABILITY, P_URL, P_DESCRIPTION FROM products WHERE P_AVAILABILITY = 1";

    $res_query = mysqli_query($connection, $query);

    $products = mysqli_num_rows($res_query);

    mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <header>
        <section class="navbar navbar-expand-lg navbar-dark bg-dark">
            <article class="container">
                <a href="" class="navbar-brad">
                    <strong>Tech Store</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader"
                    aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <article class="collapse navbar-collapse" id="navbarHeader">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a href="#"class="nav-link active">Catalogo</a></li>
                        <li class="nav-item"><a href="#"class="nav-link active">Contactenos</a></li>
                        <li class="nav-item"><a href="#"class="nav-link active">Acerca de</a></li>
                    </ul>
                    <a href="" class="btn btn-primary">Carrito</a>
                </article> 
            </article>
        </section>
    </header>

    <main>
        <section class="container mt-5">
            <article class="row row-cols-1 row-cols-sm-2 row-cols-md-3">

                <?php 
                    foreach ($res_query as $key => $value) {
                ?>
                <article class="col">
                    <article class="card shadow-sm overflow-hidden">
                        <picture>
                            <img src="<?php echo $value['P_URL'];?>" alt="iphone" width="400" height="400" style="object-fit: cover;" class="itemSell">
                        </picture>
                        <article class="card-body">
                            <h3 class="card-title">
                            <?php
                                echo $value['P_NAME'];
                            ?>
                            </h3>
                            <p class="card-text">
                                <strong>Descripción: </strong>
                                <?php 
                                    echo $value['P_DESCRIPTION']
                                ?>
                            </p>
                            <p class="card-text">
                                COP $
                                <?php 
                                    echo $value['P_RICE']
                                ?>
                            </p>
                            
                            <article class="d-flex justify-content-between align-items-center">
                                <a href="" class="btn btn-error">
                                    Detalles
                                </a>
                                <a href="" class="btn btn-success">
                                    Agregar
                                </a>
                            </article>

                        </article>
                    </article>
                </article>
                <?php 
                    }
                ?>
        </section>
    </main>
</body>
</html>