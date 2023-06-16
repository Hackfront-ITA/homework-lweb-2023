<?php
require_once('connessione.php');
require_once('operazioni.php');

$conn_db = connessione_db();

session_start();

$sessione = isset($_SESSION['id_utente']) && !is_nan($_SESSION['id_utente']);

if (!$sessione) {
  header("Location: login.php?redirect=profilo.php");
  exit();
}

if (isset($_POST['azione']) && $_POST['azione'] === 'rimuovi_ordine') {
  $id_ordine = $_POST['id_ordine'];
  op_rimozione_ordine($id_ordine);
}
?>
<?xml version="1.0" encoding="UTF-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>
  <title>Profilo &ndash; R&amp;C gym</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2&amp;display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rampart+One&amp;display=swap" />
  <link rel="stylesheet" type="text/css" href="stile.css" />
</head>

<body>

  <div id="header">
    <h1><a href="index.php">R&amp;C GYM</a></h1>
    <span id="btn-log">
<?php if (isset($_SESSION['id_utente'])) { ?>
      <a href="profilo.php">PROFILO</a>
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
    <h2>PROFILO</h2>
<?php
  $info_utente = op_info_utente($conn_db, $_SESSION['id_utente']);
?>
    <div>
      <h3>Informazioni</h3>
      <p><b>Nome:</b> <?php echo($info_utente['nome']); ?></p>
      <p><b>Cognome:</b> <?php echo($info_utente['cognome']); ?></p>
      <p><b>Nome utente:</b> <?php echo($info_utente['username']); ?></p>
      <p><b>Credito:</b> <?php echo($info_utente['credito']); ?> &euro;</p>
    </div>

    <div>
      <h3>Ordini</h3>
      <table class="scatola">
        <thead>
          <th>Data</th>
          <th>Indirizzo</th>
          <th>Articoli</th>
          <th>Rimuovi</th>
        </thead>
        <tbody>
<?php
  $doc = new DOMDocument();
  $xml_string = '';
  foreach(file(XML_ORDINI) as $line) {
    $xml_string .= trim($line);
  }
  $doc->loadXML($xml_string);
  $root = $doc->documentElement;

  $ordini = $root->childNodes;
  for ($i = 0; $i < $ordini->length; $i++) {
    $ordine = $ordini->item($i);
    $o_utente = $ordine->getElementsByTagName('utente')[0]->textContent;
    if ($o_utente != $_SESSION['id_utente']) {
      continue;
    }

    $o_data = $ordine->getElementsByTagName('data')[0]->textContent;
    $o_indirizzo = $ordine->getElementsByTagName('indirizzo')[0]->textContent;

    $articoli = $ordine->getElementsByTagName('articoli')[0]->childNodes;
    $o_articoli = '';
    for ($j = 0; $j < $articoli->length; $j++) {
      $articolo = $articoli->item($j);
      $id_articolo = $articolo->getAttribute('id');
      $quantita = $articolo->getAttribute('quantita');
      $nome_articolo = op_nome_articolo($conn_db, $id_articolo);
      $o_articoli .= $quantita . "x " . $nome_articolo . "\n";
    }
?>
          <tr>
            <td><?php echo($o_data); ?></td>
            <td><?php echo($o_indirizzo); ?></td>
            <td><pre class="giustificato"><?php echo($o_articoli); ?></pre></td>
            <td>
              <form action="profilo.php" method="post">
                <input type="hidden" name="id_ordine" value="<?php echo($o_id); ?>" />
                <button type="submit" name="azione" value="rimuovi_ordine" class="button-icona ml-8" title="rimuovi ordine">&#x01F5D1</button>
              </form>
            </td>
          </tr>
<?php

  }
?>
        </tbody>
      </table>
    </div>

    <div class="centrato pt-64">
        <a class="button" href="logout.php">Logout</a>
    </div>
  </div>

  <div id="footer">
    Copyright R&amp;C GYM 2023
  </div>

</body>

</html>
