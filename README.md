# Backend Test (Case Studies)

**Autor:** Nattapat Pongsuwan
**Abgabedatum:** 23.06.23

## Gedanken zu den Aufgaben

========================================== **Datenbankdesign** ==========================================

- Erstellen der Datenbank: Zuerst erstellst du eine Datenbank mit dem Namen "case_studies_db" (falls sie noch nicht existiert). Dies kann mit der SQL-Anweisung `CREATE DATABASE IF NOT EXISTS case_studies_db;` erreicht werden. Dann wechselst du zur Verwendung dieser Datenbank mit `USE case_studies_db;`.

- Tabelle für Redakteure erstellen: Du erstellst eine Tabelle namens "editors", um die Informationen der Redakteure zu speichern. Die Tabelle enthält Spalten wie "id" (eindeutige Kennung), "first_name" (Vorname), "last_name" (Nachname), "email" (E-Mail), "username" (Benutzername) und "password" (Passwort). Die Spalte "id" ist als Primärschlüssel mit der Option AUTO_INCREMENT definiert, um automatisch inkrementierte Werte zu generieren.

- Tabelle für Kunden erstellen: Du erstellst eine Tabelle namens "customers", um die Informationen der Kunden zu speichern. Die Tabelle enthält Spalten wie "id" (eindeutige Kennung), "name" (Name des Kunden), "logo" (Pfad zum Kundenlogo) und "status" (Status des Kunden, entweder 'aktiv' oder 'inaktiv'). Die Spalte "id" ist ebenfalls als Primärschlüssel mit AUTO_INCREMENT definiert.

- Tabelle für Case Studies erstellen: Du erstellst eine Tabelle namens "case_studies", um die Informationen der Fallstudien zu speichern. Die Tabelle enthält Spalten wie "id" (eindeutige Kennung), "image" (Pfad zum Bild der Fallstudie), "title" (Titel der Fallstudie), "description" (Beschreibung der Fallstudie) und "customer_id" (Verweis auf den Kunden, zu dem die Fallstudie gehört). Die Spalte "id" ist der Primärschlüssel und die Spalte "customer_id" ist ein Fremdschlüssel, der auf die "id" in der Tabelle "customers" verweist.

- Einfügen von Beispieldaten: Du fügst einige Beispiel-Datensätze in die Tabellen ein, um die Anwendung zu testen. Du fügst beispielsweise einen Redakteur, einige Kunden und einige Fallstudien hinzu. Stelle sicher, dass du die Pfade zu den Bildern und Logos entsprechend deiner Verzeichnisstruktur anpasst.

========================================== **Registrierung und Anmeldung des Redakteurs** ==========================================

- Der Code ist eine PHP-Datei, die eine Anmeldeseite erstellt. Es gibt zwei Formulare: eins für die Anmeldung und eins für die Registrierung. Die eingegebenen Daten werden über die POST-Methode an den Server gesendet. Die Anmeldeinformationen werden überprüft, und bei erfolgreicher Anmeldung wird der Benutzer eingeloggt. Beim Registrieren werden die eingegebenen Daten in der Datenbank gespeichert. Die Seite enthält auch Links zu rechtlichen Informationen. Es werden JavaScript-Dateien für zusätzliche Funktionalitäten geladen.

========================================== **Verwaltung der Kunden** ==========================================

- Die Verwaltung der Kunden erfolgt durch Funktionen zum Erstellen, Bearbeiten und Löschen von Kunden. Dabei habe ich die Logos etc. der Kunden in separaten Verzeichnissen gespeichert, die einen eindeutigen Bezug zu jedem Kunden haben.

========================================== **Verwaltung der Case Studies** ==========================================

- Die Verwaltung der Case Studies erfolgt soweit genau wie bei der Verwaltung der Kunden, zumindest die Funktionalität.

========================================== **Datenabruf und Anzeige** ==========================================

- Die Daten werden aus der Datenbank abgerufen und im Browser für den Nutzer angezeigt. Dabei werden nur aktive Kunden und deren Case Studies dargestellt, um die Übersichtlichkeit zu verbessern.

========================================== **Fehlerbehandlung** ==========================================

- Die Fehlerbehandlung wurde sorgfältig implementiert, um spezifische Fehlermeldungen auszugeben und dem Benutzer bei auftretenden Problemen angemessen zu informieren.

========================================== **Bonus: Optische Darstellung (Frontend)** ==========================================

Bei der Entwicklung der optischen Darstellung der Webapplikation habe ich verschiedene CSS-Dateien verwendet, um eine klare Struktur und eine leichtere Wartbarkeit des Codes zu erreichen.

- "style.css":
Die Datei "style.css" dient als zentrale Stylesheet-Datei für allgemeine Stilelemente, die auf der gesamten Webapplikation angewendet werden. Hier werden grundlegende Stileinstellungen definiert, wie Schriftarten, Farben, Hintergrundbilder, Abstände, Ausrichtung und andere globale CSS-Eigenschaften. Diese Datei wird von allen Seiten der Webapplikation referenziert, um einen konsistenten und einheitlichen Stil zu gewährleisten.

- "case_studies.css" und "customers.css":
Für die spezifische Gestaltung der Seiten "Case Studies" und "Kunden" habe ich separate CSS-Dateien erstellt. Die Datei "case_studies.css" enthält Stilelemente, die nur für die Case-Study-Seite gelten, während "customers.css" Stile für die Kundenseite enthält. Durch die Verwendung von separaten CSS-Dateien für diese spezifischen Seiten kann ich das Styling für jede Seite isolieren und organisieren. Dies erleichtert das Debuggen, die Anpassung und die Erweiterung des Designs in Zukunft. Manchmal kommt es vor, dass ich case_studies.css auch für Kunde-Seite verwendet und andersherum.

- "css.html":
Die Datei "css.html" ist ein HTML-Dokument, das dazu dient, die CSS-Dateien in die Webseiten einzubinden. Hier werden die Verweise auf die einzelnen CSS-Dateien definiert und in den entsprechenden HTML-Seiten eingebunden. Dies ermöglicht eine saubere und strukturierte Organisation des CSS-Codes und erleichtert die Wartung und Aktualisierung der Stile.

Durch die Verwendung separater CSS-Dateien für die spezifischen Seiten "Case Studies" und "Kunden" kann ich das Styling besser verwalten und die Wiederverwendbarkeit von CSS-Regeln verbessern. Dadurch bleibt der Code übersichtlich, leichter lesbar und wartbar. Die zentrale "style.css"-Datei gewährleistet die Konsistenz des Designs über die gesamte Webapplikation hinweg.

========================================== **Anmerkung** ==========================================

## Anmerkung
- Aktuell kann man keine Passwörter zurücksetzen. Die Funktion ist zurzeit nicht Funktionsfähig!