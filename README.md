## [bla] matomo - Matomo (Piwik) Analytics für OXID eShop
version 2.5.0 ( 2019-01-23 )

## Funktionen:
1. Tracking der Seitenaufrufe
2. Shopinterne Suche
3. E-Commerce Tracking
4. benutzerdefinierte Dimensionen
5. Geo Location ( Besucher-IP nach Land auflösen ) 

## Installation OXID 6
````
$ composer require weiß-noch/nicht-was
````

##  Installation OXID 4
1. [https://github.com/vanilla-thunder/oxid-module-matomo/archive/master-v4.zip](https://github.com/vanilla-thunder/oxid-module-matomo/archive/master-v4.zip) herunterladen und entpacken
2. Inhalt von "copy_this" in den Shop hochladen
3. Modul aktivieren und Moduleinstellungen konfigurieren
4. Views aktualisieren
5. TPL Blocks hinzufügen: in **email/html/header.tpl** direkt nach ``<body ... >``  einfügen:  
    ````
    [{block name="email_html_header"}][{/block}]
    ````

## Konfiguration:
unter Erweiterungen -> Module -> [bestlife] Matomo Tracking -> Reiter "Einstellungen":
- **Matomo Server URL** und **Site ID** werden benötigt, damit überhaupt irgendwas funktioniert.
- **Auth Token** wird nur für Tracking über API *(PHP/Serverseitig, wird aktuell nicht verwendet)* und GeoIP Funktion benötigt
- Sofern Ziele und benutzerdefinierte Dimensionen gebraucht werden, müssen diese in Matomo erstellt und deren IDs in den Moduleinstellungen hinterlegt werden

### Konfiguration der Ziele in matomo
1. Newsletter Opt-In
    - Ziel ist erreicht: manuell
2. Newsletter Freischaltung (Opt-In bestätigt)
    - Ziel ist erreicht: manuell  
3. Newsletter Abmeldung
    - Ziel ist erreicht: manuell
4. Neue Registrierung
    - "Wenn vom Besucher" + "Die angegebene URL wird besucht" 
    - die URL beinhaltet ``/index.php?cl=register&success=1``
5. Neue Registrierung im Checkout
    - "Wenn vom Besucher" + "Die angegebene URL wird besucht" 
    - die URL beinhaltet ``/index.php?cl=payment&new_user=1&success=1``
6. Neue Bestellung
    - "Wenn vom Besucher" + "Die angegebene URL wird besucht" 
    - die URL beinhaltet ``/index.php?cl=thankyou``
  
### Benutzerdefinierte Dimensionen  
Das Modul unterstützt standardmäßig 5 benutzerdefinierte Dimensionen:
- Sprache
- Zahlungsart
- Versandart
- Versandadresse ( Rechnungsadresse / Packstation / Abweichende Lieferanschrift )
- Mediacode / REF

Um die benutzerdefinierten Dimensionen zu verwenden, muss das "custom dimensions" Plugin installiert und anschließend die entsprechenden Dimensionen erstellt werden.   
Mehr Infos zu benutzerdefinierten Dimensionen gibts hier: [https://matomo.org/docs/custom-dimensions/](https://matomo.org/docs/custom-dimensions/)

### Geo Location
Sofern Geo Location in Matomo konfiguriert ist, kann das Herkunftsland über die IP Adresse der Besucher bestimmt werden.  
Die Funktion ``[{$oViewConf->getCountryByIP()}]``  liefert den ISO Alpha-2 Kürzel ("DE", "AT", "US" etc) des lande.   
Weitere Infos zu Geo Location in Matomo: https://matomo.org/docs/geo-locate/

Beipsiel Code: ``[{if $oViewConf->getCountryByIP() == "DE"}]Kunde aus DE[{/if}]`` 


### Software Lizenz
   [bla] matomo - Matomo (Piwik) Analytics für OXID eShop  
   Copyright (C) 2018 bestlife AG  
   info:  oxid@bestlife.ag  
  
   This program is free software;  
   you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation;
   either version 3 of the License, or (at your option) any later version.
  
   This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;  
   without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
   You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>
