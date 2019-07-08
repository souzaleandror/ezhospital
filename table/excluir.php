<?php
include 'nomes.class.php';
$dados = new Dados();


if(!empty($_GET['idpais'])) {
	
	$idpais = $_GET['idpais'];

	$dados->excluir($idpais);	
}

header("Location: acesso.php");

