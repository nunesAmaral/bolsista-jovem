
    <?php
    require('../config.php');
    require('../getitens.php');

    $nome = filter_input(INPUT_POST, 'nomeprofessor');
    $materia = filter_input(INPUT_POST, 'materiaprofessor');
    $formacao = filter_input(INPUT_POST, 'formacaoprofessor');
    $email = filter_input(INPUT_POST, 'emailprofessor');
    $status = filter_input(INPUT_POST, 'statusprofessor');

    if ($nome and $formacao and $materia and $email and $status) {

        $sql = $pdo->prepare("SELECT * FROM professores WHERE contatoprofessor = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();


        if ($sql->rowCount() == 0) {
            $sql = $pdo->prepare("INSERT INTO professores(nomeprofessor, materiaprofessor, formacaoprofessor, contatoprofessor, status) VALUES (:nome, :materia, :formacao, :email, :status)");
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':materia', $materia);
            $sql->bindValue(':formacao', $formacao);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':status', $status);
            $sql->execute();

            $_SESSION['cadProfSucesso'] =  "Cadastro efetuado com sucesso";
        } else {
            $_SESSION['avisoProf'] =  "Email já cadastrado";
            header("Location: ../../views/gerenciar-professores/cadastro-professor.php");
            exit;
        }

        $professorID = $pdo->lastInsertId();

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
            };

            $nomeFotoProfessor = $fotoProfessor['name'];
            $diretorio = "../../assets/imagemprofessor/";
            $extensao = strtolower(pathinfo($nomeFotoProfessor, PATHINFO_EXTENSION));

            $novoNomeFotoProfessor = uniqid();

            $path = $diretorio . $novoNomeFotoProfessor . "." . $extensao;

            if (in_array($fotoProfessor['type'], array('image/jpeg', 'image/jpg', 'image/png'))) {
                $mover =  move_uploaded_file($fotoProfessor['tmp_name'], $diretorio . $novoNomeFotoProfessor . "." . $extensao);

                if ($mover) {
                    $sql = $pdo->prepare("INSERT INTO professorimagem (professorimagem, iduser) VALUES (:professorimagem, :iduser)");
                    $sql->bindValue(':professorimagem', $path);
                    $sql->bindValue(':iduser', $professorID);
                    $sql->execute();
                    header('Location: ../../views/gerenciar-professores/painel-professores.php');
                    exit;
                }
            }
        }
    } else {
        $_SESSION['aviso-dados'] = "Tipos de dados inseridos incorretamente";
        header("Location: ../../views/gerenciar-professores/cadastro-professor.php");
        exit;
    }

    ?>

