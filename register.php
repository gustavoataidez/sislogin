<?php

session_start();

?>

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

.form_main {
  width:80%;
  max-width: 350px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  background-color: rgb(255, 255, 255);
  padding: 30px 30px 30px 30px;
  border-radius: 30px;
  box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.062);
}

.heading {
  font-size: 2.5em;
  color: #2e2e2e;
  font-weight: 700;
  margin: 15px 0 30px 0;
}

.inputContainer {
  width: 100%;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
}

.inputIcon {
  position: absolute;
  left: 10px;
}

.inputField {
  width: 100%;
  height: 40px;
  background-color: transparent;
  border: none;
  border-bottom: 2px solid rgb(173, 173, 173);
  border-radius: 30px;
  margin: 10px 0;
  color: black;
  font-size: .8em;
  font-weight: 500;
  box-sizing: border-box;
  padding-left: 30px;
}

.inputField:focus {
  outline: none;
  border-bottom: 2px solid rgb(199, 114, 255);
}

.inputField::placeholder {
  color: rgb(80, 80, 80);
  font-size: 1em;
  font-weight: 500;
}

#button {
  position: relative;
  width: 100%;
  border: 2px solid #1c5560;
  background-color: #1c5560;
  height: 40px;
  color: white;
  font-size: .8em;
  font-weight: 500;
  letter-spacing: 1px;
  border-radius: 30px;
  margin: 10px;
  cursor: pointer;
  overflow: hidden;
}

#button::after {
  content: "";
  position: absolute;
  background-color: rgba(255, 255, 255, 0.253);
  height: 100%;
  width: 150px;
  top: 0;
  left: -200px;
  border-bottom-right-radius: 100px;
  border-top-left-radius: 100px;
  filter: blur(10px);
  transition-duration: .5s;
}

#button:hover::after {
  transform: translateX(600px);
  transition-duration: .5s;
}

.signupContainer {
  margin: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 10px;
}

.signupContainer p {
  font-size: .9em;
  font-weight: 500;
  color: black;
}

.signupContainer a {
  font-size: .8em;
  font-weight: 500;
  background-color: #2e2e2e;
  color: white;
  text-decoration: none;
  padding: 8px 15px;
  border-radius: 20px;
}



</style>

<body>
    <div class="container-sm d-flex justify-content-center">

    <form method="post" class="form_main mt-5">
    <p class="heading">Registrar</p>
<div class="inputContainer">
    <input placeholder="Nome" id="nome" name="nome" class="inputField" type="text">
</div>
<div class="inputContainer">
    <input placeholder="name@example.com" id="email" name="email" class="inputField" type="email">
</div>
<div class="inputContainer">
    <input placeholder="Senha" id="password" name="senha" class="inputField" type="password">
</div>
              
           
<button type='submit' id="button">Registrar</button>
    <div class="signupContainer">
        <p>Já tem uma conta?</p>
        <a href="index.php">Fazer login</a>
    </div>
</form>
    </div>


    <?php

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

