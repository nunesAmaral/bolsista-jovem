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


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>

    <!-- requisição conexão com o banco e querys principais db -->
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
            </div>
            </nav>
    </div>
    </header>
    <main id="filo-container">

        <!-- avisos  -->
        <?php
        if (isset($_SESSION['cadFilosucesso'])) {
            echo $_SESSION['cadFilosucesso'];
            $_SESSION['cadFilosucesso'] = "";
        }
        if (isset($_SESSION['edFiloSucesso'])) {
            echo $_SESSION['edFiloSucesso'];
            $_SESSION['edFiloSucesso'] = "";
        }
        if (isset($_SESSION['deleteFilosofia'])) {
            echo $_SESSION['deleteFilosofia'];
            $_SESSION['deleteFilosofia'] = "";
        }
        if (isset($_SESSION['deleteFilosofiaError'])) {
            echo $_SESSION['deleteFilosofiaError'];
            $_SESSION['deleteFilosofiaError'] = "";
        }
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Ano</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filosofia as $item) : ?>
                    <tr>
                        <td><?php echo $item['ano']; ?></td>
                        <td><?php echo $item['descricao']; ?></td>
                        <td>
                            <a href="editar-filosofia.php?id=<?= $item['id']; ?>">Editar</a>
                            <a href="../../php/gerenciar-filosofia/deletar-filosofia.php?id=<?= $item['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                            <!-- Botões para editar e excluir o registro na tabela -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/magnify/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script src="https://kit.fontawesome.com/9884a810af.js" crossorigin="anonymous"></script>
</body>

</html>