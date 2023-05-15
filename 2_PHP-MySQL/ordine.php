<pre>
<?php
session_start();

$sessione = isset($_SESSION['id_utente']) && !is_nan($_SESSION['id_utente']);

if (!$sessione) {
  header("Location: login.php?redirect=ordine.php");
  exit();
}

echo("Fai l'ordine\n");
var_dump($_SESSION);
?>
</pre>
