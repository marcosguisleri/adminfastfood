<?php
    require 'config.php';

    session_start();

    $nome = '';

    if(isset($_SESSION['nomeUser'])) {
        $nome = $_SESSION['nomeUser'];
    }

    // Consulta SQL para obter os produtos e suas quantidades em estoque
    $sql = "SELECT nome_produto, quantidade FROM produtos";

    // Preparar e executar a consulta
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Inicializar arrays para armazenar os nomes dos produtos e suas quantidades
    $productNames = [];
    $productQuantities = [];

    // Processar os resultados da consulta
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $productNames[] = $row['nome_produto'];
        $productQuantities[] = $row['quantidade'];
    }

    // Consulta SQL para obter os produtos e seus preços
    $sqlPreco = "SELECT nome_produto, preco FROM produtos";

    // Preparar e executar a consulta
    $stmtPreco = $pdo->prepare($sqlPreco);
    $stmtPreco->execute();

    // Inicializar arrays para armazenar os nomes dos produtos e seus preços
    $productNamesPreco = [];
    $productPrices = [];

    // Processar os resultados da consulta
    while ($rowPreco = $stmtPreco->fetch(PDO::FETCH_ASSOC)) {
        $productNamesPreco[] = $rowPreco['nome_produto'];
        $productPrices[] = $rowPreco['preco'];
    }

    // Encerrar a conexão com o banco de dados
    unset($pdo);
?>


<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FastFood</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/icon/favicon-16x16.png">
    <link rel="manifest" href="assets/img/icon/site.webmanifest">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <style>
        .nav-link {
            font-size: 1.25rem;
        }
        .nav-link i {
            font-size: 2rem;
        }
        .dropdown-toggle::after {
            color: white !important;
        }
        .dropdown span {
            color: white !important;
        }
        .section-title {
            border-bottom: 2px solid #f4f4f4;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <header>
        <div class="px-3 py-2 text-bg-dark border-bottom">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <a href="home.php" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                        <img src="assets/img/logo.png" class="bi me-2" width="120" height="100" alt="">
                    </a>
                    <div class="flex-shrink-0 dropdown ms-5">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="assets\img\perfil.png" alt="mdo" width="42" height="42" class="rounded-circle">
                            <span class="ms-1"><?php echo $nome ?></span>
                        </a>
                        <ul class="dropdown-menu text-small shadow">
                            <li><a class="dropdown-item" href="logout.php">Sair</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
       
        <div class="px-4 py-5 my-5 text-center">
            <img class="d-block mx-auto mb-4" src="assets/img/grafico.png" alt="" width="140" height="120">
            <h1 class="display-5 fw-bold text-body-emphasis">Estatisticas de Vendas</h1>
            <div class="col-lg-6 mx-auto">
              <p class="lead mb-4">
                Nossa página de gráficos de vendas oferece uma visão detalhada das suas operações. Com gráficos interativos, você pode visualizar tendências de vendas, identificar os produtos mais vendidos e analisar o comportamento dos clientes. A interface intuitiva permite acesso rápido e fácil às informações mais relevantes para otimizar seu negócio FastFood</p>
              <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a href="cadastroProduto.php"><button type="button" class="btn btn-warning btn-lg px-4 gap-3">Cadastrar novo produto</button></a>
                <button type="button" class="btn btn-outline-dark btn-lg px-4">Ver sistema de vendas</button>
              </div>
            </div>
        </div>

        <div class="container mt-5">
            <h1 class="display-6 fw-bold text-warning lh-1 section-title">Estatisticas</h1>
            <div id="graficoPizza" style="width: 100%; height: 300px;"></div>
        </div>

        <div class="container mt-5">
            <div id="bar-chart" style="width: 100%; height: 300px;"></div>
        </div>

        <div class="container mt-5">
            <div id="graficoDispersao" style="width: 100%; height: 500px;"></div>
        </div>

    </main>

    <div class="container mt-4">
        <footer class="d-flex flex-wrap justify-content-center align-items-center py-3 my-1">
            <div class="d-flex align-items-center">
                <p class="mb-0 text-body-secondary">&copy; 2024 - <b class="text-warning">FastFood</b></p>
            </div>
        </footer>
    </div>

    <script>

        var productNames = <?php echo json_encode($productNames); ?>;
        var productQuantities = <?php echo json_encode($productQuantities); ?>;

        var data = [{
            values: productQuantities,
            labels: productNames,
            type: 'pie'
        }];

        var layout = {
            title: 'Quantidade de Produtos em Estoque',
            height: 400
        };

        Plotly.newPlot('graficoPizza', data, layout);
    </script>

    <script>
        
        var data = [{
            x: <?php echo json_encode($productNames); ?>,
            y: <?php echo json_encode($productPrices); ?>,
            type: 'bar'
        }];

        
        var layout = {
            title: 'Média de Preços dos Produtos',
            xaxis: { title: 'Produtos' },
            yaxis: { title: 'Preço' }
        };

        
        Plotly.newPlot('bar-chart', data, layout);
    </script>

    <script>
        var productNames = <?php echo json_encode($productNames); ?>;
        var productQuantities = <?php echo json_encode($productQuantities); ?>;
        var productPrices = <?php echo json_encode($productPrices); ?>;

        var data = [{
            x: productQuantities,
            y: productPrices,
            mode: 'markers',
            marker: {
                size: 12
            },
            type: 'scatter',
            text: productNames,
            hoverinfo: 'text+y'
        }];

        var layout = {
            title: 'Relação entre Quantidade e Preço dos Produtos',
            xaxis: { title: 'Quantidade em Estoque' },
            yaxis: { title: 'Preço' }
        };

        Plotly.newPlot('graficoDispersao', data, layout);
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
