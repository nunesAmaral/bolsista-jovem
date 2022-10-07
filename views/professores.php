<?php
require('../php/config.php');
require('../php/getitens.php');

?>

<!DOCTYPE html>
<html lang="pt-BR ">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jovem</title>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;0,900;1,400;1,500&display=swap" rel="stylesheet">
</head>

<body>
    <div id="container">
        <header>
            <span class="logo">Escola jovem <span>.</span></span>
            <div id="navbar">
                <nav>
                    <ul>
                        <li><a href="#">Projetos</a></li>
                        <li><a href="#">Filosofia</a></li>
                        <li><a href="#">Contato</a></li>
                        <li><a href="#">Direção</a></li>
                        <li><a href="#">Formandos</a></li>
                        <li><a href="#">Professores</a></li>
                    </ul>
                </nav>
            </div>
    </div>
    </div>


    <div id="containerProfessor">
        <div class="profLeft">
            <h1 class="profTitle">Professores</h1>
            <?php foreach ($professores as $item) : ?>
                <div value="<?= $item['id'] ?>" onclick="change(this)" class="profInfo">
                    <p class="profNome">Prof. <?= ucfirst($item['nomeprofessor']); ?></p>
                    <p class="profMateria"><?= ucfirst($item['materiaprofessor']); ?></p>
                    <img src="../assets/setaprofessores.svg">
                </div>
            <?php endforeach; ?>
        </div>

        <?php foreach ($professores as $professor) :
            $formacoes = [];
            $sql = $pdo->query("SELECT * from professorformacao WHERE iduser = {$professor['id']}");
            if ($sql->rowCount() > 0) {
                $formacoes = $sql->fetchAll(PDO::FETCH_ASSOC);
            };

        ?>
            <div list-id="<?= $professor['id'] ?>" class="profRight hide">
                <div class="profHeader">
                    <img class="profImagem" src="../assets/imagemprofessor/<?= isset($professor['img']) ? "../../assets/imagemprofessor/" . $professor['img'] : '../../assets/userdefault.png'  ?>">
                    <p class="profSubtitulo">Prof. <?= $professor['nomeprofessor']; ?></p>
                </div>
                <div class="profFormacao">
                    <h4 class="formacaoTitulo">Formação:</h4>
                    <?php foreach ($formacoes as $formacao) : ?>
                        <p> <?= $formacao['descricao'] . " - " . $formacao['instituicaoformacao'] . " - " . $formacao['anoinicio'] . " à " . $formacao['anofim'] ?></p>
                    <?php endforeach; ?>
                </div>
                <div class="profContato">
                    <h4 class="contatoTitulo">Contatos:</h4>
                    <p class="descricaoContato"><?= $professor['contatoprofessor']; ?></p>
                </div>
                <div class="profContato">
                    <h4 class="contatoTitulo">Status:</h4>
                    <p class="descricaoContato"><?= $professor['status']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <script src="../js/professores.js"></script>
</body>

</html>