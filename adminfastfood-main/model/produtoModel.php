<?php

require_once 'model/produtoModel.php';

class ProdutoModel
{
  private $nome;
  private $preco;
  private $qtd;
  private $descricao;
  private $caminhoImagem;

  public function __construct($nome, $preco, $qtd, $descricao, $caminhoImagem)
  {
    $this->nome = $nome;
    $this->preco = $preco;
    $this->qtd = $qtd;
    $this->descricao = $descricao;
    $this->caminhoImagem = $caminhoImagem;
  }
}
