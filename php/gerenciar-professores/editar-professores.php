
    <?php
    require('../config.php');
    require('../getitens.php');

    $id = filter_input(INPUT_POST, 'id');
    $nome = filter_input(INPUT_POST, 'nomeprofessor');
    $materia = filter_input(INPUT_POST, 'materiaprofessor');
    $formacao = filter_input(INPUT_POST, 'formacaoprofessor');
    $email = filter_input(INPUT_POST, 'emailprofessor');
    $status = filter_input(INPUT_POST, 'statusprofessor');

    $filters = array(
        'formacaoprofessor' => array(
            'filter' => FILTER_DEFAULT,
            'flags' => FILTER_REQUIRE_ARRAY
        ),
        'localformacao' => array(
            'filter' => FILTER_DEFAULT,
            'flags' => FILTER_REQUIRE_ARRAY
        ),
        'inicioformacao' => array(
            'filter' => FILTER_VALIDATE_INT,
            'flags' => FILTER_REQUIRE_ARRAY
        ),
        'fimformacao' => array(
            'filter' => FILTER_VALIDATE_INT,
            'flags' => FILTER_REQUIRE_ARRAY
        )
    );

    $dadosformacao = filter_input_array(INPUT_POST, $filters);

    if ($nome and $formacao and $materia and $email and $status) {

        $sql = $pdo->prepare("SELECT * FROM professores WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();


        if ($sql->rowCount() > 0) {
            $sql = $pdo->prepare("UPDATE professores SET nomeprofessor = :nome,  materiaprofessor = :materia, formacaoprofessor = :formacao, contatoprofessor = :email, status = :status where id = :id");
            $sql->bindValue(':id', $id);
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':materia', $materia);
            $sql->bindValue(':formacao', $formacao);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':status', $status);
            $sql->execute();

            $_SESSION['edProfSucesso'] =  "Edição efetuada com sucesso";
        } else {
            $_SESSION['avisoProf'] =  "Email já cadastrado";
            header("Location: ../../views/gerenciar-professores/editar-professor.php");
            exit;
        }


        if (($dadosformacao)) {
            for ($i = 0; $i < count($dadosformacao['formacaoprofessor']); $i++) {
                $sql = $pdo->prepare("UPDATE professorformacao SET (anoinicio = :anoinicio, anofim = :anofim, descricao = :descricao, instituicaoformacao= :localf 
                WHERE iduser = :iduser)");
                $sql->bindValue(':anoinicio', $dadosformacao['inicioformacao'][$i]);
                $sql->bindValue(':anofim', $dadosformacao['fimformacao'][$i]);
                $sql->bindValue(':descricao', $dadosformacao['formacaoprofessor'][$i]);
                $sql->bindValue(':localf', $dadosformacao['localformacao'][$i]);
                $sql->bindValue(':iduser', $professorID);
                $sql->execute();
            }
        }
        exit;

        if (isset($_FILES['fotoprofessor'])) {
            $fotoProfessor = $_FILES["fotoprofessor"];

            if ($fotoProfessor['error']) {
                $_SESSION['errorImg'] = "Falha ao enviar arquivo";
                header("location:  ../../views/gerenciar-professores/editar-professor.php");
                exit;
            }

            if ($fotoProfessor['size'] > 2097152) {
                $_SESSION['maxSizeImg'] = "Arquivo muito grande, máximo 2MB";
                header("location: ../../views/gerenciar-professores/editar-professor.php");
            };

            $nomeFotoProfessor = $fotoProfessor['name'];
            $diretorio = "../../assets/imagemprofessor/";
            $extensao = strtolower(pathinfo($nomeFotoProfessor, PATHINFO_EXTENSION));

            $novoNomeFotoProfessor = uniqid();

            $path = $novoNomeFotoProfessor . "." . $extensao;

            if (in_array($fotoProfessor['type'], array('image/jpeg', 'image/jpg', 'image/png'))) {
                $mover =  move_uploaded_file($fotoProfessor['tmp_name'], $diretorio . $novoNomeFotoProfessor . "." . $extensao);

                if ($mover) {
                    $sql = $pdo->prepare("SELECT * FROM professorimagem WHERE iduser = :id");
                    $sql->bindValue(':id', $id);
                    $sql->execute();

                    if ($sql->rowCount() == 0) {
                        $sql = $pdo->prepare("INSERT INTO professorimagem (professorimagem, iduser) VALUES (:professorimagem, :iduser)");
                        $sql->bindValue(':professorimagem', $path);
                        $sql->bindValue(':iduser', $id);
                        $sql->execute();
                        header('Location: ../../views/gerenciar-professores/painel-professores.php');
                        exit;
                    } else {
                        $sql = $pdo->prepare("UPDATE professorimagem set professorimagem = :professorimagem where iduser = :iduser ");
                        $sql->bindValue(':professorimagem', $path);
                        $sql->bindValue(':iduser', $id);
                        $sql->execute();
                        header('Location: ../../views/gerenciar-professores/painel-professores.php');
                        exit;
                    }
                }
            }
        }
    } else {
        $_SESSION['aviso-dados'] = "Tipos de dados inseridos incorretamente";
        header("Location: ../../views/gerenciar-professores/editar-professor.php");
        exit;
    }
    ?>

