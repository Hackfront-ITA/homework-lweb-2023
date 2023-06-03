<?php
session_start();
if (isset($_SESSION['id_utente'])) {
  unset($_SESSION['id_utente']);
  session_destroy();
}
$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : '';
if (!isset($redirect) || $redirect === '') {
  $redirect = 'index.php';
}
header('Location: ' . $redirect);
?>
