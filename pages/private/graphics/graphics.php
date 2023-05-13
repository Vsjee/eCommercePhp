<?php
include '../../../php/config.php';
include '../../../php/connection.php';

session_start();

global $products;

$products_query = "SELECT `P_ID`, `P_NAME`, `P_PRICE`, `P_DISCOUNT`, `P_AVAILABILITY`, `P_URL`, `P_DESCRIPTION`, `P_CATEGORY`, `P_BUY_NOW` FROM `products`";
$products_result = mysqli_query($connection, $products_query);
$products = mysqli_fetch_all($products_result);

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Graficas de Tech Store</title>

  <!-- bootstrap cdn -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="../../../global.css">

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
        <a href="../../../index.php" class="navbar-brad link-warning text-decoration-none text-info" style="transition: .3s ease-in-out;">
          <strong>Tech Store</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <article class="collapse navbar-collapse" id="navbarHeader">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a href="../../catalogue.php" class="nav-link active link-info text-dark">Catalogo</a></li>
          </ul>
          <a href="../userProfile.php" class="btn text-decoration-none text-dark">Volver</a>
          <a href="../../../auth/logout.php" class="btn btn-info text-light">Logout</a>
        </article>
      </article>
    </section>
  </header>

  <main>
    <section class="container mt-5 pt-5 d-flex flex-column gap-5 align-items-center justify-content-evenly">
      <h4>Aqui podras ver las graficas relacionadas con la app <span class="text-primary"><?php echo $_SESSION["user"] ?></span></h4>
    </section>
    <section class="container mt-5 mb-5">
      <!-- barras -->
      <figure class="highcharts-figure">
        <div id="containerBarras"></div>
      </figure>
      <figure class="highcharts-figure mt-5">
        <div id="containerPie"></div>
      </figure>
    </section>
  </main>

  <footer class="bg-light text-center mt-5">
    Develop by <strong><span class="fancy__text">David Hernandez</span></strong>
  </footer>

</body>

<script src="https://code.highcharts.com/highcharts.js"></script>

</html>

<!-- barras -->
<script type="text/javascript">
  const products = <?php echo json_encode($products) ?>; //array of arrays [[]]

  function _getAveragePricePerCategory(product, priceIndex, category, categoryIndex) {
    let result = 0;

    for (let i = 0; i < product.length; i++) {
      if (product[i][categoryIndex] === category) {
        result += Number(product[i][priceIndex]);
      }
    }

    result /= product.length;

    return result;
  }

  function _getNumTotalProductsPerCategory(product, category, categoryIndex) {
    let result = 0;

    for (let i = 0; i < product.length; i++) {
      if (product[i][categoryIndex] === category) {
        result += 1;
      }
    }

    return result;
  };

  //bar basic
  Highcharts.chart('containerBarras', {
    chart: {
      type: 'bar'
    },
    title: {
      text: 'Precio promedio para comprar en cada categoria'
    },
    subtitle: {
      text: 'Valores reflejados en COP'
    },
    xAxis: {
      categories: [''],
      title: {
        text: 'Categorias'
      }
    },
    yAxis: {
      min: 0,
      title: {
        text: 'Tech store',
        align: 'high'
      },
      labels: {
        overflow: 'justify'
      }
    },
    tooltip: {
      valueDecimals: 2,
      valuePrefix: '$',
      valueSuffix: 'COP'
    },
    plotOptions: {
      bar: {
        dataLabels: {
          enabled: true
        }
      }
    },
    legend: {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'top',
      x: -10,
      y: 190,
      floating: true,
      borderWidth: 1,
      backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
      shadow: true
    },
    credits: {
      enabled: false
    },
    series: [{
      name: 'Electronicos',
      data: [_getAveragePricePerCategory(products, 2, 'electronic', 7)]
    }, {
      name: 'Computadores',
      data: [_getAveragePricePerCategory(products, 2, 'computer', 7)]
    }, {
      name: 'Mobiles',
      data: [_getAveragePricePerCategory(products, 2, 'mobile', 7)]
    }, {
      name: 'Hardware',
      data: [_getAveragePricePerCategory(products, 2, 'hardware', 7)]
    }, {
      name: 'Audifonos',
      data: [_getAveragePricePerCategory(products, 2, 'hearphones', 7)]
    }, {
      name: 'Juguetes',
      data: [_getAveragePricePerCategory(products, 2, 'toy', 7)]
    }]
  });

  // 3d pie
  Highcharts.chart('containerPie', {
    chart: {
      type: 'pie',
      options3d: {
        enabled: true,
        alpha: 45,
        beta: 0
      }
    },
    title: {
      text: 'Porcentaje de productos por categoria'
    },
    accessibility: {
      point: {
        valueSuffix: '%'
      }
    },
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
      pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        depth: 35,
        dataLabels: {
          enabled: true,
          format: '{point.name}'
        }
      }
    },
    series: [{
      type: 'pie',
      name: 'Porcentaje de productos por categoria',
      data: [
        ['Electronicos', _getNumTotalProductsPerCategory(products, 'electronic', 7)],
        ['Computadores', _getNumTotalProductsPerCategory(products, 'computer', 7)],
        {
          name: 'Mobiles',
          y: _getNumTotalProductsPerCategory(products, 'mobile', 7),
          sliced: true,
          selected: true
        },
        ['Hardware', _getNumTotalProductsPerCategory(products, 'hardware', 7)],
        ['Audifonos', _getNumTotalProductsPerCategory(products, 'heardphones', 7)],
        ['Juguetes', _getNumTotalProductsPerCategory(products, 'toy', 7)]
      ]
    }]
  });
</script>