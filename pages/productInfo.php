<?php 
  include_once '../php/connection.php';
  include_once '../php/config.php';

  global $item;

  if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $id_decrypted = encryptor('decrypt', $id);

    if(!empty($id_decrypted)) {
      //fetch curr product
      $item_query = "SELECT P_ID, P_NAME, P_PRICE, P_AVAILABILITY, P_URL, P_DESCRIPTION, P_CATEGORY FROM products WHERE P_ID = '$id_decrypted'";
      $item = mysqli_query($connection, $item_query);
      $result = mysqli_fetch_array($item);

      //fetch related products
      $curr_category = $result['P_CATEGORY'];
      $curr_prodName = $result['P_NAME'];
      $related_products_query = "SELECT P_ID, P_NAME, P_PRICE, P_AVAILABILITY, P_URL, P_DESCRIPTION, P_CATEGORY FROM products WHERE P_CATEGORY = '$curr_category' AND P_NAME != '$curr_prodName'";
      $related_products =  mysqli_query($connection, $related_products_query);
      $num_rows = mysqli_num_rows($related_products);
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto info</title>

    <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="./productInfo.css">

    <link rel="stylesheet" type="text/css" href="../glider/glider.css">
  </head>
<body>
    <header>
        <section class="navbar navbar-expand-lg navbar-dark bg-dark">
          <article class="container">
                <a href="../index.php" class="navbar-brad">
                    <strong>Tech Store</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader"
                    aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <article class="collapse navbar-collapse" id="navbarHeader">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a href="./catalogue.php"class="nav-link active">Catalogo</a></li>
                        <li class="nav-item"><a href="./registerProducts.html" class="nav-link active">Registrar Producto</a></li>
                    </ul>
                    <a href="" class="btn btn-primary">Carrito</a>
                </article> 
            </article>
        </section>
        <article class="product">
          <article class="product__img">
            <picture>
              <img src="<?php echo $result['P_URL']?>" alt="" width="600" height="400">
            </picture>
          </article>
          <article class="product__add">
            <div class="add__top">
              <h2>
                <?php echo $result['P_NAME']?> 
              </h2>
              <h2>
                $<?php echo $result['P_PRICE']?>
              </h2>
            </div>
            <div class="add__bottom">
              <a href="" class="btn btn-success">Agregar</a>
            </div>
          </article>
        </article>
        <section class="container pb-5">
          <article>
            <h4>Descripcion</h4>
            <p>
              <?php echo $result['P_DESCRIPTION']?>
            </p>
            <h5>Categoria</h5>
            <p>
              <?php echo $result['P_CATEGORY']?>
            </p>
          </article>
        </section>
        <section class="container mt-5 mb-5 pt-5 pb-5">
          <h3 class="mb-5 text-center">Productos relacionados</h3>
          <div class="glider-contain">
            <div class="glider carouse">
                <?php
                    foreach ($related_products as $key => $value) {
                      $id = encryptor('encrypt', $value['P_ID']);
                ?>
              <div class="carousel__item">
                <a class="prod" href="./productInfo.php?id=<?php echo $id?>">
                  <h5><?php echo $value['P_NAME']?></h5>
                  <img src="<?php echo $value['P_URL']?>" alt="<?php echo $value['P_NAME']?>" title="<?php echo $value['P_NAME']?>" class="item__img">
                </a>
              </div>
                <?php 
                  }
                ?>
            </div>
            <?php if($num_rows == 0): ?>
              <h5 class="text-center">No exisiten productos relacionados por el momento.</h5>
            <?php endif?>
            <button aria-label="Previous" class="glider-prev">«</button>
            <button aria-label="Next" class="glider-next">»</button>
            <div role="tablist" class="dots"></div>
          </div>
        </section>
    </main>
    <script src="../glider/glider.js"></script>
    <script src="../js/gliderInit.js"></script>
</body>
</html>