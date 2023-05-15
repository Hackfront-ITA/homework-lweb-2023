<?php
require_once('connessione.php');

$conn_db = connessione_db();
?>

<?xml version="1.0" encoding="UTF-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>
  <title>Prenotazioni &ndash; R&amp;C gym</title>
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
    <h2 class="pb-16">PRENOTAZIONI</h2>
    <table id="tabella-prenotazioni" class="scatola">
      <thead>
        <th>ID</th>
        <th>Nome</th>
        <th>Cognome</th>
<?php if (!isset($_GET['corso'])) { ?>
        <th>Corso</th>
<?php } ?>
      </thead>
      <tbody>
<?php
$query  = "SELECT * FROM " . TBL_PRENOTAZIONI;
if (isset($_GET['corso'])) {
  $query .= " WHERE corso = '" . $_GET['corso'] . "'";
}
$result = mysqli_query($conn_db, $query);
if (!$result) {
  printf("Errore nella query.\n");
  exit();
}

while ($row = mysqli_fetch_assoc($result)) {
?>
        <tr>
          <td><?php echo($row['id']) ?></td>
          <td><?php echo($row['nome']) ?></td>
          <td><?php echo($row['cognome']) ?></td>
<?php if (!isset($_GET['corso'])) { ?>
          <td><?php echo($row['corso']) ?></td>
<?php } ?>
        </tr>
<?php
}
?>
        </tbody>
      </table>
    <div class="mt-32 mb-8">
      <a class="button" href="corsi.html">Indietro</a>
    </div>
  </div>

  <div id="footer">
    Copyright R&amp;C GYM 2023
  </div>
</body>

</html>
