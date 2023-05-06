<?php
require_once("connessione.php");

$conn_db = connessione_db();

session_start();

if (!isset($_POST['azione'])) {
  // Non fa niente
} else if ($_POST['azione'] === 'modifica') {
  $id_articolo = $_POST['id_articolo'];
  $quantita = $_POST['quantita'];

  $_SESSION['carrello'][$id_articolo] = $quantita * 1;
} else if ($_POST['azione'] === 'rimuovi') {
  $id_articolo = $_POST['id_articolo'];

  unset($_SESSION['carrello'][$id_articolo]);
} else if ($_POST['azione'] === 'svuota') {
  unset($_SESSION['carrello']);
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

    <div>
      <ul id="lista-carrello">
<?php
  $totale = 0;
  if (isset($_SESSION['carrello'])) {
    $query = "SELECT * FROM " . TBL_PRODOTTI;
    $result = mysqli_query($conn_db, $query);
    if (!$result) {
      printf("Errore nella query.\n");
      exit();
    }

    while ($articolo = mysqli_fetch_assoc($result)) {
      if (!isset($_SESSION['carrello'][$articolo['id']])) {
        continue;
      }

      $quantita = $_SESSION['carrello'][$articolo['id']];
      if ($quantita <= 0) {
        continue;
      }

      $totale += $quantita * $articolo['prezzo'];
?>
        <li><?php echo($articolo['nome']); ?>, <?php echo($articolo['prezzo']); ?> &euro;
          <form class="mt-8" action="carrello.php" method="post">
            <input type="hidden" name="id_articolo" value="<?php echo ($articolo['id']); ?>" />
            <input type="number" name="quantita" value="<?php echo($quantita); ?>" min="0" step="1" size="3" max="99" />
            <button type="submit" name="azione" value="modifica" class="button-icona ml-8" title="modifica quantit&agrave;">&#x01F4DD</button>
            <button type="submit" name="azione" value="rimuovi" class="button-icona ml-8" title="rimuovi elemento">&#x01F5D1</button>
          </form>
        </li>
        <hr class="mt-8 mb-8 hr-corsi" />
<?php
    }
  }
?>
      </ul>

<?php
    if ($totale === 0) {
?>
      <h1 class="centrato prezzo">Carrello vuoto!</h1>
<?php
    }
?>

      <p id="risultato-carrello" class="mt-32">
        <b>Totale</b>:
        <span class="prezzo"><?php echo($totale); ?>&euro;</span>
      </p>
    </div>

    <div class="centrato pt-64">
      <form action="carrello.php" method="post">
        <a id="indietro-carrello" class="button" href="shop.php">Indietro</a>
        <button type="submit" name="azione" value="acquista" class="button ml-8">Prosegui ordine</button>
      </form>
    </div>
  </div>

  <div id="footer">
    Copyright R&amp;C GYM 2023
  </div>

</body>

</html>
