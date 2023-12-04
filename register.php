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
body{background-color: #bdbdbd;}
form{background: #fff;max-width:500px;}
.alert{position: absolute; margin: 10px;}
input{outline:none;box-shadow: 0 0 0 0;}
</style>

<body>
    <div class="container-sm d-flex justify-content-center">
    <form method="post" class="p-3 mt-5 rounded-3 shadow-lg p-3 mb-5 bg-white rounded">
        <h3 class="fw-bold"><span class="material-symbols-outlined">
how_to_reg
</span> Sign Up</h3>
    <div class="mb-3">
        <label for="nome" class="form-label">Name</label>
        <input type="text" class="form-control" name="nome" placeholder="Your Name">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" placeholder="name@example.com">
        <label for="pass" class="form-label">Password</label>
        <input type="password" class="form-control" name="senha" placeholder="Password">
        <button class="btn btn-primary mt-3" type='submit'>Register</button>
    </div>
    <a class="btn btn-outline-secondary" href="index.php">Back to Login</a>
    </form>    
    </div>


    <?php
session_start();

include "db/index.php";

if (isset($_SESSION['email'])) {
    header('Location: dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try{
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "insert into usuario (nome, email, senha) values (:nome, :email, :senha)";

        // $rs = $cx->query($sql);
        // $row = $rs->fetch(PDO::FETCH_ASSOC);
        $stmt = $cx->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();

        if ($stmt){
            print '<div class=alert alert-success" role="alert">Usuário cadastrado com sucesso</div>';
            exit();
        } else {
            print '<div class=alert alert-danger" role="alert">Usuário não cadastrado.</div>';
            exit();
        }
    } catch (PDOException $e){
        echo "Erro de conexão: " . $e->getMessage();
    }    
}
?>
</body>
</html>

