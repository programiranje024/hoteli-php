# Kolokvijum iz Web Programiranja za VTS

## Podešavanje projekta na WAMP
1. Kopirajte sadržaj `db/schema.sql` u phpMyAdmin i izvršite ga.
2. U `db-config.php` izmenite podatke za username, password, host da odgovara vašem sistemu.
3. Prebacite fajlove iz `www` u WAMP-ov `htdocs` (ili `www`, zavisi od WAMP verzije) folder.
4. Projekat će raditi na `http://localhost`

## Podešavanje projekta na Docker-u
1. `docker compose up -d`
2. `docker compose exec mysql sh`
3. `mysql -u hoteli -p`
4. Kada vas MySQL pita za lozinku upišite: `hoteli`
5. `USE hoteli`
6. Kopirajte sadržaj `db/schema.sql` u terminal/command prompt i izvršite ga.
7. Projekat će raditi na `http://localhost`
