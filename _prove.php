<?php
$doc = new DOMDocument();
$xmlString = '';
foreach(file('./xml/ordini.xml') as $line) {
  $xmlString .= trim($line);
}
$doc->loadXML($xmlString);
$root = $doc->documentElement;

$ordini = $root->childNodes;
for ($i = 0; $i < $ordini->length; $i++) {
  $ordine = $ordini->item($i);
  $id_ordine = $ordine->getAttribute('id');
  echo ("Ordine $id_ordine:\n");

  $data = $ordine->getElementsByTagName('data')[0]->textContent;
  echo("  Data: $data\n");

  $utente = $ordine->getElementsByTagName('utente')[0]->textContent;
  echo("  Utente: $utente\n");

  $indirizzo = $ordine->getElementsByTagName('indirizzo')[0]->textContent;
  echo("  Indirizzo: $indirizzo\n");

  $articoli = $ordine->getElementsByTagName('articoli')[0]->childNodes;
  echo("  Articoli:\n");
  for ($j = 0; $j < $articoli->length; $j++) {
    $articolo = $articoli->item($j);
    $id_articolo = $articolo->getAttribute('id');
    $quantita = $articolo->getAttribute('quantita');
    echo("    ID: $id_articolo, quantita: $quantita\n");
  }
}
?>
