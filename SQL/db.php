<?php

function connectDatabase() {
    // MySQL-Datenbankverbindungseinstellungen
    $servername = 'localhost'; // Hostname der Datenbank
    $user = 'root'; // Benutzername der Datenbank
    $password = ''; // Passwort der Datenbank
    $dbname = 'case_studies_db'; // Name der Datenbank

    // Erstellen einer Verbindung zur Datenbank
    $mysqli = new mysqli($servername, $user, $password, $dbname);
    
    // Überprüfen, ob eine Verbindung hergestellt werden konnte
    if ($mysqli->connect_error) {
        throw new Exception('Verbindung zur Datenbank fehlgeschlagen: ' . $mysqli->connect_error);
    }
    
    return $mysqli;
}
