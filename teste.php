<?php
session_start();

include "db/index.php";

if (isset($_SESSION['email'])){
    header("Location: index.php");
    exit();
}
if ($_SERVER('REQUEST_METHOD' === 'POST')){
    try{
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = 'SELECT * FROM usuario where email = :email and senha';

$stmt = $cx->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $senha);
$stmt->execute();

if($stmt->rowCount() > 0){
    $row = $stmt->fetch();

    $_SESSION['email'] =
}
}
}
?>