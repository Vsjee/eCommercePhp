<?php
include_once '../php/connection.php';
include_once '../php/config.php';

session_start();

$CategoryP = $_POST['Category'];

global $data;
global $numRows;

if ($CategoryP == "electronic" || $CategoryP == "mobile" || $CategoryP == "hearphones" || $CategoryP == "computer" || $CategoryP == "hardware" || $CategoryP == "toy") {
    $query = "SELECT P_ID, P_NAME, P_PRICE, P_AVAILABILITY, P_URL, P_DESCRIPTION, P_CATEGORY FROM products WHERE P_CATEGORY = '$CategoryP'";

    $data = mysqli_query($connection, $query);

    $numRows = mysqli_num_rows($data);
} else {
    $query = "SELECT P_ID, P_NAME, P_PRICE, P_AVAILABILITY, P_URL, P_DESCRIPTION FROM products WHERE P_AVAILABILITY = 1";

    $data = mysqli_query($connection, $query);

    $numRows = mysqli_num_rows($data);
}

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

mysqli_close($connection);
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
                        <li class="nav-item"><a href="#" class="nav-link active">Catalogo</a></li>
                        <li class="nav-item"><a href="./registerProducts.php" class="nav-link active">Registrar Producto</a></li>
                    </ul>
                    <div class="cart_div">
                        <a href="./cart.php" class="btn btn-warning">
                            Carrito
                            <span class="btn btn-success rounded-circle m-0 pl-1 pr-1">
                                <?php
                                if ($_SESSION["shopping_cart"])
                                    echo count($_SESSION["shopping_cart"])
                                ?>
                            </span>
                        </a>
                    </div>
                </article>
            </article>
        </section>
    </header>

    <main>
        <section class="container mt-5 d-flex gap-5 align-items-center justify-content-evenly">
            <h3>Filtros de busqueda</h3>
            <form action="./catalogue.php" class="d-flex gap-5" method="post">
                <select name="Category" id="Category">
                    <option value="all">no filtros</option>
                    <option value="electronic">Electronicos</option>
                    <option value="mobile">Mobiles</option>
                    <option value="hearphones">Audiculares</option>
                    <option value="computer">Computadores</option>
                    <option value="hardware">Hardware</option>
                    <option value="toy">Juguetes</option>
                </select>
                <button class="btn btn-danger">buscar</button>
            </form>
        </section>
        <section class="container mt-5">
            <article class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                <?php
                foreach ($data as $key => $value) {
                    $id = encryptor('encrypt', $value['P_ID']);
                ?>
                    <form method="post" action="cart.php?action=add&id=<?php echo $value["P_ID"]; ?>">
                        <div style="background-color:#f1f1f1; border-radius:5px;" class="card shadow-sm overflow-hidden" style="height: 800px;">
                            <img src="<?php
                                        if ($value["P_URL"]) {
                                            echo $value["P_URL"];
                                        } else {
                                            echo "https://www.fml.com.mx/wp-content/uploads/2016/04/Race-Registration-Image-Not-Found.png";
                                        } ?>" class="img-responsive" width="400" height="400" style="object-fit: cover;" /><br />
                            <article class="card-body d-flex flex-column justify-content-between">
                                <article>
                                    <h4 class="card-title"><?php echo $value["P_NAME"]; ?></h4>
                                    <p class="card-text w-100 overflow-hidden" style="height: 45px;">
                                        <strong>Descripción: </strong>
                                        <?php
                                        echo $value['P_DESCRIPTION']
                                        ?>
                                    </p>
                                </article>
                                <h4 class="text-danger mt-4">$ <?php echo $value["P_PRICE"]; ?></h4>
                                <input type="text" name="quantity" class="form-control mt-4" value="1" />
                                <input type="hidden" name="hidden_name" value="<?php echo $value["P_NAME"]; ?>" />
                                <input type="hidden" name="hidden_price" value="<?php echo $value["P_PRICE"]; ?>" />
                                <article>
                                    <article class="d-flex justify-content-between align-items-center mt-3">
                                        <a href="./productInfo.php?id=<?php echo $id ?>" class="btn btn-error">
                                            Detalles
                                        </a>
                                        <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
                                    </article>
                                </article>
                            </article>
                        </div>
                    </form>
                <?php
                }
                ?>
        </section>
    </main>
</body>

</html>