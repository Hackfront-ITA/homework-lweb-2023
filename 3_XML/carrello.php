<?php
require_once('connessione.php');
require_once('operazioni.php');

$conn_db = connessione_db();

session_start();

if (isset($_POST['azione']) && $_POST['azione'] === 'ricarica_credito') {
  $credito = $_POST['credito'];
  $id_utente = $_SESSION['id_utente'];
  op_aggiorna_credito($conn_db, $id_utente, $credito);
}

if (!isset($_POST['azione'])) {
  // Non fa niente
} else if ($_POST['azione'] === 'modifica') {
  $id_articolo = $_POST['id_articolo'];
  $quantita = $_POST['quantita'];

  $_SESSION['carrello'][$id_articolo] = $quantita * 1;
} else if ($_POST['azione'] === 'rimuovi') {
  $id_articolo = $_POST['id_articolo'];

  unset($_SESSION['carrello'][$id_articolo]);
}
?>
<?xml version="1.0" encoding="UTF-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>
  <title>Carrello &ndash; R&amp;C gym</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2&amp;display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rampart+One&amp;display=swap" />
  <link rel="stylesheet" type="text/css" href="stile.css" />
</head>

<body>

  <div id="header">
    <h1><a href="index.php">R&amp;C GYM</a></h1>
    <span id="btn-log">
<?php if (isset($_SESSION['id_utente'])) { ?>
      <a href="logout.php?redirect=carrello.php">LOGOUT</a>
<?php } else { ?>
      <a href="login.php?redirect=carrello.php">LOGIN</a>
<?php } ?>
    </span>
    <table id="menu">
      <tbody>
        <tr>
          <td><a href="index.php">Homepage</a></td>
          <td><a href="corsi.php">Corsi</a></td>
          <td><a href="servizi.php">Servizi</a></td>
          <td><a href="shop.php">Shop</a></td>
          <td><a href="info.php">Informazioni</a></td>
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
      $_SESSION['totale_ordine'] = $totale;
?>
        <li><?php echo($articolo['nome']); ?>, <?php echo($articolo['prezzo']); ?> &euro;
          <form class="mt-8" action="carrello.php" method="post">
            <input type="hidden" name="id_articolo" value="<?php echo ($articolo['id']); ?>" />
            <input type="number" name="quantita" value="<?php echo($quantita); ?>" min="0" step="1" size="3" max="99" />
            <button type="submit" name="azione" value="modifica" class="button-icona ml-8" title="modifica quantita">&#x01F4DD</button>
            <button type="submit" name="azione" value="rimuovi" class="button-icona ml-8" title="rimuovi elemento">&#x01F5D1</button>
          </form>
        </li>
        <hr class="mt-8 mb-8 hr-corsi" />
<?php
    }
  }
?>
      </ul>
<?php if ($totale === 0 && isset($_SESSION['id_utente'])) { ?>
      <h3 class="centrato prezzo">Carrello vuoto, non &egrave; possibile proseguire con l&rsquo;ordine!</h3>
<?php } ?>

      <p id="risultato-carrello" class="mt-32">
        <b>Totale</b>:
        <span class="prezzo"><?php echo($totale); ?>&euro;</span> <br><br>
<?php if (isset($_SESSION['id_utente'])) {
        $id_utente = $_SESSION['id_utente'];
        $credito = op_estrazione_credito($conn_db, $id_utente);
        $controllo_credito = $credito < $totale;
?>
        <b>Credito</b>:
        <span class="prezzo"><?php echo($credito); ?>&euro; </span>
        <button id="ricarica" class="mt-8" name="azione" value="ricarica" onclick="document.getElementById('form-ricarica').style.display='block'"><b>Ricarica</b></button>

        <form class="mt-8" id="form-ricarica" action="carrello.php" method="POST">
          <input type="number" id="input-credito" name="credito" min="0.00" step="1.00" value="0.00">
          <button type="submit" id="ricarica-credito" name="azione" value="ricarica_credito" class="ml-8" title="ricarica credito">&#x2705</button>
        </form>

        <br><br>
<?php } ?>
      </p>
    </div>

    <div class="centrato pt-64">
<?php if (isset($controllo_credito) && $controllo_credito) { ?>
        <h3 class="centrato prezzo pb-32">Credito insufficiente!</h3>
<?php } ?>
        <a id="indietro-carrello" class="button" href="shop.php">Indietro</a>
<?php if (isset($_SESSION['id_utente'])) { ?>
        <a id="indietro-carrello" class="button" href="ordine.php" <?php if($totale === 0 || $controllo_credito) { ?> style="pointer-events: none;" <?php } ?>>Prosegui ordine</a>
<?php } else { ?>
        <a id="indietro-carrello" class="button" href="login.php?redirect=carrello.php">Accedi</a>
<?php } ?>
    </div>
  </div>

  <div id="footer">
    Copyright R&amp;C GYM 2023
  </div>

</body>

</html>
