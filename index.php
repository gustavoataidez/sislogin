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
body{background-color: #d3d3d3;}
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
    <div class="container-sm d-flex justify-content-center align-items-center">

<form method="post" class="form_main mt-5">
    <p class="heading">Login</p>
    <div class="inputContainer">
    <svg fill="#2e2e2e" height="16" width="16" class="inputIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z"/></svg>
    <input placeholder="Email" id="email" class="inputField" type="email">
    </div>
    
<div class="inputContainer">
    <svg viewBox="0 0 16 16" fill="#2e2e2e" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="inputIcon">
    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
    </svg>
    <input placeholder="Senha" id="password" name="senha" class="inputField" type="password">
</div>
              
           
<button type='submit' id="button">Entrar</button>
    <div class="signupContainer">
        <p>Não tem uma conta?</p>
        <a href="register.php">Registrar-se</a>
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
</body>
</html>