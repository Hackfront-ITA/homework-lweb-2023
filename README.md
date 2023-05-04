# linguaggi-web-2023

### Homework per il corso di Linguaggi Web 2023

## Componenti
- ```Ale110901```: Alessandro Cecchetto - 1941039
  - link: https://github.com/Ale110901/linguaggi-web-2023.git
- ```Hackfront-ITA```: Emanuele Roccia - 1967318
  - link: https://github.com/Hackfront-ITA/linguaggi-web-2023.git

## Descrizione

### Homework 1 - XHTML e CSS
#### Descrizione dell'homework 1:
- L'esercizio sviluppato non è stato preso dalle slide presentate a lezione, ma inventato da noi.

- All'interno dell'homework sono state utilizzati principalmente i seguenti tag XHTML e proprietà CSS:
    - &lt;div&gt;, &lt;table&gt;, &lt;ul&gt; per organizzare i contenuti delle varie pagine XHTML
    - &lt;img&gt; per l'inserimento di immagini
    - &lt;a&gt;, &lt;button&gt; sono stati utilizzati con il medesimo stile, il primo per riferimenti interni al sito, mentre il secondo per sviluppi successivi (implementazione PHP...)

    - padding, margin: per la disposizione degli elementi nella pagina
    - border-... : per modifiche estetiche degli elementi
    - font-size: per regolare la dimensione del testo
    - em: per regolare la dimensione degli elementi rispetto alla dimensione del testo
    - display: flex : per modificare il layout in modo flessibile

### Homework 2 - PHP e MySQL
- L'esercizio sviluppato è il proseguimento dell'homework precedente.
  Sono state aggiunte le funzionalità di shop e prenotazione corsi mediante il database.

- Le caratteristiche principali di PHP che sono state utlizzate sono:
    - sessioni: per memorizzare lo stato del carrello lato server (session_start, $\_SESSION)
    - mysqli: per la connessione al database e le interrogazioni (mysqli_query, mysqli_fetch_assoc, mysqli_connect_error)
    - array $\_GET / $\_POST: per ottenere dati inviati dal client nelle richieste
    - costanti: per memorizzare le credenziali del database e i nomi delle tabelle
    - isset(), unset(): per verificare l'esistenza di variabili ed eliminarne il contenuto

:snowman:
