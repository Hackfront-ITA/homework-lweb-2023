<?php
require_once("connessione.php");

$conn = connessione_db();

$creazione_db ="CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if(!mysqli_query($conn, $creazione_db)) {
  printf("Problemi nella creazione del database.");
}


$conn_db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (mysqli_connect_errno()){
  printf("Errore nella connessione al database %s: %s\n", DB_NAME, mysqli_connect_error($conn_db));
}

$prodotto = "prodotto";
$query_ins = "CREATE TABLE IF NOT EXISTS $prodotto (";
$query_ins .= "img varchar (50) NOT NULL, ";
$query_ins .= "nome varchar (50) NOT NULL, ";
$query_ins .= "prezzo decimal (3,2) NOT NULL";
$query_ins .= ");";

if(!mysqli_query($conn_db, $query_ins)){
    printf("Problemi nella creazione della tabella %s.\n", $prodotto);
}
?>
