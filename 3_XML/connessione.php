<?php
const DB_HOST = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = 'password';
const DB_NAME = 'rc_gym';

const TBL_PRODOTTI = "prodotti";
const TBL_PRENOTAZIONI = "prenotazioni";
const TBL_UTENTI = "utenti";
const TBL_ORDINI = "ordini";

function connessione_db ($senza_db = false) {
  $conn_db = null;

  try {
    if ($senza_db) {
      $conn_db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD);
    } else {
      $conn_db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    }
  } catch (Exception $err) {
    $cod_err = $err->getSqlState();
    printf("Errore nella connessione al database: %s\n", $cod_err);
    exit();
  }

  return $conn_db;
}
?>
