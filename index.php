<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIS Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<style>
body{background-color: #f1f1f1;}
form{background: #fff;}
.alert{position: absolute; margin: 10px;}
</style>

<body>
    <div class="container-sm ">
    <form method="post" class="p-3 mt-5 rounded-3">
        <h3>Login</h3>
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" placeholder="name@example.com">
        <label for="pass" class="form-label">Password</label>
        <input type="password" class="form-control" name="senha" placeholder="Password">
        <button class="btn btn-primary mt-3" type='submit'>Send</button></div>
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
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "select nome, email from usuario where email = :email and senha = :senha";

        // $rs = $cx->query($sql);
        // $row = $rs->fetch(PDO::FETCH_ASSOC);
        $stmt = $cx->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();

        if ($stmt->rowCount() > 0){
            $row = $stmt->fetch();
            $_SESSION['email'] = $row['nome'];

            header("Location: dashboard.php");
            exit();
        } else {
            print '<script>alert("Login inválido")</script>';
        }
    } catch (PDOException $e){
        echo "Erro de conexão: " . $e->getMessage();
    }    
}
?>
</body>
</html>

