<?php
require('../config.php');
require('../getitens.php');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {
    $sql = $pdo->prepare("DELETE FROM professores WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();
}
if ($id) {
    $sql = $pdo->prepare("DELETE FROM professorimagem WHERE iduser = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();
}

header('Location: ../../views/gerenciar-professores/painel-professores.php');
exit;
