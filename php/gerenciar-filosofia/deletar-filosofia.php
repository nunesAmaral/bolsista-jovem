<?php
require('../config.php');
require('../getitens.php');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); //capturando o id 

if ($id) { //se o id tiver correto

    $sql = $pdo->prepare("DELETE FROM filosofias WHERE id = :id"); //query que exclui a linha de registros 
    $sql->bindValue(':id', $id);
    $sql->execute();
} else {
    $_SESSION['deleteFilosofiaError'] = "Erro em deletar filosofia";
    header('Location: ../../views/gerenciar-filosofia/painel-filosofia.php');
    exit;
}

$_SESSION['deleteFilosofia'] = "Filosofia deletada com sucesso";
header('Location: ../../views/gerenciar-filosofia/painel-filosofia.php');
exit;
