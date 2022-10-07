
    <?php
    require('../config.php');
    require('../getitens.php');

    $nome = filter_input(INPUT_POST, 'nomeprofessor');
    $materia = filter_input(INPUT_POST, 'materiaprofessor');
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

    if ($nome and  $materia and $email and $status and $dadosformacao) {

        $sql = $pdo->prepare("SELECT * FROM professores WHERE contatoprofessor = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();


        if ($sql->rowCount() == 0) {
            $sql = $pdo->prepare("INSERT INTO professores(nomeprofessor, materiaprofessor, contatoprofessor, status) VALUES (:nome, :materia, :email, :status)");
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':materia', $materia);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':status', $status);
            $sql->execute();
        } else {
            $_SESSION['avisoProf'] =  "Email já cadastrado";
            header("Location: ../../views/gerenciar-professores/cadastro-professor.php");
            exit;
        }

        $professorID = $pdo->lastInsertId();


        for ($i = 0; $i < count($dadosformacao['formacaoprofessor']); $i++) {
            $sql = $pdo->prepare("INSERT INTO professorformacao (anoinicio, anofim, descricao, instituicaoformacao, iduser)
                VALUES (:anoinicio, :anofim, :descricao, :localf, :iduser)");
            $sql->bindValue(':anoinicio', $dadosformacao['inicioformacao'][$i]);
            $sql->bindValue(':anofim', $dadosformacao['fimformacao'][$i]);
            $sql->bindValue(':descricao', $dadosformacao['formacaoprofessor'][$i]);
            $sql->bindValue(':localf', $dadosformacao['localformacao'][$i]);
            $sql->bindValue(':iduser', $professorID);
            $sql->execute();
        }

        if (isset($_FILES['fotoprofessor'])) {
            $fotoProfessor = $_FILES["fotoprofessor"];

            if ($fotoProfessor['error']) {
                $_SESSION['errorImg'] = "Falha ao enviar arquivo";
                header("location:  ../../views/gerenciar-professores/cadastro-professor.php");
                exit;
            }

            if ($fotoProfessor['size'] > 2097152) {
                $_SESSION['maxSizeImg'] = "Arquivo muito grande, máximo 2MB";
                header("location: ../../views/gerenciar-professores/cadastro-professor.php");
                exit;
            };

            $nomeFotoProfessor = $fotoProfessor['name'];
            $diretorio = "../../assets/imagemprofessor/";
            $extensao = strtolower(pathinfo($nomeFotoProfessor, PATHINFO_EXTENSION));

            $novoNomeFotoProfessor = uniqid();

            $path = $novoNomeFotoProfessor . "." . $extensao;

            if (in_array($fotoProfessor['type'], array('image/jpeg', 'image/jpg', 'image/png'))) {
                $mover =  move_uploaded_file($fotoProfessor['tmp_name'], $novoNomeFotoProfessor . "." . $extensao);

                if ($mover) {
                    $sql = $pdo->prepare("INSERT INTO professorimagem (professorimagem, iduser) VALUES (:professorimagem, :iduser)");
                    $sql->bindValue(':professorimagem', $path);
                    $sql->bindValue(':iduser', $professorID);
                    $sql->execute();
                    $_SESSION['cadProfSucesso'] =  "Cadastro efetuado com sucesso";
                    header('Location: ../../views/gerenciar-professores/painel-professores.php');
                    exit;
                }
            } else {
                $_SESSION['typeArchive'] =  "Tipo de arquivo não aceito, adicione um arquivo png, jpeg ou jpg";
                header('Location: ../../views/gerenciar-professores/cadastro-professor.php');
                exit;
            }
        }
    } else {
        $_SESSION['aviso-dados'] = "Tipos de dados inseridos incorretamente";
        header("Location: ../../views/gerenciar-professores/cadastro-professor.php");
        exit;
    }

    ?>

