<?php
require_once('connessione.php');
require_once('operazioni.php');

session_start();

$sessione = isset($_SESSION['id_utente']) && !is_nan($_SESSION['id_utente']);

if (!$sessione) {
  header("Location: login.php?redirect=ordine.php");
  exit();
}

$conn_db = connessione_db();

$errore = 'nessuno';
$creazione = isset($_POST['azione']) && $_POST['azione'] === 'crea_ordine';

if ($creazione) {
  $indirizzo = $_POST['indirizzo'];

  if ($indirizzo === '') {
    $errore = 'vuoto';
  } else if (!preg_match('/^([[:alnum:] ]+), ([a-zA-Z ]+), ([a-zA-Z ]+)$/', $indirizzo)) {
    $errore = 'indirizzo';
  } else {
    $carrello = $_SESSION['carrello'];
    $id_utente = $_SESSION['id_utente'];
    $id_ordine = op_creazione_ordine($conn_db, $id_utente, $indirizzo);
    op_ins_articoli_ordini($conn_db, $id_ordine, $carrello);
    unset($_SESSION['carrello']);
    $creato = true;
  }
} else {
  $indirizzo = '';
  $creato = false;
}
?>
<?xml version="1.0" encoding="UTF-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>
  <title>Ordine &ndash; R&amp;C gym</title>
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

  <div id="contenuto" class="centrato">
    <div id="form-account" class="mb-32 mt-32">
      <h2 class="pb-16 pt-16 outline-font-login">ORDINE</h2>
<?php if (!$creazione || $errore !== 'nessuno') { ?>
      <form action="ordine.php" method="POST">
        <label for="username">Indirizzo:</label><br>
        <input type="text" id="indirizzo" name="indirizzo" value="<?php echo($indirizzo); ?>"><br><br>

        <button type="submit" name="azione" value="crea_ordine" class="button">Conferma</button>
      </form>
      <div class="pt-16 mb-8">
        <p>tsk tsk...</p>
<?php   if ($errore === 'vuoto') { ?>
        <p>Tutti i campi devono essere compilati</p>
<?php   } else if ($errore === 'indirizzo') { ?>
        <p>L'indirizzo deve essere nel formato: <pre>VIA, CITTA, PAESE</pre></p>
<?php   } ?>
      </div>
<?php } else if ($creato) { ?>
      <p>Ordine creato!</p>
      <a href="shop.php">Torna allo shop</a>
<?php } ?>
    </div>
  </div>

  <div id="footer">
    Copyright R&amp;C GYM 2023
  </div>
</body>

</html>
