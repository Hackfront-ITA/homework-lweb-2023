<?php
require_once("connessione.php");

/*** Creazione database ***/
$conn_db = connessione_db(true);  // true: connessione senza database

$query = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if (!mysqli_query($conn_db, $query)) {
  printf("Problemi nella creazione del database.");
  exit();
}

$conn_db = connessione_db();

/*** Creazione tabella prodotti ***/
$query  = "CREATE TABLE IF NOT EXISTS " . TBL_PRODOTTI . " (";
$query .= "  id     INT          NOT NULL AUTO_INCREMENT, ";
$query .= "  nome   VARCHAR(50)  NOT NULL, ";
$query .= "  prezzo DECIMAL(5,2) NOT NULL, ";
$query .= "  PRIMARY KEY (id), ";
$query .= "  UNIQUE (nome)";
$query .= ");";

if (!mysqli_query($conn_db, $query)) {
    printf("Problemi nella creazione della tabella %s.\n", TBL_PRODOTTI);
    exit();
}

/*** Creazione tabella prenotazioni ***/
$query  = "CREATE TABLE IF NOT EXISTS " . TBL_PRENOTAZIONI . " (";
$query .= "  id      INT         NOT NULL AUTO_INCREMENT,";
$query .= "  nome    VARCHAR(50) NOT NULL,";
$query .= "  cognome VARCHAR(50) NOT NULL,";
$query .= "  corso   ENUM('bruciagrassi','tonificazione','corpo-mente') NOT NULL,";
$query .= "  PRIMARY KEY (`id`)";
$query .= ");";

if (!mysqli_query($conn_db, $query)) {
    printf("Problemi nella creazione della tabella %s.\n", TBL_PRENOTAZIONI);
    exit();
}

/*** Inserimento tabella prodotti ***/
$check = "SELECT * FROM " . TBL_PRODOTTI;
$result = mysqli_query($conn_db, $check);

if (!mysqli_fetch_assoc($result)) {
  $query  = "INSERT INTO " . TBL_PRODOTTI . " (nome, prezzo) VALUES ";
  $query .= "  (\"BLP99.9 8:1:1 Pure Professional\", 39.95), ";
  $query .= "  (\"Omega Pure\", 19.99), ";
  $query .= "  (\"100% Whey 2,28kg\", 100.99), ";
  $query .= "  (\"Isolate-pro grass-fed 700g\", 52.00), ";
  $query .= "  (\"Snickers hi protein 62g\", 2.70), ";
  $query .= "  (\"Iso Whey Zero\", 49.87), ";
  $query .= "  (\"Choco Egg 40gg\", 2.40), ";
  $query .= "  (\"Vb whey 104 9.8 - 450g\", 46.00), ";
  $query .= "  (\"Vb whey 104 9.8 - 900g\", 76.00), ";
  $query .= "  (\"Whey 80 professional 2000g\", 70.99), ";
  $query .= "  (\"Mars protein 57g\", 2.99), ";
  $query .= "  (\"Hydro Purebar 55g\", 5.00), ";
  $query .= "  (\"Grenade Carb Killa 60g\", 3.95), ";
  $query .= "  (\"CarbControl Bar 100g\", 5.70), ";
  $query .= "  (\"Peanut Butter 495g\", 9.99);";

  if (!mysqli_query($conn_db, $query)) {
    printf("Problemi nell'inserimento dei dati nella tabella %s.\n", $tbl_prodotti);
    exit();
  }
}

?>
