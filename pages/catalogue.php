<?php
include_once '../php/connection.php';
include_once '../php/config.php';

session_start();

$CategoryP = $_POST['Category'];

global $data;
global $numRows;

if ($CategoryP == "electronic" || $CategoryP == "mobile" || $CategoryP == "hearphones" || $CategoryP == "computer" || $CategoryP == "hardware" || $CategoryP == "toy") {
    $query = "SELECT P_ID, P_NAME, P_PRICE, P_AVAILABILITY, P_URL, P_DESCRIPTION, P_DISCOUNT, P_CATEGORY FROM products WHERE P_CATEGORY = '$CategoryP'";

    $data = mysqli_query($connection, $query);

    $numRows = mysqli_num_rows($data);
} else {
    $query = "SELECT P_ID, P_NAME, P_PRICE, P_AVAILABILITY, P_URL, P_DISCOUNT, P_DESCRIPTION FROM products WHERE P_AVAILABILITY = 1";

    $data = mysqli_query($connection, $query);

    $numRows = mysqli_num_rows($data);
}

if (isset($_POST["add_to_cart"])) {
    if (isset($_SESSION["shopping_cart"])) {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if (!in_array($_GET["id"], $item_array_id)) {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id'       => $_GET["id"],
                'item_name'     => $_POST["hidden_name"],
                'item_price'    => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
                'item_img'      => $_POST["hidden_img"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        } else {
            echo '<script>alert("Item Already Added")</script>';
            echo '<script>window.location="catalogue.php"</script>';
        }
    } else {
        $item_array = array(
            'item_id'       => $_GET["id"],
            'item_name'     => $_POST["hidden_name"],
            'item_price'    => $_POST["hidden_price"],
            'item_quantity' => $_POST["quantity"],
            'item_img'      => $_POST["hidden_img"]
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
    <link rel="icon" type="image/x-icon" href="../assets/images/favicon.ico">
    <title>Catalogo</title>

    <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../global.css">

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
                <a href="../index.php" class="navbar-brad link-warning text-decoration-none text-info">
                    <strong>Tech Store</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <article class="collapse navbar-collapse" id="navbarHeader">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a href="#" class="nav-link active link-info text-dark">Catalogo</a></li>
                    </ul>
                    <div>
                        <?php
                        if (!empty($_SESSION["user"])) {
                        ?>
                            <a href="./cart.php" class="btn btn-warning text-light">
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
                            <a href="../pages/private/userProfile.php" class="btn btn-info text-light">Profile</a>
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
        <section class="container mt-5 pt-5 d-flex gap-5 align-items-center justify-content-evenly">
            <h3>Filtros de busqueda</h3>
            <form action="./catalogue.php" class="d-flex gap-5" method="post">
                <select name="Category" id="Category" class="bg-light p-1">
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

                    //discount
                    $discountValue = $value['P_PRICE'] * $value['P_DISCOUNT'] / 100;
                    $discount = $value['P_PRICE'] - $discountValue;
                ?>
                    <form method="post" action="catalogue.php?action=add&id=<?php echo $value["P_ID"]; ?>" data-aos="fade-up">
                        <div style="border-radius:5px; margin: 5px 5px 50px 5px; box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px;" class="card border-light overflow-hidden" style="height: 800px;">
                            <img src="<?php
                                        if ($value["P_URL"]) {
                                            echo $value["P_URL"];
                                        } else {
                                            echo "https://www.fml.com.mx/wp-content/uploads/2016/04/Race-Registration-Image-Not-Found.png";
                                        } ?>" class="img-responsive" width="400" height="400" style="object-fit: cover;" title="<?php echo $value["P_NAME"]; ?>" /><br />
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
                                <input type="hidden" name="hidden_price" value="<?php echo $discount; ?>" />
                                <input type="hidden" name="hidden_img" value="<?php echo $value["P_URL"]; ?>" />
                                <article>
                                    <article class="d-flex justify-content-between align-items-center mt-3">
                                        <a href="./productInfo.php?id=<?php echo $id ?>" class="btn btn-error">
                                            Detalles
                                        </a>
                                        <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-info text-light" value="Añadir al carrito" />
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

    <footer class="bg-light text-center mt-5">
        Develop by <strong><span class="fancy__text">David Hernandez</span></strong>
    </footer>

</body>

</html>