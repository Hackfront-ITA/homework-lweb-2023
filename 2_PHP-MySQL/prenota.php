<?php
$posti = 0;
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
          <td><a href="galleria.php">Galleria</a></td>
          <td><a href="info.html">Informazioni</a></td>
        </tr>
      </tbody>
    </table>
    <hr />
  </div>

  <div id="contenuto" class="centrato">
    <h2 class="pb-16">PRENOTAZIONE</h2>
    <p class="pb-16">Posti disponibili: <?php echo($posti); ?></p>
<?php if ($posti > 0) { ?>
    <form action="prenota.php" method="POST">
      <label for="nome">Nome:</label><br>
      <input type="text" id="nome" name="nome"><br><br>

      <label for="cognome">Cognome:</label><br>
      <input type="text" id="cognome" name="cognome"><br><br>

      <input type="submit" value="Invia">
    </form>
<?php } else { ?>
    <h2>Prenotazioni chiuse!</h2>
<?php } ?>
  </div>

  <div id="footer">
    Copyright R&amp;C GYM 2023
  </div>
</body>

</html>
