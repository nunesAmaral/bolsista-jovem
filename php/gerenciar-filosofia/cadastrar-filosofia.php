
    <?php
    require('../config.php');
    require('../getitens.php');

    $ano = filter_input(INPUT_POST, 'ano');
    $descricao = filter_input(INPUT_POST, 'descricao');

    if ($ano and $descricao) {

        $sql = $pdo->prepare("SELECT * FROM filosofias WHERE ano = :ano");
        $sql->bindValue(':ano', $ano);
        $sql->execute();


        if ($sql->rowCount() == 0) {
            $sql = $pdo->prepare("INSERT INTO filosofias(ano, descricao) VALUES (:ano, :descricao)");
            $sql->bindValue(':ano', $ano);
            $sql->bindValue(':descricao', $descricao);
            $sql->execute();

            $_SESSION['cadFiloSucesso'] =  "Cadastro efetuado com sucesso";
            header('Location: ../../views/gerenciar-filosofia/painel-filosofia.php');
            exit;
        } else {
            $_SESSION['avisoUser!'] =  "Ano já cadastrado";
            header("Location: ../../views/gerenciar-filosofia/cadastro-filosofia.php");
            exit;
        }
    } else {
        $_SESSION['aviso-dados'] = "Dados inseridos incorretamente";
        header("Location: ../../views/gerenciar-filosofiacadastro-filosofia.php");
        exit;
    }
    ?>

