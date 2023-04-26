<?php
require_once("connessione.php");

$conn_db = connessione_db();

const NUM_MAX_POSTI = 30;

if (isset($_POST['azione']) && $_POST['azione'] === 'prenota') {
  $query  = sprintf(
    "INSERT INTO %s (nome, cognome, corso) VALUES ('%s', '%s', '%s')",
    TBL_PRENOTAZIONI, $_POST['nome'], $_POST['cognome'], $_POST['corso']
  );
  $result = mysqli_query($conn_db, $query);
  if (!$result) {
    printf("Errore nella query.\n");
    exit();
  }

  $prenotato = true;
} else if (isset($_GET['corso'])) {
  $query  = "SELECT COUNT(*) AS num FROM " . TBL_PRENOTAZIONI;
  $query .= " WHERE corso = '" . $_GET['corso'] . "'";
  $result = mysqli_query($conn_db, $query);
  if (!$result) {
    printf("Errore nella query.\n");
    exit();
  }

  $row = mysqli_fetch_assoc($result);

  $posti = NUM_MAX_POSTI - $row['num'];

  $prenotato = false;
} else {
  exit();
}
?>

<?xml version="1.0" encoding="UTF-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>
  <title>Corsi</title>
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
    <h2 class="pb-16">PRENOTAZIONE</h2>
<?php if (!$prenotato) { ?>
    <p class="pb-16">Posti disponibili: <?php echo($posti); ?></p>
<?php   if ($posti > 0) { ?>
    <form action="prenota.php" method="POST">
      <label for="nome">Nome:</label><br>
      <input type="text" id="nome" name="nome"><br><br>

      <label for="cognome">Cognome:</label><br>
      <input type="text" id="cognome" name="cognome"><br><br>

      <input type="hidden" name="corso" value="<?php echo ($_GET['corso']); ?>" />
      <button type="submit" name="azione" value="prenota" class="button">Prenota</button>
    </form>
<?php   } else { ?>
    <h2>Prenotazioni chiuse!</h2>
<?php   } ?>
<?php } else { ?>
    <p class="pb-16"><b>La prenotazione &egrave; andata a buon fine.</b></p>
    <div class="mt-32 mb-8">
      <a class="button" href="corsi.html">Indietro</a>
    </div>
<?php } ?>
  </div>

  <div id="footer">
    Copyright R&amp;C GYM 2023
  </div>
</body>

</html>
