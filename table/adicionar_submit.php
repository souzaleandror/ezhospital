<?php
include 'nomes.class.php';
$dados = new Dados();


if (!empty($_POST['codpais'])) {
	$codpais = $_POST['codpais'];
	$nomepais = $_POST['nomepais'];

	$dados->adicionar($codpais, $nomepais); 

	header("Location: acesso.php");
}