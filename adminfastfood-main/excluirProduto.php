<?php

require 'config.php';
require_once 'controller/produtoController.php';
require_once 'dao/produtoDAO.php';
require_once 'view/produtoView.php';

$dao = new ProdutoDAO($pdo);
$controller = new ProdutoController($dao);
$view = new ProdutoView();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = intval($_GET['id']);

  $controller->excluirProduto($id);
  $view->redirecionarParaHome();
} else {
  echo "
    <META HTTP-EQUIV=REFRESH CONTENT='0; URL=home.php'>
    <script type=\"text/javascript\">
        alert(\"Erro ao deletar produto!\");
    </script>
  ";
  exit();
}
