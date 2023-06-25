<?php
session_start();

// Überprüfen, ob der Benutzer angemeldet ist
if (!isset($_SESSION['user_id'])) {
  // Benutzer ist nicht angemeldet, umleiten zur Anmeldeseite
  header("Location: /webnetz/Backend/redakteur/index.php");
  exit();
}

// Überprüfen, ob die Fallstudien-ID übergeben wurde
if (!isset($_GET['id'])) {
  // Fallstudien-ID wurde nicht übergeben, umleiten zur Fallstudienliste
  header("Location: /webnetz/Frontend/case_studies.php");
  exit();
}

// Fallstudien-ID abrufen
$case_study_id = $_GET['id'];

// Verbindung zur Datenbank herstellen
$conn = new mysqli("localhost", "root", "", "case_studies_db");

// Überprüfen, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
  die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
}

// SQL-Abfrage ausführen, um die Fallstudie zu löschen
$query = "DELETE FROM case_studies WHERE id = $case_study_id";
if ($conn->query($query) === TRUE) {
  // Fallstudie erfolgreich gelöscht
  $success_message = "Fallstudie erfolgreich gelöscht";
} else {
  // Fehler beim Löschen der Fallstudie
  $error_message = "Fehler beim Löschen der Fallstudie: " . $conn->error;
}

// Verbindung zur Datenbank schließen
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Fallstudie löschen</title>
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
    <h1>Fallstudie löschen</h1>
    <?php if (isset($success_message)): ?>
      <p><?php echo $success_message; ?></p>
    <?php endif; ?>
    <?php if (isset($error_message)): ?>
      <p><?php echo $error_message; ?></p>
    <?php endif; ?>
    <a href="/webnetz/Frontend/case_studies.php">Zurück zur Fallstudienliste</a>
  </div>
</body>
</html>
