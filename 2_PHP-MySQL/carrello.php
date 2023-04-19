<?php
const ARTICOLI = [
  [ 'prezzo' => 19.99, 'nome' => "Proteine" ],
  [ 'prezzo' =>  9.99, 'nome' => "Proteine" ],
  [ 'prezzo' => 15.99, 'nome' => "Proteine" ],
  [ 'prezzo' =>  4.99, 'nome' => "Proteine" ],
  [ 'prezzo' =>  7.99, 'nome' => "Proteine" ],
  [ 'prezzo' => 29.99, 'nome' => "Proteine" ],
  [ 'prezzo' => 16.99, 'nome' => "Proteine" ],
  [ 'prezzo' => 12.99, 'nome' => "Proteine" ],
  [ 'prezzo' => 17.99, 'nome' => "Proteine" ],
  [ 'prezzo' =>  5.99, 'nome' => "Proteine" ],
  [ 'prezzo' => 19.99, 'nome' => "Proteine" ],
  [ 'prezzo' =>  8.99, 'nome' => "Proteine" ],
  [ 'prezzo' => 13.99, 'nome' => "Proteine" ],
  [ 'prezzo' => 10.99, 'nome' => "Proteine" ],
  [ 'prezzo' =>  3.99, 'nome' => "Proteine" ]
];

session_start();

if (!isset($_POST['azione'])) {
  // Non fa niente
} else if ($_POST['azione'] === 'modifica') {
  $id_articolo = $_POST['id_articolo'] - 1;
  $quantita = $_POST['quantita'];

  $_SESSION['carrello'][$id_articolo] = $quantita * 1;
} else if ($_POST['azione'] === 'rimuovi') {
  $id_articolo = $_POST['id_articolo'] - 1;

  unset($_SESSION['carrello'][$id_articolo]);
}

?>

<?xml version="1.0" encoding="UTF-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>
  <title>Carrello</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2&amp;display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rampart+One&amp;display=swap" />
  <link rel="stylesheet" type="text/css" href="stile.css" />
</head>

<body>

  <div id="header">
    <h1><a href="index.html">R&amp;C GYM</a></h1>
    <table id="menu">
      <tbody>
        <tr>
          <td><a href="index.html">Homepage</a></td>
          <td><a href="corsi.html">Corsi</a></td>
          <td><a href="servizi.html">Servizi</a></td>
          <td><a href="shop.php">Shop</a></td>
          <td><a href="info.html">Informazioni</a></td>
        </tr>
      </tbody>
    </table>
    <hr />
  </div>

  <div id="contenuto">
    <h2>CARRELLO</h2>

    <pre>
      <?php var_dump($_POST); ?>
      <?php var_dump($_SESSION); ?>
    </pre>

    <div>
      <ul>
<?php
  $totale = 0;
  if (isset($_SESSION['carrello'])) {
    $carrello = $_SESSION['carrello'];
    foreach (array_keys($carrello) as $i) {
      if (!isset($carrello[$i]) || $carrello[$i] <= 0) {
        continue;
      }

      $articolo = ARTICOLI[$i];
      $quantita = $carrello[$i];

      $totale += $quantita * $articolo['prezzo'];
?>
        <li><?php echo($articolo['nome']); ?>, <?php echo($articolo['prezzo']); ?>
          <form action="carrello.php" method="post">
            <input type="hidden" name="id_articolo" value="<?php echo ($i + 1); ?>" />
            <input type="number" name="quantita" value="<?php echo($quantita); ?>" min="0" step="1" size="3" max="99" />
            <button type="submit" name="azione" value="modifica" class="button ml-8">Modifica</button>
            <button type="submit" name="azione" value="rimuovi" class="button ml-8">Rimuovi</button>
          </form> 
        </li>
        <hr class="mt-8 mb-8 hr-corsi" />
<?php
    }
  }
?>
      </ul>

<?php
    if($totale == 0) {
?>
      <h3 class="centrato prezzo">Carrello vuoto!</h3>
<?php
      header("Refresh:1.5; url=shop.php");
    }
?>

      <p class="mt-32" style="word-spacing: 15px;">Totale:  <span class="prezzo"><?php echo($totale); ?>&euro;</span> </p>
    </div>

    <div class="centrato pt-64">
      <a class="button" href="shop.php">Indietro</a>
      <a class="button ml-32 centrato">Continua ordine</a>
    </div>
  </div>

  <div id="footer">
    Copyright R&amp;C GYM 2023
  </div>

</body>

</html>
