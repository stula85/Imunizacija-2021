# Imunizacija-2021
Aplikacija za iskazivanje interesovanja građana za proces imunizacije protiv COVID-19. Namjenjena je Institucijama koje se bave procesom imunizacije (vakcinisanjem) građana kao alat za efikasnije praćenje interesovanja građana za proces imunizacije kao i IT podršku samom procesu imunizacije građana. 
**NAPOMENA: aplikacija prikuplja osjetljive lične podatke koji jesu ili mogu biti predmet Zakona o zaštiti ličnih podataka. Svaka Institucija, organizacija ili pojedinac koji bude prikupljao lične podatke građana putem ove aplikacije dužan je objezbjediti tajnost zbirki ličnih podataka u skladu sa zakonom. Autor kao ni tim programera koji održavaju ovu aplikaciju neće biti odgovorni za bilo koju zloupotrebu ličnih podataka prikupljenih putem ove aplikacije.**
## Instalacija
Aplikacija je razvijena korišćenjem CodeIgniter PHP Framework-a i nalazi se u /web direktoriju. Za instalaciju je potrebno da se sadržaj web direktorijuma prebaci na web server, da se importujete SQL dump fajl koji se nalazi u folderu SQL te da se izmjene sljedeća podešavanja:
* $config['base_url'], fajl application/config/config.php
* parametre za pristup bazi podataka u fajlu application/config/database.php

__Pristup backend dijelu__ ukoliko je $config['base_url'] podešen kao na primjer `$config['base_url'] = 'https://localhost/imunizacija/'` je: https://localhost/imunizacija/prijava
> __Korisničko ime:__ admin
> __Lozinka:__ admin
## Spisak funkcionalnosti
Aplikacija "Imunizacija 2021!" se sastoji iz dva dijela i to **Javnog** dijela koji nudi sljedeće funkcionalnosti:
* Prikaz statičnih stranica (Stranica dobrošlice, O projektu, Politika privatnosti);
* Prikaz forme za iskazivanje interesovanja za imunizaciju protiv virusa COVID-19;
* Po uspješnom popunjavanju forme (svih obaveznih polja) aplikacija šalje imejl građaninu sa obavještenjem o uspješno iskazanom interesovanju za imunizaiju protiv virusa COVID-19.
i **privatnog** dijela koji je namjenjen obrađivačima pristiglih prijava, a koji nudi sljedeće mogućnosti:
* Pregled spiska građana zainteresovanih za imunizaciju protiv virusa COVID-19;
* Pregled ličnih podataka građana prikupljenih kroz formu u **Javnom** dijelu aplikacije, a koji uključuju:
* * Podatke o državljanstvu;
* * JMBG ili Broj pasoša;
* * Ime;
* * Prezime;
* * Imejl adresu;
* * Broj mobilnog telefona;
* * Broj fiksnog telefona;
* * Opštinu/Grad u kojem građanin želi da izvrši proces imunizacije (Spisak opšina i gradova u Republici Srpskoj);
* * Podatke o specifičnim oboljenima (ukoliko takva postoje);
* * Podatke o pokretljivosti pacijenta (da li se građanin može samostalno kretati);
* * Podatak da li je građanin dobrovoljni davalac krvi.
* Pregled (filter) prijavljenih građana po opštinama/gradovima;
* Mogućnost pretrage prijavljenih građana po poljima: ime, prezime, jmbg ili broj pasoša;
* Mogućnost odabira datuma i vremena imunizacije građana kroz posebnu formu koja po uspješnom zakazivanju termina imunizacije obavještava građanina putem imejl adrese.
__NAPOMENA:__ ovo je trenutni spisak mogućnosti aplikacije. Planirano je da se spisak funkcionalnosti proširuje sa daljnjim razvojem projekta.
## Licenca
Aplikacija je objavljena pod GNU-ovom opštom javnom licencom verzija 3.
