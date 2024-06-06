<?php
class ProdutoView
{
  public function redirecionarParaExibirProduto($id)
  {
    $url = "exibirProduto.php?id=" . urlencode($id);
    header("Location: $url");
    exit();
  }

  public function redirecionarParaHome()
  {
    $url = "home.php";
    header("Location: $url");
    exit();
  }

  public function redirecionarParaCadastroProduto()
  {
    $url = "cadastroProduto.php";
    header("Location: $url");
    exit();
  }

  public function redirecionarParaLogout()
  {
    $url = "logout.php";
    header("Location: $url");
    exit();
  }
}
