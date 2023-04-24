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
$query_creazione .= "id int NOT NULL AUTO_INCREMENT, ";
$query_creazione .= "nome varchar (50) NOT NULL, ";
$query_creazione .= "prezzo decimal(5,2) NOT NULL, ";
$query_creazione .= "PRIMARY KEY(id), ";
$query_creazione .= "UNIQUE (nome)";
$query_creazione .= ");";

if(!mysqli_query($conn_db, $query_creazione)){
    printf("Problemi nella creazione della tabella %s.\n", $prodotto);
}

$controllo_popolamento = "SELECT * FROM $prodotto";
$result = mysqli_query($conn_db, $controllo_popolamento);

if(!mysqli_fetch_assoc($result)){
  $query_ins = "INSERT INTO $prodotto (nome, prezzo) VALUES ";
  $query_ins .= "(\"BLP99.9 8:1:1 Pure Professional\", 39.95), ";
  $query_ins .= "(\"Omega Pure\", 19.99), ";
  $query_ins .= "(\"100% Whey 2,28kg\", 100.99), ";
  $query_ins .= "(\"Isolate-pro grass-fed 700g\", 52.00), ";
  $query_ins .= "(\"Snickers hi protein 62g\", 2.70), ";
  $query_ins .= "(\"Iso Whey Zero\", 49.87), ";
  $query_ins .= "(\"Choco Egg 40gg\", 2.40), ";
  $query_ins .= "(\"Vb whey 104 9.8 - 450g\", 46.00), ";
  $query_ins .= "(\"Vb whey 104 9.8 - 900g\", 76.00), ";
  $query_ins .= "(\"Whey 80 professional 2000g\", 70.99), ";
  $query_ins .= "(\"Mars protein 57g\", 2.99), ";
  $query_ins .= "(\"Hydro Purebar 55g\", 5.00), ";
  $query_ins .= "(\"Grenade Carb Killa 60g\", 3.95), ";
  $query_ins .= "(\"CarbControl Bar 100g\", 5.70), ";
  $query_ins .= "(\"Peanut Butter 495g\", 9.99)";

  if(!mysqli_query($conn_db, $query_ins)){
    printf("Problemi nell'inserimento dei dati nella tabella %s.\n", $prodotto);
  }
}

?>
