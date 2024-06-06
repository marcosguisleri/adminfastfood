<?php

require 'config.php';
require 'dao/produtoDAO.php';
require 'controller/produtoController.php';

session_start();

$nome = '';

if (isset($_SESSION['nomeUser'])) {
    $nome = $_SESSION['nomeUser'];
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    echo "
      <META HTTP-EQUIV=REFRESH CONTENT='0; URL=editarProduto.php'>
      <script type=\"text/javascript\">
          alert(\"Erro: ID inválido!\");
      </script>
    ";
    exit();
}


$id = intval($_GET['id']);

$dao = new ProdutoDAO($pdo);
$controller = new ProdutoController($dao);

$produto = $controller->buscarProduto($id);


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
    <title>FastFood</title>
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

        body {
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px 0;
        }

        .form-container {
            max-width: 500px;
            padding: 15px;
            width: 100%;
        }

        .form-control {
            width: 100%;
        }

        button {
            width: 100%;
        }

        .form-label {
            margin-bottom: 0.5rem;
        }

        .text-smaller {
            font-size: 0.875rem;
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
        <div class="form-container">
            <h1 class="text-center text-warning mb-5">Editar Produto</h1>
            <form method="post" action="atualizaProduto.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <!-- Campo de Nome -->
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="productName" placeholder=" " name="nome" value="<?php echo htmlspecialchars($produto['nome_produto']); ?>">
                    <label for="productName" class="form-label">Nome do Produto</label>
                </div>
                <!-- Campo de Preço -->
                <div class="form-floating mb-3">
                    <input type="number" step="0.01" class="form-control" id="productPrice" placeholder=" " name="preco" value="<?php echo htmlspecialchars($produto['preco']); ?>">
                    <label for="productPrice" class="form-label">Preço</label>
                </div>
                <!-- Campo de Quantidade -->
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="productQuantity" placeholder=" " name="qtd" value="<?php echo htmlspecialchars($produto['quantidade']); ?>">
                    <label for="productQuantity" class="form-label">Quantidade</label>
                </div>
                <!-- Campo de Descrição -->
                <div class="form-floating mb-3">
                    <textarea class="form-control" id="productDescription" placeholder=" " name="desc" style="height: 100px; resize: none;"><?php echo htmlspecialchars($produto['descricao']); ?></textarea>
                    <label for="productDescription" class="form-label">Descrição</label>
                </div>
                <!-- Campo de Imagem -->
                <div class="mb-3">
                    <label for="productImage" class="form-label">Imagem do Produto</label>
                    <input class="form-control" type="file" name="imagem" accept="image/*" id="productImage">
                </div>
                <!-- Botões de Ações -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-warning"><b>Salvar Alterações</b></button>
                </div>
            </form>
        </div>
    </main>

    <footer class="container">
        <div class="d-flex flex-wrap justify-content-center align-items-center py-3 my-1">
            <div class="d-flex align-items-center">
                <p class="mb-0 text-body-secondary">&copy; 2024 - <b class="text-warning">FastFood</b></p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>