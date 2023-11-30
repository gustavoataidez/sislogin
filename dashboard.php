<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIS Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}
$nome = $_SESSION['email'];
$nome = mb_convert_case($nome, MB_CASE_TITLE, "UTF-8");
    ?>
<body>
    <nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold">SIS Login</a>
    <a class="btn btn-danger" href="logout.php">Logout</a>
  </div>
</nav>
<h3 class=" p-5">Seja bem-vindo(a) <?php echo $nome;?>.</h3>
</body>
</html>