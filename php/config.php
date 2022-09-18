<?php //arquivo pra armazenar a configurção de conexão do banco de dados

// DADOS CONEXÃO

$db_name = "projeto-jovem";
$db_host = "localhost";
$db_user = "root";
$db_pass = "";

//definindo os dados da conexão em variáveis se torna mais fácil alterar alguma coisa futuramente

$pdo = new PDO("mysql:dbname=" . $db_name . ";host=" . $db_host, $db_user, $db_pass);


