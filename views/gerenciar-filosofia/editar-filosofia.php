<!DOCTYPE html>
<html lang="pt-BR ">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jovem</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;0,900;1,400;1,500&display=swap" rel="stylesheet">
    <script src="../js/filosofia.js"></script>

</head>

<body>
    <!-- requisição conexão com o banco e querys principais db -->
    <?php
    require('../../php/config.php');
    require('../../php/getitens.php');

    $filosofia = [];
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if ($id) {
        $sql = $pdo->prepare('SELECT * FROM filosofias WHERE id = :id');
        $sql->bindValue('id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {

            $filosofia = $sql->fetch(PDO::FETCH_ASSOC);
        } else {
            header('Location: painel-filosofia.php');
            exit;
        }
    } else {
        header('Location: painel-filosofia.php');
        exit;
    }

    ?>

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
            </div>
            </nav>
    </div>
    </header>
    <main id="edit-filo-container">
        <!-- avisos -->
        <?php
        if (isset($_SESSION['avisoUser'])) {
            echo $_SESSION['avisoUser'];
            $_SESSION['avisoUser'] = "";
        }
        if (isset($_SESSION['avisoDados'])) {
            echo $_SESSION['avisoDados'];
            $_SESSION['avisoDados'] = "";
        }
        ?>
        <form method="POST" action="../../php/gerenciar-filosofia/editar-filosofia.php">
            <input type="hidden" name="id" value="<?= $filosofia['id'] ?>">
            <div class="formCad">
                <div class="input">
                    <input type="number" placeholder="Ano do cadastro" value="<?= $filosofia['ano']; ?>" name="ano">
                </div>
                <div class="input">
                    <textarea cols=60 rows="10" name="descricao" maxlength="500" wrap="hard" placeholder="Descrição"><?= $filosofia['descricao']; ?></textarea>
                </div>
                <div class="button">
                    <input class="buttons" type="submit" value="cadastrar">
                </div>
            </div>
        </form>

    </main>
    </div>
</body>

</html>