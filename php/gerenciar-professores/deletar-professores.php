<?php
require('../config.php');
require('../getitens.php');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {
    $sql = $pdo->prepare("DELETE FROM professores WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();
} else {
    $_SESSION['errorDeleteProf'] = "Falha ao deletar professor";
    header('Location: ../../views/gerenciar-professores/painel-professores.php');
    exit;
}
if ($id) {
    $sql = $pdo->prepare("DELETE FROM professorimagem WHERE iduser = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();
}
if ($id) {
    $sql = $pdo->prepare("DELETE FROM professorformacao WHERE iduser = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();
}


$_SESSION['deleteProf'] = "Professor deletado com sucesso";
header('Location: ../../views/gerenciar-professores/painel-professores.php');
exit;
