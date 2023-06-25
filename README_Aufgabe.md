Backend Test (Case Studies)
===========================

* **Zeiteinsatz**: Nicht limitiert. Abgabedatum
* **Umzusetzen in**: HTML, CSS, PHP, Javascript und MySQL / MariaDB.

Es muss eine Webapplikation zur Verwaltung von "Case Studies" erstellt werden.
Dazu können Frameworks verwendet werden.

Wir empfehlen für die Aufgabe die Verwendung von **XAMPP** oder ähnlichen Tools mit entsprechendem Funktionsumfang.
Nativ auf einer Linux Distribution ist natürlich auch eine Option.

**Folgende Entitäten müssen bereitgestellt werden**
* Redakteur
  * Eindeutige Kennung (ID)
  * E-Mail oder Benutzername
  * Passwort
* Kunde
  * Eindeutige Kennung (ID)
  * Name
  * Logo
  * Status (aktiv / inaktiv)
* Case Study
  * Eindeutige Kennung (ID)
  * Bild
  * Titel
  * Beschreibung
  * Bezug zum Kunden

Damit wird vorgegeben welche Daten in den Aufgaben der Applikation erwartet werden.

**Aufgaben der Applikation:**

1. Es muss eine Datenbank unter berücksichtigung der Entitäten implementiert werden.
   * Redakteure müssen in der Datenbank gespeichert werden.
   * Kunden müssen in der Datenbank gespeichert werden.
   * Case Studies müssen in der Datenbank gespeichert werden.
2. Der Redakteur muss sich registrieren und anmelden können.
   * Der Redakteur muss sich nur mit seinen eigenen Daten anmelden können.
   * Das Passwort eines Redakteurs kann verschlüsselt gespeichert werden.
   * Ein Redakteur kann sich abmelden.
3. Der Redakteur muss neue Kunden anlegen können.
   * Der Redakteur kann bestehende Kunden bearbeiten.
   * Der Redakteur kann bestehende Kunden löschen.
   * Das Logo des Kunden muss je Kunde in einem eigenen Verzeichnis gespeichert werden. Das Verzeichnis muss ein Bezug auf den jeweiligen Kunden haben. 
4. Der Redakteur muss neue Case Studies anlegen können.
   * Der Redakteur kann bestehende Case Studies bearbeiten.
   * Der Redakteur kann bestehende Case Studies löschen.
   * Die Bilder der Case Studies müssen an einem zentralen Ort gespeichert werden.
   * Die Beschreibung einer Case Study kann über einen HTML-Editor (WYSIWYG) hinzugefügt werden.
5. Kunden und Case Studies müssen aus der Datenbank ausgelesen und für den Nutzer im Browser dargestellt werden.
   * Der Nutzer der Webapplikation muss (ohne Authentifikation) alle Kunden und dessen Case Studies aufrufen können.
   * Der Nutzer kann nur aktive Kunden und dessen Case Studies aufrufen.
6. Bei Fehlern können entsprechend spezifizierte Fehlermeldungen ausgegeben werden.

Die optische Darstellung (Frontend) der Applikation ist nicht kritischer Bestandteil der Aufgabe und muss nicht beachtet werden.
Sie kann aber als Bonus in der Auswertung berücksichtigt werden.

Für die Darstellung dürfen ebenfalls Frameworks verwendet werden.

Einreichung
-----------
Zur Abgabe muss der Code und eine `README.md` mit deinem Namen, dem Abgabedatum, und ein paar Gedanken zu deiner Arbeit als ZIP-Archiv zur Verfügung gestellt werden.

Wenn die Datenbank nicht im Prozess der Applikation erstellt wird, muss ein Schema oder ein "dump" der Datenbank beiliegen.

Wir empfehlen vorab zu prüfen, ob das Projekt so wie abgegeben lauffähig ist.

Terminologie
------------
Die in diesem Dokument verwendeten Begriffe “MUSS”, “DARF NICHT”, “ERFORDERLICH”, “KANN”, “MUSS NICHT”, “SOLL”, “SOLL NICHT”, “EMPFOHLEN”, “NICHT EMPFOHLEN”, “KÖNNTE”, “OBLIGATORISCH” und “OPTIONAL” müssen gemäß [BCP 14](https://tools.ietf.org/html/bcp14), [RFC 2119](https://datatracker.ietf.org/doc/html/rfc2119) interpretiert werden.

Autor / Lizenz
--------------
Copyright © 2020-2023, [web-netz GmbH](https://www.web-netz.de/)

Proprietäre Lizenz