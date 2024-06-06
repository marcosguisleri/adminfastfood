<?php

require 'config.php';
require_once 'controller/produtoController.php';
require_once 'dao/produtoDAO.php';
require_once 'view/produtoView.php';

session_start();

$nome = '';

if (isset($_SESSION['nomeUser'])) {
    $nome = $_SESSION['nomeUser'];
}

$dao = new ProdutoDAO($pdo);
$controller = new ProdutoController($dao);
$produtos = $controller->listarProdutos();
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
        <div class="container col-xxl-8 px-4 py-5">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                <div class="col-10 col-sm-8 col-lg-6">
                    <img src="assets/img/hero.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold text-warning lh-1 mb-3">Administre o sistema de vendas da FastFood!</h1>
                    <p class="lead">Gerencie e acompanhe as vendas de forma eficiente com nosso Sistema de Administração de Vendas, que inclui dashboards intuitivos, análises em tempo real, ferramentas de gerenciamento de clientes e relatórios automatizados. Construído com tecnologias web modernas, oferece integração perfeita, fluxos de trabalho personalizáveis e manipulação segura de dados para otimizar suas operações de vendas e aumentar a produtividade.</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <a href="cadastroProduto.php"><button type="button" class="btn btn-warning btn-lg px-4 me-md-2">Cadastrar Produto</button></a>
                        <a href="graficos.php"><button type="button" class="btn btn-outline-dark btn-lg px-4">Estatisticas</button></a>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($produtos)) : ?>
            <div class="container">
                <h1 class="display-6 fw-bold text-warning lh-1 section-title">Produtos Cadastrados</h1>
                <div class="table-responsive">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Preço</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Imagem</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produtos as $produto) : ?>
                                <tr>
                                    <td class="align-middle"><?php echo htmlspecialchars($produto['nome_produto']); ?></td>
                                    <td class="align-middle">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                                    <td class="align-middle"><?php echo htmlspecialchars($produto['quantidade']); ?></td>
                                    <td class="align-middle"><?php echo htmlspecialchars($produto['descricao']); ?></td>
                                    <td class="align-middle">
                                        <img src="<?php echo htmlspecialchars($produto['caminho_imagem']); ?>" alt="Produto" width="50" height="50">
                                    </td>
                                    <td class="align-middle">
                                        <a href="exibirProduto.php?id=<?php echo $produto['id']; ?>" class="btn btn-success btn-sm">
                                            <i class="bi bi-eye"></i> 
                                        </a>
                                        <a href="editarProduto.php?id=<?php echo $produto['id']; ?>" class="btn btn-primary btn-sm">
                                            <i class="bi bi-pencil"></i> 
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal<?php echo $produto['id']; ?>">
                                            <i class="bi bi-trash"></i> 
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="confirmDeleteModal<?php echo $produto['id']; ?>" tabindex="-1" aria-labelledby="confirmDeleteModalLabel<?php echo $produto['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmDeleteModalLabel<?php echo $produto['id']; ?>">Confirmação de Exclusão</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Tem certeza de que deseja excluir este produto?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancelar</button>
                                                        <a href="excluirProduto.php?id=<?php echo $produto['id']; ?>" class="btn btn-danger">Excluir</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>

    </main>

    <div class="container mt-4">
        <footer class="d-flex flex-wrap justify-content-center align-items-center py-3 my-1">
            <div class="d-flex align-items-center">
                <p class="mb-0 text-body-secondary">&copy; 2024 - <b class="text-warning">FastFood</b></p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>