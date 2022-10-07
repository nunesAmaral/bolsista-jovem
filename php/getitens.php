<?php
//GET TABLE Filosofia
session_start();

$filosofia = [];

$sql = $pdo->query("SELECT * FROM filosofias ORDER BY ano ASC");
if ($sql->rowCount() > 0) {
    $filosofia = $sql->fetchAll(PDO::FETCH_ASSOC);
};

$professores = [];

$sql = $pdo->query("SELECT *, (select professorimagem from professorimagem where iduser = p.id limit 1) as img FROM professores p ORDER BY p.nomeprofessor ASC;");
if ($sql->rowCount() > 0) {
    $professores = $sql->fetchAll(PDO::FETCH_ASSOC);
};

$sql = $pdo->query("SELECT * FROM professorimagem");
if ($sql->rowCount() > 0) {
    $imagemprofessor = $sql->fetchAll(PDO::FETCH_ASSOC);
};
