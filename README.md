# Kassa system, PHP och Mysql


## Krav

- PHP Version 8.1.6 eller senare


- Mysqlnd 8.1.6 eller Senare


- PHPmyadmin


## Installation och Hur Använder man

1. På eran hosting service, ladda ner php, mysql och phpmyadmin.


2. På phpmyadmin, importera “shopDB.sql” genom att klicka på Import knappen i topp fältet.


3. När den är färdig har den skapat databasen som behövs.


4. Gå in i config.php och ändra host, till IP adressen som används av hosting tjänsten, och ändra user och password till rätt.


Med det klart så kan du nu skapa ett konto, där du behöver gå tillbaka till phpmyadmin och gå in i accounts tabellen, där du behöver ändra ditt kontos user_type variabel till 1, så blir denna kontot ett admin konto. 

Efter det så bör du trycka på edit products i webbsidan, och sedan klicka på register new product, där du behöver skriva in värdena på produkten och dess barcode, utifall det är en produkt med ingen barcode till exempel ett äpple, så kommer du behöva skriva minst en 3 siffrig nummer. Efter detta är klart så behöver du gå till add product knappen och då använda samma nummer, du kan alternativt om du redan vet vilken produkt det är, eller vet att den finns så kommer det finnas en knapp på denna produkt där du kan då trycka på för att lägga dens barcode i fältet, och då kan du välja bäst-före datum och hur många av dessa produkter du skannar.

Då är lagret klart, nu för att registrera ett köpt så kan du gå till add purchase, där alla produkter finns och en barcode scanning som kommer föreslå produkten med mest liknande barcode. Då kan du trycka på den för att lägga till. 

När det kommer till betalning så väljer du mellan Swish eller Kontant, genom att trycka på tangent knapparna för S eller C, S är Swish, C är Kontant. Om du väljer kontant så kommer en ruta finnas där du skriver in hur mycket kunden ger i retur och om det överstiger det pris som du har så behöver du trycka på “Get Cash Return”, när du har gett kunden dess pengar, kan du då trycka på “confirm payment”. 



## Utveckling

### Databas och köp funktioner (Richards del)

I detta projekt hade jag uppgiften att göra databasen för produkter, och köp, sedan behövde jag arbeta med sidan så att databasen är kopplad och fungerande. Jag gjorde också så att man kan se månadens inkomst och dagliga inkomst rapport. Totalt spenderade jag 52 timmar på utvecklingen av dessa system.

### Kontosystem (Sannas del)
Starten på kontosystemet var att först skapa en tabell i en MySQL databas som skulle innehålla alla konton. Tabellen fick ett namn som är lätt att koppla till dens syfte, Accounts, som innehåller information för kontots unika ID nummer som är satt till primär nyckel, användarnamn vilket är en unik nyckel, kontotyp (om kontot är administratör eller inte), email som också är en unik nyckel, lösenord och datum konton registrerades. ID nummer är en primär nyckel eftersom det inte ska finnas samma ID på flera konton, och värdet den får ökar med 1 varje gång ett konto skapas. Konto typ är alltid 0 tills man manuellt ändrar den och registrerad datum sparar nuvarande datumet som kontot skapades.

Innan registreringssidan sattes upp skapades loggin funktionaliteten med sin loginsida. För att kunna testa sidan registrerades en konto genom kodning då registreringsfunktionaliteten inte hade blivit implementera än. Det som behövs på sidan är ett formulär som tar in användarnamn och lösenord som sedan sparas när man försöker logga in. Det sparade användarnamnet används för att söka efter ett konto som då har ett likadant användarnamn, och när det hittar ett matchande konto jämförs lösenorden med varandra för att se till att inte vem som helst kan logga in till kontot. Därefter om man lyckas loggan blir man skickad till startsidan om man är en vanlig användare medan administratörer blir skickade till administratör-sidan. 

När det viktigaste med loggin sidan var färdig skulle registreringssidan implementeras. Denna sida behövde också ett formulär som tar användarnamn och lösenord men också email som en användare anger för databasen att lagra genom MySQL query. Resten av datan som lagras för varje konto (ID nummer, konto typ och registrerad datum) genereras automatisk. Registreringen sker när användaren har har tryckt på registreringsknappen och angett bra värden till formuläret. Eftersom användarnamn och email är unika nycklar så kommer kontot inte skapas om det redan finns ett konto som är likadana värden. 

Detta tog ungefär 5 timmar.

Efteråt ordnades admin-sidan så att man skulle kunna se alla konton som hade registrerats. Det gjordes genom att hämta all data från tabellen Accounts med MySQL query som går igenom varje rad med en loop för att tillägga varje rads data i en html tabell. Varje konto fick knappar som gav användaren som var på sidan möjlighet att ändra vad för konto typ det valda kontot skulle vara. Beroende på om kontot var administratör kunde man bara ta bort kontots admin status men om det var ett vanligt konto kunde man antingen ge den admin status eller radera den.

För att göra det lättare för användaren att se vilka konton som är administratörer eller vanliga användes en for loop som börjar på 1 som representerar admin och minskar till 0 för vanlig a användare, då när tabellen med konton genereras gör den en tabell med bara konton av typ 1 först och sedan en ny tabell med bara kontotyp 0. Alltså får man två tabeller som bara innehåller administratörer eller vanliga konton. 

Detta tog 2-3 timmar.

Sedan för att undvika problemet med att hitta konton om databasen någon gång har massvis med konton blev en sökruta tillagde. När man hade sökt efter användare sparas värdet som finns i sökrutan i en variable för att senare använda MySQL query för att hämta raderna som liknar datan i variablen och skapar en ny tabell som bara visar konton med liknande användarnamn ovanför de existerande tabellerna. 

Därefter behövdes också ett sätt för användaren att sortera tabellen vilket gjordes via javascript. Tack vare att all data var sparad som text även om det innehöll nummer och symboler underlättade det med processen att få sorteringen att fungera med alla kolumner/kategorier. Enkelt förklarat så sorterades tabellen man agerade med beroende på kategorien man tryckte på och om man trycke igen flippades ordningen av sorteringen.

Detta tog också runt 5 timmar.

För att en vanlig användare också skulle ha kontroll av sitt egna konto skapades en profil-sida så att användaren kan uppdatera deras konto data och till och med radera kontot. När kan kommer in till sidan är man välkomnad av en ruta med som visar ens använder namn och email vilket görs genom att när man har loggat in sparas dem i en session variabel för att sedan hämtas för att användas på sidan. Under det får användaren två alternativ som hen kan utföra. Antingen redigera kontot eller logga ut. Om logga ut väljs blir man skickad till startsidan och allt i session töms. Detta hör senare ihop med att om man försöker komma åt profilsidan utan att vara inloggad blir man tillbaka skickad till startsidan innan ens profilsidan hinner ladda in. Samma princip gäller admin-sidan då det finns en variable som håller koll på kontotypen. Däremot om användaren väljer att redigera kontot visas ett formulär där man kan skriva in ett nytt användarnamn, email och lösenord samt visas två klappar, en för att godkänna redigeringen och den andra för att radera kontot. När användaren redigerar kontot finns det några kontrolleringar så som när man uppdaterar kontot behöver man säkerhets kolla att den som redigerar kan kontots lösenord eller om inget har skrivit i t.ex. att redigera användarnamn så utförs inte ändringen för det som har lämnats tomt. Sedan om användaren väljer att radera kontot dyker en säkerhetskoll upp för att fråga om användaren verkligen vill radera kontot eller inte så att man inte råkar radera med misstag. 

Detta tog 5 timmar som dem andra gångerna.


### HTML & CSS (Kenji's del)

Mitt bidrag till arbetet har varit majoriteten av HTML och CSS på sidan och lite planering i början av projektet. På två veckor har jag spenderat cirka 39 timmar på projektet under perioden av 7 stycken 6 timmarsdagar. 

Ett problem med hemsidans CSS var att hitta ett passande tema, detta skulle vara en administrativ sida som en kassör ska kunna använda så det var viktigt att ha all information tillgänglig och enkel att navigera samt en simplistisk design som inte distraherar användaren med färger. Vi valde att använda en uppfällbar navigeringsmeny som skulle innehålla länkar till alla andra sidor och funktioner. Däremot så märkte man snabbt att det blev jobbigt att öppna upp menyn varje gång varje gång man behövde använda den. Vi valde då att slå ihop några sidor och lägga knapparna direkt på navigeringsfältet för att minska antalet knapptryck. 


Mot slutet blev det svårt att effektivt hitta och ändra de olika delarna eftersom att det fanns så många HTML dokument och mycket style i Index.CSS filen. Jag tror att det hade varit enklare att dela upp stylen i flera CSS dokument eller skapa en mer organiserad struktur. Eftersom att alla skriver kod annorlunda var det en utmaning att kunna hålla hemsidans tema konsekvent och hålla ett enhetligt tema.  

I efterhand har jag blandade åsikter om mitt arbete eftersom jag känner att jag kunde ha gjort mycket bättre än slutresultatet men den matchade den planerade designen och dess funktionalitet. Under detta projekt har jag lärt mig mer om PHP Include som minskar repeterad kod, media query för mobilanpassade sidor och generellt hur man jobbar på ett projekt i en grupp av flera utvecklare. I ett framtida projekt så skulle jag kunna skapa en bättre html och css struktur och göra en mer responsiv design. 
