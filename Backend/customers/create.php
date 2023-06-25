<?php
session_start();

// Überprüfen, ob der Benutzer angemeldet ist


// Überprüfen, ob das Formular abgesendet wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Formulardaten validieren und mit der Datenbank überprüfen

  // Verbindung zur Datenbank herstellen
  $conn = new mysqli("localhost", "root", "", "case_studies_db");

  // Überprüfen, ob die Verbindung erfolgreich war
  if ($conn->connect_error) {
    die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
  }

  // Formulardaten abrufen
  $name = $_POST['name'];
  $logo = $_FILES['logo']['name'];
  $status = $_POST['status'];

  // Verzeichnis für das Kundenlogo erstellen, falls es noch nicht existiert
  $customer_directory = "/xampp/htdocs/webnetz/Images/customers/";
  if (!is_dir($customer_directory)) {
    mkdir($customer_directory, 0755, true);
  }

  // Das Kundenlogo in das Verzeichnis hochladen
  $logo_path = $customer_directory . $logo;
  move_uploaded_file($_FILES['logo']['tmp_name'], $logo_path);

  // SQL-Abfrage ausführen, um den Kunden in die Datenbank einzufügen
  $query = "INSERT INTO customers (name, logo, status) VALUES ('$name', '$logo', '$status')";
  if ($conn->query($query) === TRUE) {
    // Kunde erfolgreich erstellt
    $success_message = "Kunde erfolgreich erstellt";
    header("location: /webnetz/verify/sucess_customers.php");
  } else {
    // Fehler beim Erstellen des Kunden
    $error_message = "Fehler beim Erstellen des Kunden: " . $conn->error;
  }

  // Verbindung zur Datenbank schließen
  $conn->close();
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Kunde erstellen</title>
  <link rel="stylesheet" type="text/css" href="/webnetz/CSS/customers.css">
  <script src="../JS/script.js"></script>
</head>

<body>
  <a href="https://www.web-netz.de"><img src="/webnetz/Images/logos/web-netz.png"></a> <!--Site Logo-->
  <div class="container">
    <h1>Kunde erstellen</h1>
    <?php if (isset($success_message)) : ?>
      <p><?php echo $success_message; ?></p>
    <?php endif; ?>
    <?php if (isset($error_message)) : ?>
      <p><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
      <div class="form-field">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
      </div>
      <div class="form-field">
        <label for="logo">Logo:</label>
        <input type="file" id="logo" name="logo" accept="image/*" required>
      </div>
      <div class="form-field">
        <label for="status">Status:</label>
        <select id="status" name="status">
          <option value="aktiv">Aktiv</option>
          <option value="inaktiv">Inaktiv</option>
        </select>
      </div>
      <button type="submit" class="button">Kunde erstellen</button>
      <div class="back-button">
        <a href="/webnetz/Frontend/customers.php">Zurück zur Kundenliste</a>
      </div>
    </form>
  </div>
  <footer>
    <p>
      <a href="https://www.web-netz.de">&copy; 2023-<?php echo date("Y"); ?> Nattapat Pongsuwan</a>
      <span style="color: black">, All Rights Reserved.</span>
      <span style="color: black">|</span>
      <a href="terms.php">Terms</a>
      <span style="color: black">|</span>
      <a href="privacy.php">Privacy</a>
      <span style="color: black">|</span>
      <a href="contact.php">Contact</a>
    </p>
  </footer>
</body>

</html>