<?php
require_once("connessione.php");

$conn = connessione_db();

$creazione_db = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if(!mysqli_query($conn, $creazione_db)) {
  printf("Problemi nella creazione del database.");
}

$conn_db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (mysqli_connect_errno()){
  printf("Errore nella connessione al database %s: %s\n", DB_NAME, mysqli_connect_error($conn_db));
}

$prodotto = "prodotto";
$query_creazione = "CREATE TABLE IF NOT EXISTS $prodotto (";
$query_creazione .= "nome varchar (50) PRIMARY KEY, ";
$query_creazione .= "prezzo float NOT NULL";
$query_creazione .= ");";

if(!mysqli_query($conn_db, $query_creazione)){
    printf("Problemi nella creazione della tabella %s.\n", $prodotto);
}

$query_ins = "INSERT INTO $prodotto (nome, prezzo) VALUES ";
$query_ins .= "(\"prodotto1\", 19.99), ";
$query_ins .= "(\"prodotto2\", 9.99), ";
$query_ins .= "(\"prodotto3\", 29.99), ";
$query_ins .= "(\"prodotto4\", 7.99), ";
$query_ins .= "(\"prodotto5\", 5.99), ";
$query_ins .= "(\"prodotto6\", 10.99)";

if(!mysqli_query($conn_db, $query_ins)){
    printf("Problemi nell'inserimento dei dati nella tabella %s.\n", $prodotto);
}

?>
