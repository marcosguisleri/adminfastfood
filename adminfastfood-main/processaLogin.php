<?php
session_start();
require 'config.php';

if (isset($_POST['nomeUser']) && !empty($_POST['nomeUser']) && isset($_POST['senha']) && !empty($_POST['senha'])) {
    $nomeUser = addslashes($_POST['nomeUser']);
    $senha = addslashes($_POST['senha']);

    // Usando prepared statements para evitar SQL injection
    $stmt = $pdo->prepare("SELECT * FROM users WHERE nomeUser = :nomeUser AND senha = :senha");
    $stmt->bindParam(':nomeUser', $nomeUser);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $dado = $stmt->fetch();
        $_SESSION['id'] = $dado['id'];
        $_SESSION['nomeUser'] = $dado['nomeUser'];
        header("Location: home.php");
        exit();
    } else {
        echo "
            <META HTTP-EQUIV=REFRESH CONTENT='0; URL=index.php'>
            <script type=\"text/javascript\">
                alert(\"Erro: Login ou senha incorretos!\");
            </script>
        ";
        exit();
    }
} else {
    echo "
        <META HTTP-EQUIV=REFRESH CONTENT='0; URL=index.php'>
        <script type=\"text/javascript\">
            alert(\"Erro: Preencha todos os campos!\");
        </script>
    ";
    exit();
}
