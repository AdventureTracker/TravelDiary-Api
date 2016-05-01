TravelDiary API and Web Interface
=========

[![Apiary Documentation](https://img.shields.io/badge/Apiary-Documented-blue.svg)](http://docs.traveldiaryapi.apiary.io/)

API pre zadanie z predmetu MTAA a DBS. Dokumentacia je napisana pomocou [API Blueprint](https://apiblueprint.org/), ktora je generovana pomocou sluzby [Apiary](https://apiary.io/).

Backend je postaveny na [Symfony](https://symfony.com) framewroku.

## Application description

Ucelom aplikacie TravelDiary je automatizovane vytvaranie cestovatelskych dennikoch, ktore archivuje, analyzuje a zdiela. Aplikacia sa sklada z dvoch hlavnych casti:

1.	Aplikacne rozhranie (dalej uz len API) – sucastou projektu je vypracovanie mobilnej aplikacie, ktora na server posiela data (pouzivatel pri cestovani zadava jednotlive body, ktore sa potom posielaju na server)
2.	Webove rozhranie (dalej uz len FRONTEND) – Pouzivatel ma k dispozicii webove rozhranie urcite na spravu prehlad vyletov, spravu zariadeni a zdielanie obsahu na socialnych sietach.

### Simple use case

1. Pouzivatel vytvori vylet pomocou weboveho rozhrania alebo mobilu:
   * Vie upravit zdielanie
   * Moze pridat spolucestovatelov
   * Nastavuje aktualny stav vyletu
   * Zakladne informacie o vylete (datum prichodu a odchodu, destinacia, popis, nazov)
2. Pomocou mobilnej aplikacie pocas cesty zadava body ktore navstivy. Tieto zaznamy mozu pridavat vsetcia ucastnici vyletu podla toho ako boli zadany pri jeho vytvarani
   * Automaticke zapisanie GPS suradnic
   * Moze pridat fotku
   * Zadava sa typ zaznamu (kempovanie, bivak, stopnute auto, zaujimavost, poznamka)
3. Za predpokladu ze sa zaznamy vzdy synchronizuju tak sa zobrazuju na webovou rozhreni zakreslene do mapy

## Technical stuff

Cele serverova cast  (API a FRONTED) je napisana na PHP frameworku Symfony2. Na abstrakciu od databazovej vrstvy sa pouziva ORM Doctrine2. Klientska cast je napisana na Materialize SCSS frameworku.

Projekt je rozdeleny na 3 casti (bundles):

1.	ApiBundle – obsahuje spravanie sa aplikacneho rozhrania
2.	CoreBundle – obsahuje konfiguraciu ORM mapovania, databazove entity a objekty formularov
3.	InterfaceBundle – aplikacna logika weboveho rozhrania

### Application interface

Aplikacne rozhranie je napisane podla navrhoveho vzoru REST a vymiena data pomocou JSON formatovania dat. Autorizacia je riesena pomocou OAuth mechanizmu.

Fotografie sa posielaju pomocou BASE64 kodovania.

Kompletna dokumentacia k API rozhraniu je publikovana tu: [Apiary documentation](http://docs.traveldiaryapi.apiary.io/)

#### API Monitor

Aby sme zlepsili prehlad na aktivitou aplikacneho rozhrania, naprogramovali sme jednoduchy API monitor (realizacia cez Redis NoSQL). Ukladame cas, metodu a URI vykonanje poziadavky. Ukazujeme aktivitu za posledny tyzden a poslednych 20 dotazov za aktualny den.

### Web interface

Hlavna cast weboveho rozhrania je poskytnutie prehladu o vyletoch a jeho zaznamoch. Pri vykreslovani mapy sa vyuziva Google API (konkretne Google Maps Javascript API – mapa samotna a Google Geolocation API – preklada suradnice na adresy).

Rozhranie tiez poskytuje CRUD operacie nad vyletmi, pouzivatelmi (registracia) a zariadeniami. Vytvaranie zaznamov o vylete nie je sucastou weboveho rozhrania.

### Database

#### Relation database

Ako hlavne ulozisko dat sa pouziva MariaDB vo verzii 10. Strultura DB je znazornena na diagrame nizsie.

![Entity relation diagram](https://github.com/MTAA-FIIT/TravelDiary-Api/raw/master/_docs/EER_v5.png)

Databazove exporty sa nachadzaju v priecinku [_db](https://github.com/MTAA-FIIT/TravelDiary-Api/raw/master/_db/)

### Redis

V projekte pouzivame aj nerelacnu Redis databazu. Vyuzitie sme nasli hlavne v oblasti cachovania zaznamov.

Pre pracu s Redis na Symfony frameworku pouzivame [SncRedisBundle](https://github.com/snc/SncRedisBundle), ktory pouziva klientsku PHP kniznicu [Predis](https://github.com/nrk/predis).

#### Cachovanie dat

Redis pouzivame na ukladanie ORM mapovania pre Doctrine modely a na ukladanie PHP Sessions. Tuto funkcionalitu nam poskytuje SncRedisBundle.

Dalej sme doprogramovali cachovanie vysledkov z [Google Geolocation API](https://developers.google.com/maps/documentation/geolocation/intro), ktore zobrazujeme v detailoch vyletu. Znizujeme tak pocet poziadaviek na Google API. Jedna sa o klasicku key-value tabulku. Z GPS suradnic vytvorime MD5 hash, ktory sa pouzije ako kluc.

```
geolocation:<md5(lati:long)> = Sieniawa, Poland
```

#### API Monitor

Vsetky data z API Monitoru sa ukladaju do Redis databazi ako list. Zaznamy ukladame na zaklade datumu.

```
api_requests:<Y-m-d> = Redis list
```


## Project status

Aplikacie je momentalne v stadiu vyvoja a preto nie su spristupneje jej vsetky casti.
1.	Aplikacne rozhranie je plne funkcne
2.	Webove rozhranie ma dokoncenie zobrazovanie vyletov a ich zaznamov, vykreslovanie na mapu + vyhladavanie. Taktiez dispouje plne funcnou autorizaciou.

## Todo

 - [X] Redis cache
    - [X] Cache doctrine vysledky
    - [X] APC alebo Redis pre Doctrine metadata?
    - [X] Redis na cache vysledkov z Google Geolocation API
 - [X] API monitor
    - [X] Pocet poziadavek na den v grafe za poslednych 30 dni
    - [X] Poslednych 20 poziadaviek (Redis by bol dost cool)
 - [ ] Spravca zariadeni
 	- [X] Odobratie zariadenia
 	- [ ] Pomenovanie zariadenia
 - [X] Paginacia ~~(skusit nasadit nejaky Bundle)~~
 	- [X] ~~Bundle na paginaciu~~
 	- [X] Nespravne sa aktualizuje pri vyhladavani
 	- [X] Nespravne sa zobrazuje ked nemame ziadne vysledky
 - [ ] Z destinacie vyletu spravit bod, ktory bude mat pri vyplnovavi odporucania z Google Geolocation API
 - [ ] Pridavanie spolucestovatelov cez HTML select ale vyhladavat na zaklade emailu, spravit asi API volanie
 - [ ] Sukromie nastavovat aj na TripRecord
 - [ ] API
 	- [ ] Users endpoint
 	- [ ] Vytvorit systemoveho pouzivatela ktory bude pristupovat zo servera
 - [ ] Autopost na socialne siete

## User bundles

 - [SncRedisBundle](https://github.com/snc/SncRedisBundle) - Redis

## Credentials

 - [Jakub Dubec](mailto:xdubec@stuba.sk)
 - [Barbora Celesova](mailto:xcelesova@stuba.sk)