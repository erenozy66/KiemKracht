
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

1. Clone de repository:

```bash
    git clone <https://github.com/erenozy66/KiemKracht>
    cd project
```
2. Installeer dependencies:

```bash
    composer install
```

3. Maak .env bestand:

```bash
    cp .env.example .env
```

4. Genereer app key:

```bash
    php artisan key:generate
```

5. Configureer database in .env

6. Run migraties + seeder:

```bash
    php artisan migrate --seed
```

7. Storage linken:

```bash
    php artisan storage:link
```

8. Start server:

```bash
    php artisan serve
```
