<?php

date_default_timezone_set('America/Maceio');

$cx=null;

// ==============  Conexao Postgres cx ==========================================
try
{
$cx = new PDO('pgsql:host=localhost;dbname=postgres', 'postgres', '123456');

$cx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e){
	echo "Servidor indisponível.";
	exit;
	//echo $e->getMessage();
}
// ==============  Conexao Postgres cx ==========================================

?>