<?php
include 'nomes.class.php';
$dados = new Dados();

if (!empty($_GET['idpais'])) {
	$idpais = $_GET['idpais'];

	$info = $dados->getInfo($idpais);

	if (empty($info['codpais'])) {
		header("Location: acesso.php");
		exit;
	}


} else {
	header("Location: acesso.php");
	exit; 
}

?>

<h1>Editar</h1>

<form method="POST" action="editar_submit.php">
	<input type="hidden" name="idpais" value="<?php echo $info['idpais']; ?>" />
	Código do País: </br>
	<input type="number" name="codpais" value="<?php echo $info['codpais']; ?>" /> <br/></br>
	Nome do País: </br>
	<input type="text" name="nomepais" value="<?php echo $info['nomepais']; ?>" /> <br/></br>

	<input type="submit" value="Editar" />
</form>

