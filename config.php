<?php
try {
	global $pdo;
	$pdo = new PDO("mysql:dbname=projeto_multilinguagem;host=localhost", "root", "root");
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}