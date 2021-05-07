# Imunizacija-2021
Aplikacija za iskazivanje interesovanja građana za proces imunizacije protiv COVID-19. Namijenjena je institucijama koje se bave procesom imunizacije (vakcinisanjem) građana kao alat za efikasnije praćenje interesovanja građana za proces imunizacije, kao i IT podršku samom procesu imunizacije građana.

**NAPOMENA: aplikacija prikuplja osjetljive lične podatke koji jesu ili mogu biti predmet Zakona o zaštiti ličnih podataka. Svaka institucija, organizacija ili pojedinac koji bude prikupljao lične podatke građana putem ove aplikacije dužan je objezbijediti tajnost zbirki ličnih podataka u skladu sa zakonom. Autor, kao ni tim programera koji održavaju ovu aplikaciju neće biti odgovorni za bilo koju zloupotrebu ličnih podataka prikupljenih putem ove aplikacije.**
## Instalacija
Aplikacija je razvijena korišćenjem CodeIgniter PHP Framework-a i nalazi se u /web direktorijumu. Za instalaciju je potrebno da se sadržaj web direktorijuma prebaci na web server, da se importuje SQL dump fajl koji se nalazi u folderu SQL, te da se izmijene sljedeća podešavanja:
* $config['base_url'], fajl application/config/config.php
* parametre za pristup bazi podataka u fajlu application/config/database.php

__Pristup backend dijelu__ ukoliko je $config['base_url'] podešen kao na primjer `$config['base_url'] = 'https://localhost/imunizacija/'` je: https://localhost/imunizacija/prijava
> __Korisničko ime:__ admin
> __Lozinka:__ admin
## Spisak funkcionalnosti
Aplikacija "Imunizacija 2021!" se sastoji iz dva dijela:

### Javni deo 
namijenjen građanima za prijavu za vakcinaciju sa sljedećim funkcionalnostima:
* Prikaz statičnih stranica (Stranica dobrošlice, O projektu, Politika privatnosti);
* Prikaz forme za iskazivanje interesovanja za imunizaciju protiv virusa COVID-19;
* Po uspješnom popunjavanju forme (svih obaveznih polja) aplikacija šalje imejl građaninu sa obavještenjem o uspješno iskazanom interesovanju za imunizaciju protiv virusa COVID-19.

### Privatni deo 
namijenjen je obrađivačima pristiglih prijava i nudi sljedeće funkcionalnosti:

* Pregled spiska građana zainteresovanih za imunizaciju protiv virusa COVID-19;
* Pregled ličnih podataka građana prikupljenih kroz formu u **Javnom** dijelu aplikacije, a koji uključuju:
    * Podatke o državljanstvu;
    * JMBG ili Broj pasoša;
    * Ime;
    * Prezime;
    * Imejl adresu;
    * Broj mobilnog telefona;
    * Broj fiksnog telefona;
    * Opštinu/Grad u kojem građanin želi da izvrši proces imunizacije (Spisak opšina i gradova u Republici Srpskoj);
    * Proizvođača vakcine za koju je građanin iskazao interesovanje;
    * Podatke o specifičnim oboljenjima (ukoliko takva postoje);
    * Podatke o pokretljivosti pacijenta (da li se građanin može samostalno kretati);
    * Podatak da li je građanin dobrovoljni davalac krvi.
* Pregled (filter) prijavljenih građana po opštinama/gradovima;
* Mogućnost pretrage prijavljenih građana po poljima: ime, prezime, jmbg ili broj pasoša;
* Mogućnost odabira datuma i vremena imunizacije građana kroz posebnu formu (vakcinacija ili revakcinacija) koja po uspješnom zakazivanju termina imunizacije obavještava građanina putem imejl adrese;
* Pregled spiska pacijenata kojima je zakazana imunizacija;
* Mogućnost pretraživanja spiska zakazanih pacijenata;
* Pregled pacijentovog kartona sa detaljima o zakazanom terminu imunizacije;
* Mogućnost sprovođenja imunizacije kroz posebnu formu koja omogućava odabir proizvođača vakcine i unos serije vakcine koju pacijnt prima. Osim ovih podataka sistem automatski unosi datum i vrijeme imunizacije i ovim podacima nije moguće manipulisati;
* Po uspješno popunjenoj formi aplikacija generiše Potvrdu o uspješno sprovedenoj imunizaciji pacijenta u PDF formatu sa QR code-om;
* Sastavni dio aplikacije čine sljedeći Šifrarnici:
   * Opštine/Gradovi, kroz ovaj modul moguće je uređivati spiskove opština i gradova;
   * Vakcine, kroz ovaj modul moguće je uređivati spiskove vakcina koje građani mogu birati kroz formu za iskazivanje iteresovanja za proces imunizacije;
   * Oboljenja, modul sa spiskom specifičnih oboljenja;
   * Korisnici, modul za uređivanje korisnika i korisničkih privilegija za pristup aplikaciji.

__NAPOMENA:__ ovo je trenutni spisak mogućnosti aplikacije. Planirano je da se spisak funkcionalnosti proširuje sa daljnjim razvojem projekta.

## Opšta diskusija
Diskusija koja se vodi vezano za ovaj projekat je u potpunosti transparentna i dostupna na Telegram grupi.  
 Telegram invite link: https://t.me/imunizacija2021dev

## Licenca
Aplikacija je objavljena pod GNU-ovom opštom javnom licencom verzija 3.
