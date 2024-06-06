<?php

session_start();

require_once 'controller/produtoController.php';
require_once 'dao/produtoDAO.php';
require_once 'view/produtoView.php';
require_once 'config.php';

$id = addslashes($_POST['id']);

if (
  isset($_POST['nome']) && !empty($_POST['nome']) &&
  isset($_POST['preco']) && !empty($_POST['preco']) &&
  isset($_POST['qtd']) && !empty($_POST['qtd']) &&
  isset($_POST['desc']) && !empty($_POST['desc']) &&
  isset($_POST['id']) && !empty($_POST['id']) &&
  isset($_FILES['imagem'])
) {
  $id = addslashes($_POST['id']);
  $nome = addslashes($_POST['nome']);
  $preco = addslashes($_POST['preco']);
  $qtd = addslashes($_POST['qtd']);
  $desc = addslashes($_POST['desc']);

  $diretorio = "assets/img/produtos/";

  $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
  $extensao = strtolower($extensao);
  $novoNome = md5(time()) . '.' . $extensao;

  if (move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio . $novoNome)) {
    $caminhoImagem = $diretorio . $novoNome;

    $dao = new ProdutoDAO($pdo);
    $controller = new ProdutoController($dao);
    $view = new ProdutoView();

    $controller->atualizaProduto($id, $nome, $preco, $qtd, $desc, $caminhoImagem);
    $view->redirecionarParaExibirProduto($id);
  }
} else {
  echo "
    <META HTTP-EQUIV=REFRESH CONTENT='0; URL=editarProduto.php?id=" . $id . "'>
    <script type=\"text/javascript\">
        alert(\"Erro: Preencha todos os campos!\");
    </script>
  ";
  exit();
}
