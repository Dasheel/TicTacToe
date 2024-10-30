# Tic Tac Toe - Laravel Application

## Descrizione

Questa è un'applicazione di gioco Tic Tac Toe sviluppata in PHP utilizzando il framework Laravel.


## Caratteristiche

- Creazione di nuove partite di Tic Tac Toe.
- Possibilità di effettuare mosse seguendo le regole del gioco.
- Gestione delle condizioni di vittoria e pareggio.
- Eccezioni personalizzate per errori comuni, come mosse non valide (posizione/giocatore) o partite già concluse.
- Uso di Enums per migliorare la leggibilità e la manutenibilità del codice.
- Test completi per unità e integrazione.

## Tecnologie Utilizzate

- **PHP** (versione 8.2+)
- **Laravel** (versione 10.x)
- **Docker** e **Docker Compose** per l'ambiente di sviluppo
- **MySQL** per la gestione del database
- **PHPUnit** per i test
- **Composer** per la gestione delle dipendenze

## Requisiti
- [Docker](https://www.docker.com/get-started)
- [OrbStack](https://orbstack.dev/) (opzionale per utenti Mac)
- [Composer](https://getcomposer.org/) (se vuoi eseguire composer direttamente)

## Installazione

### 1. Clonare il repository
```bash
git clone https://github.com/tuo-username/tictactoe.git
cd tictactoe
```

### 2. Scegliere docker-compose
In base al sistema operativo che utilizzi, rinomina il file docker-compose_mac.yml o docker-compose_windows.yml in docker-compose.yml.
Stessa cosa vale per il file Dockerfile
```bash
Per mac
docker-compose_mac.yml -> mv docker-compose_mac.yml docker-compose.yml
Dockerfile_mac -> mv Dockerfile_mac Dockerfile

Per windows
docker-compose_windows.yml -> mv docker-compose_windows.yml docker-compose.yml
Dockerfile_windows -> mv Dockerfile_windows Dockerfile
```
Creare il file .env
```bash
cp .env.example .env
```
### 3. Avviare il container
Una volta selezionato il file corretto, puoi avviare il container eseguendo (assicurarsi di essere nella cartella del progetto):
```bash
docker-compose down -v Per fermare ed eliminare i container Docker definiti nel file
docker-compose build --no-cache Per buildare il compose senza cache
docker-compose up --build -d Per avviare il container
```
### 4. Verificare lo stato dei servizi
Assicurati che tutti i servizi siano in esecuzione correttamente:
```bash
docker-compose ps
```
### 5. Inizializzare l'applicazione Laravel
Accedi al container dell'applicazione per installare le dipendenze PHP e configurare l'applicazione:
```bash
docker exec -it tictactoe_app bash
```
All'interno del container, esegui i seguenti comandi:
```bash
composer install
php artisan key:generate
php artisan migrate:fresh --seed
```
Questi comandi installano le dipendenze, generano la chiave dell'applicazione e creano il database con i dati di esempio .
### 6. Eseguire il test
Sempre all'interno del container, puoi eseguire tutti i test del progetto:
```bash
composer test
```
