<?php
require_once('connessione.php');

$conn_db = connessione_db();

session_start();

if (!isset($_POST['azione'])) {
  // Non fa niente
} else if ($_POST['azione'] === 'aggiungi') {
  $id_articolo = $_POST['id_articolo'];
  $quantita = $_POST['quantita'];

  if (!isset($_SESSION['carrello'][$id_articolo])) {
    $_SESSION['carrello'][$id_articolo] = 0;
  }
  $_SESSION['carrello'][$id_articolo] += $quantita;
}
?>

<?xml version="1.0" encoding="UTF-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>
  <title>Shop &ndash; R&amp;C gym</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2&amp;display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rampart+One&amp;display=swap" />
  <link rel="stylesheet" type="text/css" href="stile.css" />
</head>

<body>

  <div id="header">
    <h1><a href="index.php">R&amp;C GYM</a></h1>
    <span id="btn-log">
<?php if (isset($_SESSION['id_utente'])) { ?>
      <a href="logout.php?redirect=shop.php">LOGOUT</a>
<?php } else { ?>
      <a href="login.php?redirect=shop.php">LOGIN</a>
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
    <h2>SHOP</h2>

    <div id="catalogo-shop">
<?php
  $query = "SELECT * FROM " . TBL_PRODOTTI;
  $result = mysqli_query($conn_db, $query);
  if (!$result) {
    printf("Errore nella query.\n");
    exit();
  }

  while ($row = mysqli_fetch_assoc($result)) {
?>
      <div id="articolo_<?php echo ($row['id']); ?>">
        <img src="res/shop_img/shop_<?php echo ($row['id']); ?>.png"  alt="shop_<?php echo ($row['id']); ?>.png" ></img>
        <p><?php echo ($row['nome']); ?></p>
        <p class="prezzo"><?php echo ($row['prezzo']); ?> &euro;</p>
        <form class="pt-1em" action="shop.php#articolo_<?php echo ($row['id']); ?>" method="post">
          <input type="hidden" name="id_articolo" value="<?php echo ($row['id']); ?>" />
          <input type="number" name="quantita" value="0" min="0" step="1" size="3" max="99" />
          <button type="submit" name="azione" value="aggiungi" class="button ml-8">Aggiungi</button>
        </form>
      </div>
<?php
  }
?>
    </div>

    <div class="centrato pt-64">
      <a class="button" href="carrello.php">Vai al carrello</a>
    </div>
  </div>

  <div id="footer">
    Copyright R&amp;C GYM 2023
  </div>

</body>

</html>
