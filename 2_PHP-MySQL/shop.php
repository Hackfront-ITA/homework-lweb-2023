<?php
require ('install.php');

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
} else if ($_POST['azione'] === 'aggiungi') {
  $id_articolo = $_POST['id_articolo'] - 1;
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
  <title>Shop</title>
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
    <h2>SHOP</h2>

    <pre>
      <?php var_dump($_POST); ?>
      <?php var_dump($_SESSION); ?>
    </pre>

    <div id="catalogo-shop">
<?php
  for ($i = 0; $i < count(ARTICOLI); $i++) {
    $articolo = ARTICOLI[$i];
    $id_articolo = $i + 1;
?>
      <div id="posizionamento">
        <img src="res/shop_img/shop_<?php echo ($id_articolo); ?>.png"  alt="shop_<?php echo ($id_articolo); ?>.png" ></img>
        <p><?php echo ($articolo['nome']); ?></p>
        <p class="prezzo"><?php echo ($articolo['prezzo']); ?> &euro;</p>
        <form action="shop.php#posizionamento" method="post" style="padding-top: 1em;">
          <input type="hidden" name="id_articolo" value="<?php echo ($id_articolo); ?>" />
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
