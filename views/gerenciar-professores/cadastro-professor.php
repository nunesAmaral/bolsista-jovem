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
    <script src="../../js/cadastro-professor.js"></script>

</head>

<body>

    <?php
    require('../../php/config.php');
    require('../../php/getitens.php');
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
                </nav>
            </div>
        </header>
        <main id="edit-filo-container">
            <?php
            if (isset($_SESSION['avisoProf'])) {
                echo $_SESSION['avisoProf'];
                $_SESSION['avisoProf'] = "";
            }
            if (isset($_SESSION['errorImg'])) {
                echo $_SESSION['errorImg'];
                $_SESSION['errorImg'] = "";
            }
            if (isset($_SESSION['maxSizeImg'])) {
                echo $_SESSION['maxSizeImg'];
                $_SESSION['maxSizeImg'] = "";
            }
            if (isset($_SESSION['aviso-dados'])) {
                echo $_SESSION['aviso-dados'];
                $_SESSION['aviso-dados'] = "";
            }
            if (isset($_SESSION['typeArchive'])) {
                echo $_SESSION['typeArchive'];
                $_SESSION['typeArchive'] = "";
            }
            ?>
            <!-- <textarea cols=60 rows="10" name="descricao" maxlength="500" wrap="hard" placeholder="Descrição"></textarea> -->
            <form id="form" method="POST" action="../../php/gerenciar-professores/cadastrar-professor.php" enctype="multipart/form-data">
                <div class="formCad">
                    <div class="input">
                        <input type="text" placeholder="Digite o nome do professor" name="nomeprofessor">
                    </div>
                    <div class="input">
                        <input type="text" placeholder="Matéria em que esse professor trabalhou" name="materiaprofessor">
                    </div>
                    <div class="inputs-formacao">

                        <br>
                        <div id="formacao">
                            <div class="formacao">
                                <input type="text" placeholder="Formação profissional desse professor" name="formacaoprofessor[]">
                                <input type="text" placeholder="Local de sua formacao" name="localformacao[]">
                                <input type="number" placeholder="Ano início de suaformação" name="inicioformacao[]">
                                <input type="number" placeholder="Ano fim de sua formação" name="fimformacao[]">
                                <button type="button" onclick="adicionarCampo()"> + </button>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="input">
                        <input type="email" placeholder="Email do professor" name="emailprofessor">
                    </div>
                    <div class="input">
                        <input type="text" placeholder="Status atual do professor" name="statusprofessor">
                    </div>
                    <div class="button">
                        <input type="file" name="fotoprofessor" />
                    </div>
                    <div class="button">
                        <input class="buttons" type="submit" value="Cadastrar">
                    </div>

                </div>
            </form>

        </main>
    </div>
</body>

</html>