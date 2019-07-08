<?php
include 'nomes.class.php';
$dados = new Dados();

if (!empty($_POST['idpais'])) {
	echo $idpais = $_POST['idpais'];
	echo $codpais = $_POST['codpais'];
	echo $nomepais = $_POST['nomepais'];

	$dados->editar($idpais, $codpais, $nomepais);
	

	header("Location: acesso.php");
}