<?php
require_once '../../SQL/db.php'; // Annahme: Datei, die die Datenbankverbindung enthält
require_once __DIR__ . '/../../Functions/session.php'; // Datei mit der Funktion registerUser
session_start();

// Verbindung zur Datenbank herstellen und das Ergebnis in $mysqli speichern
$mysqli = connectDatabase();

// Überprüfen, ob das Formular abgesendet wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Daten aus dem Formular übernehmen
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Aufruf der Funktion registerUser
    registerUser($mysqli);
}

// Den restlichen Code für die Anzeige des Registrierungsformulars hier einfügen
?>
