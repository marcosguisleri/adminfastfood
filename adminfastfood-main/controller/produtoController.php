<?php
class ProdutoController
{
  private $produtoDAO;

  public function __construct($produtoDAO)
  {
    $this->produtoDAO = $produtoDAO;
  }

  public function cadastrar($nome, $preco, $qtd, $descricao, $caminhoImagem)
  {
    $this->produtoDAO->cadastrar($nome, $preco, $qtd, $descricao, $caminhoImagem);
  }

  public function buscarProduto($id)
  {
    return $this->produtoDAO->buscarProduto($id);
  }

  public function listarProdutos()
  {
    return $this->produtoDAO->listarProdutos();
  }

  public function excluirProduto($id)
  {
    $this->produtoDAO->excluirProduto($id);
  }

  public function atualizaProduto($id, $nome, $preco, $qtd, $descricao, $caminhoImagem)
  {
    $this->produtoDAO->atualizaProduto($id, $nome, $preco, $qtd, $descricao, $caminhoImagem);
  }
}
