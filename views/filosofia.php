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
  <script src="../js/filosofia.js"></script>

</head>

<body>

  <?php
  require('../php/config.php');
  require('../php/getitens.php');
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
          <div class="selector-area">

            <select class="input-select" name="input-select" id="input-select" onchange="handleChange(this)">
              <?php foreach ($filosofia as $ano) : ?>

                <option <?php
                        if ($ano['ano'] == $filosofia[count($filosofia) - 1]['ano']) {
                          echo 'selected';
                        }
                        ?> value="<?= $ano['id'] ?>"><?= $ano['ano'] ?></option>

              <?php endforeach; ?>

            </select>
          </div>
      </div>
      </nav>
  </div>
  </header>
  <main id="filo-container">
    <div class="filo-text">
      <h2 class="h2">Filosofia</h2>
      <?php
      foreach ($filosofia as $row) :
      ?>
        <p list-id="<?= $row['id'] ?>" class="desc-item <?php
                                                        if ($row['ano'] == $filosofia[count($filosofia) - 1]['ano']) {
                                                          echo '';
                                                        } else {
                                                          echo 'hide';
                                                        }
                                                        ?>">
          <?php echo $row['descricao']; ?>
        </p>
      <?php endforeach; ?>
    </div>
  </main>
  </div>
</body>

</html>