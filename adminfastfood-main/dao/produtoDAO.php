<?php
class ProdutoDAO
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function cadastrar($nome, $preco, $qtd, $descricao, $caminhoImagem)
  {
    $stmt = $this->pdo->prepare("INSERT INTO produtos (nome_produto, preco, quantidade, descricao, caminho_imagem) VALUES (:nome, :preco, :qtd, :descricao, :caminhoImagem)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':qtd', $qtd);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':caminhoImagem', $caminhoImagem);
    $stmt->execute();
  }

  public function buscarProduto($id)
  {
    $stmt = $this->pdo->prepare("SELECT * FROM produtos WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return $stmt->fetch();
    } else {
      return false;
    }
  }

  public function listarProdutos()
  {
    $stmt = $this->pdo->prepare("SELECT * FROM produtos");
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return $stmt->fetchAll();
    } else {
      return false;
    }
  }

  public function excluirProduto($id)
  {
    $stmt = $this->pdo->prepare("DELETE FROM produtos WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
  }

  public function atualizaProduto($id, $nome, $preco, $qtd, $descricao, $caminhoImagem)
  {
    $stmt = $this->pdo->prepare("UPDATE produtos SET nome_produto = :nome, preco = :preco, quantidade = :qtd, descricao = :descricao, caminho_imagem = :caminhoImagem WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':qtd', $qtd);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':caminhoImagem', $caminhoImagem);
    $stmt->execute();
  }
}
