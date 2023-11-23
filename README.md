# Referensimplementation SPAR Personsök program-program

> **Obeservera:** Referensimplementationer för senare versioner av SPAR Personsök program-program finns på https://www.statenspersonadressregister.se  
> Denna Github-organisation kommer att upphöra per 2024-05-31.

Denna källkod är en referensimplementation av SPAR Personsök program-program version _2021.1_.

Referensimplementationen använder _PHP5_ och dess stöd för _SOAP_, 
[SoapClient](http://php.net/manual/en/book.soap.php).

Lösningen är testad med _Apache HTTPD 2.4.6_, _PHP 5.4.16_ och _PHP SoapClient 5.4.16_. Dessa äldre versioner har säkerhetsbrister, 
vilket inte utgör ett problem för utveckling eller test. 
I produktion rekommenderar vi **_starkt_** att senaste stabila versionen används.

För mer information om SPAR på såväl verksamhets- som teknisk nivå se
[SPAR:s hemsida](https://www.statenspersonadressregister.se).

## Användning

Medföljande _Dockerfile_ kan användas för att bygga en Dockerimage. Den startar en container innehållande en
webbserver med referensimplementation.

För mer information om Docker, se [docker.com](https://www.docker.com/).

## Kundtestmiljö

Vi rekommenderar att det organisationscertifikat som är tänkt att användas i produktion även används vid tester mot kundtestmiljön,
detta för att i ett tidigt skede verifiera att certifikatet är korrekt.

## Produktionsmiljö

Om koden används för att integrera mot produktionsmiljönn krävs:
 * Ett giltigt organisationscertifikat (det inkluderade testcertifikatet fungerar endast i kundtestmiljön). 
 * Korrekt indetifieringsinformation, se
 * _KundNrLeveransMottagare_
 * _KundNrSlutkund_
 * _UppdragId_
 
För mer information kontakta SPAR:s kundtjänst.

För att gå mot produktion behöver URL ändras från kundtest-URL: https://test-personsok.statenspersonadressregister.se/2021.1/ till produktions-URL: https://personsok.statenspersonadressregister.se/2021.1/

Om verifiering av _CN_match_ används behöver den uppdateras för produktion.

**Vi rekommenderar starkt att organisationscertifikatet skyddas så att ingen obehörig kan komma åt det i webbläsaren.**

Exempel på hur man kan skapa certifikat i _PEM-format_ finns under Teknisk info på [SPAR:s hemsida](https://www.statenspersonadressregister.se).

