<?php
session_start();

// Überprüfen, ob der Benutzer angemeldet ist
if (!isset($_SESSION['user_id'])) {
  // Benutzer ist nicht angemeldet, umleiten zur Anmeldeseite
  header("Location: /webnetz/Backend/redakteur/index.php");
  exit();
}

// Überprüfen, ob die Kunden-ID übergeben wurde
if (!isset($_GET['id'])) {
  // Kunden-ID wurde nicht übergeben, umleiten zur Kundenliste
  header("Location: /webnetz/Frontend/customers.php");
  exit();
}

// Kunden-ID abrufen
$customer_id = $_GET['id'];

// Verbindung zur Datenbank herstellen
$conn = new mysqli("localhost", "root", "", "case_studies_db");

// Überprüfen, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
  die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
}

// SQL-Abfrage ausführen, um den Kunden zu löschen
$query = "DELETE FROM customers WHERE id = $customer_id";
if ($conn->query($query) === TRUE) {
  // Kunde erfolgreich gelöscht
  $success_message = "Kunde erfolgreich gelöscht";
} else {
  // Fehler beim Löschen des Kunden
  $error_message = "Fehler beim Löschen des Kunden: " . $conn->error;
}

// Verbindung zur Datenbank schließen
$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
  <title>Kunde löschen</title>
  <link rel="stylesheet" type="text/css" href="../../CSS/case_studies.css">
  <style>
    body {
      background-image: url('/webnetz/Images/case_studies/case_studies_delete.jpg');
      background-size: cover;
      background-position: center;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: Arial, sans-serif;
    }

    .container {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 5px;
      text-align: center;
    }

    h1 {
      color: #333333;
    }

    p {
      margin-bottom: 10px;
    }

    a {
      color: #333333;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Kunde löschen</h1>
    <?php if (isset($success_message)) : ?>
      <p><?php echo $success_message; ?></p>
    <?php endif; ?>
    <?php if (isset($error_message)) : ?>
      <p><?php echo $error_message; ?></p>
    <?php endif; ?>
    <a href="/webnetz/Frontend/customers.php">Zurück zur Kundenliste</a>
  </div>
</body>

</html>