<?php
const DB_HOST = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = 'password';
const DB_NAME = 'rc_gym';

const TBL_PRODOTTI = "prodotti";
const TBL_PRENOTAZIONI = "prenotazioni";

function connessione_db ($senza_db = false) {
  if ($senza_db) {
    $conn_db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD);
  } else {
    $conn_db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
  }

  if (mysqli_connect_errno()){
    printf("Errore nella connessione al database: %s\n", mysqli_connect_error($conn_db));
    exit();
  }

  return $conn_db;
}
?>
