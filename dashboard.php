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
$nome = $_SESSION['nome'];
$email = $_SESSION['email'];
$senha = $_SESSION['senha'];
$nome = mb_convert_case($nome, MB_CASE_TITLE, "UTF-8");
    ?>


<body>
    <nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold">SIS Login</a>
    <div>
    <a class="fw-bold" href="edit.php">Edite sua senha</a>
    <a class="btn btn-danger" href="logout.php">Sair</a>
    </div>
  </div>
</nav>
<div class="p-5">
<h3>Seja bem-vindo(a) <?php echo $nome;?>. O conselho do dia é:</h3>

<?php
$urlApi = 'https://api.adviceslip.com/advice';

$ch = curl_init($urlApi);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$data = curl_exec($ch);

if(curl_errno($ch)){
  echo "Erro na requisição na cURL/: " . curl_error($ch);
} else {
  $result = json_decode($data,true);
  if($result !== NULL){
    echo $result['slip']['advice'];
  } else {
    echo 'Falha ao decodificar os dados JSON';
  }
}

CURL_CLOSE($ch)

// $apiUrl = 'https://api.adviceslip.com/advice';

// $ch = curl_init($apiUrl);

// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// $data = curl_exec($ch);

// if(curl_errno($ch)){
//   echo 'Erro na  requisição cURL: ' . curl_error($ch);
// } else {
//   $result = json_decode($data, true);
//   if($result !== null){
//     echo $result['slip']['advice'];
//   } else {
//     echo "Falha ao decodificar os dados JSON";
//   }
// }
// curl_close($ch);
?></h4>

</div>
</body>
</html>