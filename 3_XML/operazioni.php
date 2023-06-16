<?php
require_once('connessione.php');

const XML_ORDINI = './xml/ordini.xml';

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


function op_registrazione($conn_db, $nome, $cognome, $username, $password, $credito) {
  $query = sprintf(
    "INSERT INTO %s (nome, cognome, username, password, credito) VALUES ('%s', '%s', '%s', MD5('%s'), '%s')",
    TBL_UTENTI, $nome, $cognome, $username, $password, $credito
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


function op_creazione_ordine($id_utente, $indirizzo, $carrello) {
  $doc = new DOMDocument();
  $xml_string = '';
  foreach(file(XML_ORDINI) as $line) {
    $xml_string .= trim($line);
  }
  $doc->loadXML($xml_string);
  $root = $doc->documentElement;

  $ordine = $doc->createElement('ordine');

  $ordini = $root->childNodes;
  $id_ordine = 0;
  for ($i = 0; $i < $ordini->length; $i++) {
    $ord2 = $ordini->item($i);
    $id_ord2 = $ord2->getAttribute('id');
    if ($id_ordine < $id_ord2) {
      $id_ordine = $id_ord2;
    }
  }
  $id_ordine++;

  $ordine->setAttribute('id', $id_ordine);

  $data = $doc->createElement('data', date('Y-m-d'));
  $ordine->appendChild($data);

  $utente = $doc->createElement('utente', $id_utente);
  $ordine->appendChild($utente);

  $indirizzo = $doc->createElement('indirizzo', $indirizzo);
  $ordine->appendChild($indirizzo);

  $articoli = $doc->createElement('articoli');
  foreach ($carrello as $key => $value) {
    $id_prodotto = $key;
    $quantita = $value;
    $articolo = $doc->createElement('articolo');
    $articolo->setAttribute('id', $id_prodotto);
    $articolo->setAttribute('quantita', $quantita);
    $articoli->appendChild($articolo);
  }
  $ordine->appendChild($articoli);

  $root->appendChild($ordine);

  $doc->save(XML_ORDINI);
}


function op_rimozione_ordine($id_ordine) {
  $doc = new DOMDocument();
  $xml_string = '';
  foreach(file(XML_ORDINI) as $line) {
    $xml_string .= trim($line);
  }
  $doc->loadXML($xml_string);
  $root = $doc->documentElement;

  $ordini = $root->childNodes;
  for ($i = 0; $i < $ordini->length; $i++) {
    $ordine = $ordini->item($i);
    $id_ord2 = $ordine->getAttribute('id');
    if ($id_ord2 === $id_ordine) {
      $root->removeChild($ordine);
      break;
    }
  }

  $doc->save(XML_ORDINI);
}


function op_estrazione_credito($conn_db, $id_utente) {
  $query = sprintf(
    "SELECT credito FROM %s WHERE id = '%s'",
    TBL_UTENTI, $id_utente
  );

  try {
    $result = mysqli_query($conn_db, $query);
    $row = mysqli_fetch_assoc($result);

    return $row['credito'];
  } catch (Exception $err) {
    $cod_err = $err->getSqlState();

    printf("Errore sconosciuto nell'interrogazione al database: %s\n", $cod_err);
    exit();
  }
}


function op_aggiorna_credito($conn_db, $id_utente, $credito) {
  $query  = sprintf(
    "UPDATE %s SET credito = credito + '%f' where id = '%s'",
    TBL_UTENTI, $credito, $id_utente
  );

  try {
    mysqli_query($conn_db, $query);
    return true;
  } catch (Exception $err) {
    $cod_err = $err->getSqlState();

    printf("Errore sconosciuto nell'aggiornamento dei dati: %s.\n", $cod_err);
    exit();
  }
}


function op_scala_credito($conn_db, $id_utente, $totale) {
  $query  = sprintf(
    "UPDATE %s SET credito = credito - '%f' where id = '%s'",
    TBL_UTENTI, $totale, $id_utente
  );

  try {
    mysqli_query($conn_db, $query);
    return true;
  } catch (Exception $err) {
    $cod_err = $err->getSqlState();

    printf("Errore sconosciuto nell'aggiornamento dei dati: %s.\n", $cod_err);
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


function op_nome_articolo($conn_db, $id_articolo) {
  $query = sprintf(
    "SELECT nome FROM %s WHERE id = %d",
    TBL_PRODOTTI, $id_articolo
  );

  try {
    $result = mysqli_query($conn_db, $query);
    $row = mysqli_fetch_assoc($result);

    return $row['nome'];
  } catch (Exception $err) {
    $cod_err = $err->getSqlState();

    printf("Errore sconosciuto nell'interrogazione al database: %s\n", $cod_err);
    exit();
  }
}


function op_info_utente($conn_db, $id_utente) {
  $query = sprintf(
    "SELECT nome, cognome, username, credito FROM %s WHERE id = %d",
    TBL_UTENTI, $id_utente
  );

  try {
    $result = mysqli_query($conn_db, $query);
    $row = mysqli_fetch_assoc($result);

    return $row;
  } catch (Exception $err) {
    $cod_err = $err->getSqlState();

    printf("Errore sconosciuto nell'interrogazione al database: %s\n", $cod_err);
    exit();
  }
}

?>
