# Projekt - REST-webbtjänst + administrationsgränssnitt

Webbtjänsten har stöd för CRUD och gör anrop mot en MySQL-databas. Vilken metod som anropet innehåller kontrolleras med en switch-sats som sedan gör efetrfrågat anrop mot databasen.
Metoderna POST, PUT och DELETE är lösenordsskyddade, man behöver alltså vara inloggad i administrationsgränssnittet för att kunna lägga till, ändra eller ta bort data.

URL till webbtjänst: http://studenter.miun.se/~emno1501/dt173g/projekt/rest/cv.php/ + kategori* 

***kategorier** : 
* education
* workexperience
* websites

## För att göra anrop mot webbtjänsten

För att hämta data om utbildningar måste /education läggas till i slutet av URL:en i anropet till webbtjänsten.
För att hämta data om arbetserfarenhet måste /workexperience läggas till i slutet av URL:en.
För att hämta data om skapade webbplatser måste /websites läggas till i slutet av URL:en.

För att hämta data om en specifik arbetserfarenhet, utbildning eller webbplats läggs ID:t till denna ytterligare till i slutet av URL:en

## Administrationsgränssnitt

URL:en till administrationsgränssnittets inloggningssida är följande:
http://studenter.miun.se/~emno1501/dt173g/projekt/rest/admin.php

I administrationsgränssnittet finns tre flikar, en för varje CV-område (utbildningar, arbetserfarenheter och webbplatser), genom att klicka på någon av dessa får man fram en tabell som innehåller all data om aktuellt område samt ett formulär för att lägga till ny data och ett för att uppdatera data.
I tabellen finns en ta bort-knapp för varje rad me data.
När ID:t fylls in i uppdateringsformuläret fylls automatiskt resten av fälten i med datan för objektet med det ID:t.

När data tas bort, läggs till eller uppdateras, uppdateras automatiskt tabellen utan att sidan behöver laddas om.

Högst upp i högra hörnet finns en Logga ut-knapp som tar en tillbaka till inloggningssidan.

**Inloggning till administrationsgränssnitt:**

Användarnamn: adminEmmasCV

Lösenord: password123
