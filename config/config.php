<?php
session_start();
$config = array();
$config['name'] = 'ezhosp';
$config['host'] = 'localhost';
$config['user'] = 'root';
$config['pass'] = '';
global $pdo;
try {
	$pdo = new PDO("mysql:dbname=".$config['name'].";host=".$config['host'], $config['user'], $config['pass']);
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}
?>