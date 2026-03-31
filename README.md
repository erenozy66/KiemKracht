
# KiemKracht - Ticket Systeem



## 📌 Overzicht


Dit project is een Laravel-applicatie ontwikkeld als onderdeel van een sollicitatieopdracht, de applicatie maakt het mogelijk om tickets te uploaden en voorziet een beveiligde omgeving .


## ⚙️ Functionaliteiten
#### Publiek
-   Indienen van tickets (naam, e-mail, bestand)
-   Validatie van invoer en bestandstype
- Feedback na succesvolle verwerking

#### Intern (beveiligd)
-   Authenticatie (login/logout)
-   Overzicht van alle tickets
-   Zoeken op naam en e-mail
-   Sorteren (nieuwste / oudste)
-   Paginatie
-   Tickets bewerken en verwijderen
-   Bestanden bekijken

## 👤 Test login

**Email:** admin@admin.com

**Wachtwoord:** admin

## 📎 Extra

- Unieke bestandsnamen (naam + teller) om overschrijven te voorkomen


## 🚀 Installatie

```bash
    git clone https://github.com/erenozy66/KiemKracht.git
    cd KiemKracht
    composer install
    cp .env.example .env
    php artisan key:generate
```
## ⚙️ Database instellen
Optie 1 — MySQL

Pas .env aan:

```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=kiemkracht
    DB_USERNAME=root
    DB_PASSWORD=
```
Maak de database aan in phpMyAdmin: kiemkracht

Optie 2 — SQLite

Pas .env aan:

```bash
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=kiemkracht
# DB_USERNAME=root
# DB_PASSWORD=
```
Link de database naar het bestand:
```bash
    DB_DATABASE=database/database.sqlite
```
Maak een leeg bestand aan op deze locatie:
```bash
    database/database.sqlite
```

## 🧱 Database + storage
```bash
    php artisan migrate --seed
    php artisan storage:link
```
## ▶️ Start applicatie

```bash
    php artisan serve
```
