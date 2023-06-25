<?php
session_start();

// Überprüfen, ob der Benutzer angemeldet ist
if (!isset($_SESSION['logged_in'])) {
  // Benutzer ist nicht angemeldet, umleiten zur Anmeldeseite
  header("Location: ../redakteur/index.php");
  exit();
}

// Überprüfen, ob die Kunden-ID übergeben wurde
if (!isset($_GET['id'])) {
  // Kunden-ID wurde nicht übergeben, umleiten zur Kundenliste
  header("Location: ../../Frontend/customers.php");
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

// Überprüfen, ob das Formular abgesendet wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Formulardaten validieren und mit der Datenbank überprüfen

  // Formulardaten abrufen
  $name = $_POST['name'];
  $status = $_POST['status'];

  // Logo-Datei verarbeiten, falls hochgeladen wurde
  if ($_FILES['logo']['error'] === UPLOAD_ERR_OK) {
    $logo_tmp_name = $_FILES['logo']['tmp_name'];
    $logo_name = $_FILES['logo']['name'];
    $logo_destination = "../../Images/customers/" . $logo_name;

    // Logo-Datei verschieben
    if (move_uploaded_file($logo_tmp_name, $logo_destination)) {
      // Logo-Datei erfolgreich verschoben, aktualisiere den Datenbankeintrag
      $stmt = $conn->prepare("UPDATE customers SET name = ?, logo = ?, status = ? WHERE id = ?");
      if ($stmt->execute([$name, $logo_name, $status, $customer_id]) === TRUE) {
        // Kunde erfolgreich aktualisiert
        $success_message = "Kunde erfolgreich aktualisiert";
        header("Location: ../../Frontend/customers.php");
        exit();
      } else {
        // Fehler beim Aktualisieren des Kunden
        $error_message = "Fehler beim Aktualisieren des Kunden: " . $conn->error;
      }
    } else {
      // Fehler beim Verschieben der Logo-Datei
      $error_message = "Fehler beim Hochladen des Logos";
    }
  } else {
    // Keine Logo-Datei hochgeladen, aktualisiere den Datenbankeintrag ohne das Logo
    $stmt = $conn->prepare("UPDATE customers SET name = ?, status = ? WHERE id = ?");
    if ($stmt->execute([$name, $status, $customer_id]) === TRUE) {
      // Kunde erfolgreich aktualisiert
      $success_message = "Kunde erfolgreich aktualisiert";
      header("Location: ../../Frontend/customers.php");
      exit();
    } else {
      // Fehler beim Aktualisieren des Kunden
      $error_message = "Fehler beim Aktualisieren des Kunden: " . $conn->error;
    }
  }
}

// Kundeninformationen aus der Datenbank abrufen
$query = "SELECT * FROM customers WHERE id = $customer_id";
$result = $conn->query($query);
if ($result->num_rows === 1) {
  $customer = $result->fetch_assoc();
} else {
  // Kundendatensatz nicht gefunden, umleiten zur Kundenliste
  header("Location: ../../Frontend/customers.php");
  exit();
}

// Verbindung zur Datenbank schließen
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Kunde bearbeiten</title>
  <link rel="stylesheet" type="text/css" href="/webnetz/CSS/case_studies_edit.css">
</head>

<body>
  <div class="container">
    <a href="https://www.web-netz.de"><img src="/webnetz/Images/logos/web-netz.png"></a> <!-- Site Logo -->
    <h1>Kunde bearbeiten</h1>
    <?php if (isset($success_message)) : ?>
      <p><?php echo $success_message; ?></p>
    <?php endif; ?>
    <?php if (isset($error_message)) : ?>
      <p><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" value="<?php echo $customer['name']; ?>" required><br>
      <label for="logo">Logo:</label>
      <input type="file" id="logo" name="logo"><br>
      <label for="status">Status:</label>
      <select id="status" name="status">
        <option value="aktiv" <?php if ($customer['status'] === 'aktiv') echo 'selected'; ?>>Aktiv</option>
        <option value="inaktiv" <?php if ($customer['status'] === 'inaktiv') echo 'selected'; ?>>Inaktiv</option>
      </select><br>
      <button type="submit" class="edit-button">Kunde aktualisieren</button>
    </form>
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
  </div>
</body>

</html>
