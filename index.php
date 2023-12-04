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
        <h3 class="fw-bold"><span class="material-symbols-outlined">login</span> SIS Login</h3>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" placeholder="nome@examplo.com">
        <label for="pass" class="form-label">Senha</label>
        <input type="password" class="form-control" name="senha" placeholder="senha"></div>
        <button class="btn btn-primary" type='submit'>Entrar</button>
        <a class="btn btn-outline-secondary" href="register.php">Registre-se aqui</a>
    </form>   
    
    <?php
session_start();

include "db/index.php";

if (isset($_SESSION['email'])) {
    header('Location: dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try{
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT nome, email from usuario where email = :email and senha = :senha";

        // $rs = $cx->query($sql);
        // $row = $rs->fetch(PDO::FETCH_ASSOC);
        $stmt = $cx->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();

        if ($stmt->rowCount() > 0){
            $row = $stmt->fetch();

            $_SESSION['email'] = $email;
            $_SESSION['nome'] = $row['nome'];
            $_SESSION['senha'] = $senha;

            header("Location: dashboard.php");
            exit();
        } else {
            print '<div class="alert alert-danger" role="alert">Login inválido. Tente novamente</div>';
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