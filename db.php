<?php
$host = 'mysql'; 
$usuario = 'usuario1234';
$senha = 'senha1234';
$banco_de_dados = 'databasephp';

$conn = new mysqli($host, $usuario, $senha, $banco_de_dados);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>