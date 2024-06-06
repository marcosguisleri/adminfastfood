<?php

require 'config.php';
require_once 'dao/produtoDAO.php';
require_once 'controller/produtoController.php';

session_start();

$nome = '';
if (isset($_SESSION['nomeUser'])) {
    $nome = $_SESSION['nomeUser'];
}

$produto = null;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $dao = new ProdutoDAO($pdo);
    $controller = new ProdutoController($dao);

    $produto = $controller->buscarProduto($id);
}

if (!$produto) {
    echo "Produto não encontrado.";
    exit;
}

?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($produto['nome_produto']); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/icon/favicon-16x16.png">
    <link rel="manifest" href="assets/img/icon/site.webmanifest">
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
                            <span class="ms-1"><?php echo htmlspecialchars($nome); ?></span>
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
        <div class="container py-5">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <img src="<?php echo htmlspecialchars($produto['caminho_imagem']); ?>" class="card-img-top" alt="Imagem do Produto">
                        <div class="card-body">
                            <h1 class="card-title display-6 fw-bold text-warning lh-1 mb-3"><?php echo htmlspecialchars($produto['nome_produto']); ?></h1>
                            <p class="card-text lead"><?php echo nl2br(htmlspecialchars($produto['descricao'])); ?></p>
                            <p class="card-text lead"><b>Preço:</b> R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                            <p class="card-text lead"><b>Quantidade Disponível:</b> <?php echo htmlspecialchars($produto['quantidade']); ?></p>
                        </div>
                        <div class="card-footer">
                            <a href="home.php">
                                <button class="btn btn-warning">Voltar</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="container mt-5">
        <footer class="d-flex flex-wrap justify-content-center align-items-center py-3 my-1">
            <div class="d-flex align-items-center">
                <p class="mb-0 text-body-secondary">&copy; 2024 - <b class="text-warning">FastFood</b></p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>