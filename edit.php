<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIS Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<style>
body{background-color: #d3d3d3;}
form{background: #fff;max-width:500px;}
.alert{position: absolute; margin: 10px;}
input{outline:none;box-shadow: 0 0 0 0;}
</style>

<body>
    <div class="container-sm d-flex justify-content-center">
    <form method="post" class="p-3 mt-5 rounded-3 shadow-lg p-3 mb-5 bg-white rounded">
        <h3 class="fw-bold">Edite sua senha</h3>
    <div class="mb-3">
        <label for="pass" class="form-label">Sua nova senha</label>
        <input type="password" class="form-control" name="senha" placeholder="senha">
        <button class="btn btn-primary mt-3" type='submit'>Enviar</button></div>
        <a class="btn btn-outline-secondary" href="dashboard.php">Voltar para Início</a>
</form>

    <?php
session_start();

include "db/index.php";

if (!isset($_SESSION['email'])){
    header("Location: index.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    try{
        $email = $_SESSION['email'];
        $senha = $_POST['senha'];

        $sql = "UPDATE usuario SET senha = :senha WHERE email = :email";

        $stmt = $cx->prepare($sql);
        $stmt->bindParam(':senha',$senha);
        $stmt->bindParam(':email',$email);
        $stmt->execute();

        if($stmt){
            print '<div class="alert alert-sucess" role="alert">Senha alterada com sucesso.</div>';
            exit();
        } else {
            echo "Algo deu errado.";
            exit();
        }
    } catch (PDOException $e){
        echo "Erro de conexão: " . $e->getMessage();
    }
}
?>
</div>
</body>
</html>