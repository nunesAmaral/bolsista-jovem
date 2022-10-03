
    <?php
    require('../config.php');
    require('../getitens.php');

    $id = filter_input(INPUT_POST, 'id');
    $ano = filter_input(INPUT_POST, 'ano');
    $descricao = filter_input(INPUT_POST, 'descricao');
    // var_dump($id, $ano, $descricao);
    // exit;
    if ($ano and $descricao) {

        $sql = $pdo->prepare("SELECT * FROM filosofias WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();


        if ($sql->rowCount() > 0) {
            $sql = $pdo->prepare("UPDATE filosofias SET ano = :ano, descricao = :descricao WHERE id = :id");
            $sql->bindValue(':ano', $ano);
            $sql->bindValue(':descricao', $descricao);
            $sql->bindValue(':id', $id);
            $sql->execute();

            $_SESSION['edFiloSucesso'] =  "Edição efetuada com sucesso";
            header('Location: ../../views/gerenciar-filosofia/painel-filosofia.php');
            exit;
        } else {
            $_SESSION['avisoUser!'] =  "Algo deu errado";
            header("Location: ../../views/gerenciar-filosofia/editar-filosofia.php");
            exit;
        }
    } else {
        $_SESSION['aviso-dados'] = "Tipos de dados inseridos incorretamente";
        header("Location: ../../views/gerenciar-filosofia/editar-filosofia.php");
        exit;
    }
    ?>

