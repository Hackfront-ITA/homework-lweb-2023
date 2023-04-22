<?php

const DB_HOST = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = 'password';
const DB_NAME = 'rc_gym';

function connessione_db () {
  $conn_db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()){
    printf("Errore nella connessione al database: %s\n", mysqli_connect_error($conn_db));
  }

  return $conn_db;
}

?>
