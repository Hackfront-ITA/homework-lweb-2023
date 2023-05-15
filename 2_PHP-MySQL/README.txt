Homework svolto da:
-	Alessandro Cecchetto - 1941039: https://github.com/Ale110901/linguaggi-web-2023.git
-	Emanuele Roccia - 1967318: https://github.com/Hackfront-ITA/linguaggi-web-2023.git

L'esercizio sviluppato è il proseguimento dell'homework precedente.
Sono state aggiunte le funzionalità di shop e prenotazione corsi mediante il database.

Le caratteristiche principali di PHP che sono state utlizzate sono:
- sessioni: per memorizzare lo stato del carrello lato server (session_start, $\_SESSION)
- mysqli: per la connessione al database e le interrogazioni (mysqli_query, mysqli_fetch_assoc, mysqli_connect_error)
- array $\_GET / $\_POST: per ottenere dati inviati dal client nelle richieste
- costanti: per memorizzare le credenziali del database e i nomi delle tabelle
- isset(), unset(): per verificare l'esistenza di variabili ed eliminarne il contenuto
- header('Location: ...'): per reindirizzamenti nello shop e nel login
