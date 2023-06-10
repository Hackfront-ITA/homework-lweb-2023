<?php
$doc = new DOMDocument();
$rawContent = file('./xml/ordini.xml');
$xmlString = implode("\n", $rawContent);
/*
$xmlString = '';
foreach(file('./xml/ordini.xml') as $line) {
  $xmlString .= trim($line);
}
*/
$doc->loadXML($xmlString);
$result = $doc->schemaValidate('./xml/ordini.xsd');
if ($result) {
  echo ("Il documento e' valido\n");
} else {
  echo ("Il documento NON e' valido\n");
}
?>
