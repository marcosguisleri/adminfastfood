<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FastFood</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/icon/favicon-16x16.png">
    <link rel="manifest" href="assets/img/icon/site.webmanifest">
    <style>
        body {
            background-color: #ffffff; 
        }
        .containert {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; 
        }
        .form-container {
            max-width: 350px; 
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

<div class="containert">
    <div class="form-container">
        <!-- Logo -->
        <img class="mb-2 mx-auto d-block" src="assets/img/logo.png" alt="Logo" width="120" height="100">
        <h1 class="text-center display-5 fw-bold text-warning lh-1 mb-5">Administrativo</h1>
        <form action="processaLogin.php" method="post">
            <!-- Campo de Nome de Usuário -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="formGroupExampleInput" name="nomeUser" placeholder=" ">
                <label for="formGroupExampleInput" class="form-label">Nome de usuário:</label>
            </div>
            <!-- Campo de Senha -->
            <div class="form-floating mb-3 position-relative">
                <input type="password" class="form-control" id="formGroupExampleInput2" name="senha" placeholder=" ">
                <label for="formGroupExampleInput2" class="form-label">Senha</label>
            </div>            
            <!-- Botão de Entrar -->
            <button type="submit" class="btn btn-warning w-100 mt-2"><b>Entrar</b></button>
        </form>
    </div>
</div>

<div class="container mt-4">
    <!-- Rodapé -->
    <footer class="d-flex flex-wrap justify-content-center align-items-center py-3 my-1">
        <div class="d-flex align-items-center">
            <p class="mb-0 text-body-secondary">&copy; 2024 - <b class="text-warning">FastFood</b></p>
        </div>
    </footer>
</div>


<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
