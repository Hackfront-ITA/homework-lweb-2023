<?php
require_once('connessione.php');


function op_login($conn_db, $username, $password) {
  $query = sprintf(
    "SELECT id FROM %s WHERE username = '%s' AND password = MD5('%s') LIMIT 1",
    TBL_UTENTI, $username, $password
  );

  try {
    $result = mysqli_query($conn_db, $query);
    $row = mysqli_fetch_assoc($result);
    if (!$row) {
      return -1;
    } else {
      return $row['id'];
    }
  } catch (Exception $err) {
    $cod_err = $err->getSqlState();
    if ($cod_err === '23000') {
      return -1;
    } else {
      printf("Errore sconosciuto nell'interrogazione al database: %s\n", $cod_err);
      exit();
    }
  }
}


function op_registrazione($conn_db, $nome, $cognome, $username, $password) {
  $query = sprintf(
    "INSERT INTO %s (nome, cognome, username, password) VALUES ('%s', '%s', '%s', MD5('%s'))",
    TBL_UTENTI, $nome, $cognome, $username, $password
  );

  try {
    mysqli_query($conn_db, $query);
    return true;
  } catch (Exception $err) {
    $cod_err = $err->getSqlState();

    if ($cod_err === '23000') {
      return false;
    } else {
      printf("Errore sconosciuto nell'inserimento dei dati: %s.\n", $cod_err);
      exit();
    }
  }
}


function op_prenotazione($conn_db, $nome, $cognome, $corso) {
  $query  = sprintf(
    "INSERT INTO %s (nome, cognome, corso) VALUES ('%s', '%s', '%s')",
    TBL_PRENOTAZIONI, $nome, $cognome, $corso
  );

  try {
    mysqli_query($conn_db, $query);
    return true;
  } catch (Exception $err) {
    $cod_err = $err->getSqlState();

    printf("Errore sconosciuto nell'inserimento dei dati: %s.\n", $cod_err);
    exit();
  }
}


function op_creazione_ordine($conn_db, $id_utente, $indirizzo) {
  $query  = sprintf(
    "INSERT INTO %s (id_utente, indirizzo) VALUES (%d, '%s')",
    TBL_ORDINI, $id_utente, $indirizzo
  );

  try {
    mysqli_query($conn_db, $query);
    return $conn_db->insert_id;
  } catch (Exception $err) {
    $cod_err = $err->getSqlState();

    printf("Errore sconosciuto nell'inserimento dei dati: %s.\n", $cod_err);
    exit();
  }
}


function op_num_prenotazioni($conn_db, $corso) {
  $query = sprintf(
    "SELECT COUNT(*) AS num FROM %s WHERE corso = '%s'",
    TBL_PRENOTAZIONI, $corso
  );

  try {
    $result = mysqli_query($conn_db, $query);
    $row = mysqli_fetch_assoc($result);

    return $row['num'];
  } catch (Exception $err) {
    $cod_err = $err->getSqlState();

    printf("Errore sconosciuto nell'interrogazione al database: %s\n", $cod_err);
    exit();
  }
}

function op_ins_articoli_ordini($conn_db, $id_ordine, $carrello) {
  foreach ($carrello as $key => $value) {
    $id_prodotto = $key;
    $quantita = $value;

    $query = sprintf(
      "INSERT INTO %s VALUES ('%d', '%d', '%d')",
      TBL_ARTICOLI_ORDINI, $id_ordine, $id_prodotto, $quantita
    );

    try {
      mysqli_query($conn_db, $query);
    } catch (Exception $err) {
      $cod_err = $err->getSqlState();

      printf("Errore sconosciuto nell'inserimento dei dati: %s\n", $cod_err);
      exit();
    }
  }
  
  return true;
}

?>
