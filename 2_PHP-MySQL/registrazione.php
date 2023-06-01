<?php
require_once('connessione.php');
require_once('operazioni.php');

$conn_db = connessione_db();

$errore = 'nessuno';
$registrazione = isset($_POST['azione']) && $_POST['azione'] === 'registrazione';

if ($registrazione) {
  $nome = $_POST['nome'];
  $cognome = $_POST['cognome'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($nome === '' || $cognome === '' || $username === '' || $password === '') {
    $errore = 'vuoto';
  } else if (!preg_match('/^[A-Za-z0-9!£$%&()=?^,.;:_|]{8,}$/', $password)) {
    $errore = 'password';
  } else {
    $registrato = op_registrazione($conn_db, $nome, $cognome, $username, $password);
  }
} else {
  $nome = '';
  $cognome = '';
  $username = '';
  $password = '';
  $registrato = false;
}
?>
<?xml version="1.0" encoding="UTF-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>
  <title>Registrazione &ndash; R&amp;C gym</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2&amp;display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rampart+One&amp;display=swap" />
  <link rel="stylesheet" type="text/css" href="stile.css" />
</head>

<body>
  <div id="header">
    <h1><a href="index.php">R&amp;C GYM</a></h1>
    <span id="btn-log">
<?php if (isset($_SESSION['id_utente'])) { ?>
      <a href="logout.php">LOGOUT</a>
<?php } else { ?>
      <a href="login.php?redirect=index.php">LOGIN</a>
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

  <div id="contenuto" class="centrato">
    <div id="form-account" class="mb-32 mt-32">
      <h2 class="pb-16 pt-16 outline-font-login">REGISTRAZIONE</h2>
<?php if (!$registrazione || $errore !== 'nessuno') { ?>
      <form action="registrazione.php" method="POST">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" value="<?php echo($nome); ?>"><br><br>

        <label for="cognome">Cognome:</label><br>
        <input type="text" id="cognome" name="cognome" value="<?php echo($cognome); ?>"><br><br>

        <label for="username">Nome utente:</label><br>
        <input type="text" id="username" name="username" value="<?php echo($username); ?>"><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>

        <button type="submit" name="azione" value="registrazione" class="button">Registrati!</button>
      </form>
      <div class="pt-16 mb-8">
        <a href="login.php">Accedi con un account esistente</a>
<?php   if ($errore === 'vuoto') { ?>
        <p>Tutti i campi devono essere compilati</p>
<?php   } else if ($errore === 'password') { ?>
        <p class="mt-8">La password deve contenere almeno 8 caratteri, tra i quali sono ammessi:</p>
        <ul id="formato_password">
          <li>lettere maiuscole: A&ndash;Z</li>
          <li>lettere minuscole: a&ndash;z</li>
          <li>numeri: 0&ndash;9</li>
          <li>caratteri speciali: &excl;&pound;&dollar;&percnt;&amp;&lpar;&rpar;&equals;&quest;&Hat;&comma;&period;&semi;&colon;&lowbar;&vert;</li>
        </ul>
<?php   } ?>
      </div>
<?php } else if ($registrato) { ?>
      <p>Account registrato!</p>
      <a href="login.php">Accedi</a>
<?php } else { ?>
      <p>Errore nella creazione dell'account.</p>
      <p>L'account esiste gi&agrave;?</p>
      <p>Prova ad accedere...</p>
      <a href="login.php">Accedi</a>
<?php } ?>
    </div>
  </div>

  <div id="footer">
    Copyright R&amp;C GYM 2023
  </div>
</body>

</html>
