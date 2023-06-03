<?php session_start(); ?>
<?xml version="1.0" encoding="UTF-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>
  <title>Servizi &ndash; R&amp;C gym</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2&amp;display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rampart+One&amp;display=swap" />
  <link rel="stylesheet" type="text/css" href="stile.css" />
</head>

<body>

  <div id="header">
    <h1><a href="index.php">R&amp;C GYM</a></h1>
    <span id="btn-log">
<?php if (isset($_SESSION['id_utente'])) { ?>
      <a href="logout.php">LOGOUT</a>
<?php } else { ?>
      <a href="login.php?redirect=servizi.php">LOGIN</a>
<?php } ?>
    </span>
    <table id="menu">
      <tbody>
        <tr>
          <td><a href="index.php">Homepage</a></td>
          <td><a href="corsi.php">Corsi</a></td>
          <td><a href="servizi.php">Servizi</a></td>
          <td><a href="shop.php">Shop</a></td>
          <td><a href="info.php">Informazioni</a></td>
        </tr>
      </tbody>
    </table>
    <hr />
  </div>

  <div id="contenuto">
    <h2>SERVIZI</h2>

    <p>
      R&amp;C GYM è il nuovo modo di vivere il fitness: convenienza, innovazione e qualità!<br />

      Con soli 19,90 € al mese potrai avere tutti i vantaggi di entrare a far parte della grande famiglia R&amp;C GYM:<br />
    </p>
    <ul id="lista-servizi">
      <li>Fitness senza limitazioni di orario d&rsquo;ingresso e permanenza</li>
      <li>Cardio Theatre</li>
      <li>Attrezzature innovative dai leader mondiali della produzione</li>
      <li>Grandi spazi per allenarsi comodamente</li>
      <li>Comodi spogliatoi sempre curati e puliti</li>
      <li>Ambiente giovane e accogliente</li>
      <li>Staff tecnico altamente qualificato</li>
    </ul>
    <h3 id="invito-servizi" class="centrato pt-32 pb-32">
      Ti aspettiamo!
    </h3>
  </div>
  <div id="banner">
    <img src="res/banner.png" alt="Banner servizi"></img>
  </div>

  <div id="footer">
    Copyright R&amp;C GYM 2023
  </div>

</body>

</html>
