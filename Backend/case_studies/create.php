<?php
require_once __DIR__ . '/../../Functions/session.php';

// Überprüfen, ob das Formular abgesendet wurde und ob die Verbindung erfolgreich war
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Formulardaten validieren und mit der Datenbank überprüfen
  session_start();
  sessionManager(); // Überprüfe, ob der Benutzer angemeldet ist

  try {
    $mysqli = connectDatabase();

    // Formulardaten abrufen und escape
    $title = $mysqli->escape_string($_POST['title']);
    $description = $mysqli->escape_string($_POST['description']);
    $customer_id = $mysqli->escape_string($_POST['customer_id']);
    $image = $_FILES['image']['name'];

    // Verzeichnis für die Fallstudienbilder erstellen, falls es noch nicht existiert
    $case_studies_directory = __DIR__ . '/../../Images/case_studies/';
    if (!is_dir($case_studies_directory)) {
      mkdir($case_studies_directory, 0755, true);
    }

    // Das Fallstudienbilder in das Verzeichnis hochladen
    $image_path = $case_studies_directory . $image;
    move_uploaded_file($_FILES['image']['tmp_name'], $image_path);

    // Überprüfen, ob die Kunden-ID verhanden ist
    $stmt = $mysqli->prepare("SELECT id FROM customers WHERE id = ?");
    $stmt->bind_param("s", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
      // Kunden-ID existiert nicht
      $_SESSION['message'] = "Ungültige Kunden-ID";
      header("location: /webnetz/error/error.php");
      exit();
    } else {
      // Kunden-ID ist gültig, SQL-Abfrage ausführen, um die Fallstudie in die Datenbank einzufügen
      $stmt = $mysqli->prepare("INSERT INTO case_studies (image, title, description, customer_id) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("ssss", $image, $title, $description, $customer_id);

      if ($stmt->execute()) {
        // Fallstudie erfolfreich erstellt
        $_SESSION['message'] = "Fallstudie erfolgreich erstellt!";
        header("location: /webnetz/verify/sucess_case_studies.php");
        exit();
      }
    }
  } catch (Exception $e) {
    $_SESSION['message'] = 'Fehler beim Herstellen der Datenbankverbindung: ' . $e->getMessage();
    header("location: /webnetz/error/error.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Fallstudie erstellen</title>
  <link rel="stylesheet" type="text/css" href="../../CSS/style.css">
  <style>
    body {
      background-image: url("/webnetz/Images/case_studies/Background.jpg");
      background-repeat: no-repeat;
      background-size: cover;
    }
    .logo-container {
      position: absolute;
      top: 10px;
      left: 10px;
    }
  </style>
  <script src="../JS/script.js"></script>
</head>

<body>
  <div class="logo.container">
  <a href="https://www.web-netz.de"><img src="/webnetz/Images/logos/web-netz.png"></a> <!--Site Logo-->
  </div>
  <div id="container">
    <div id="full-body">
      <div class="form">
        <h1>Fallstudie erstellen</h1>
        <?php if (isset($success_message)) : ?>
          <p><?php echo $success_message; ?></p>
        <?php endif; ?>
        <?php if (isset($error_message)) : ?>
          <p><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="POST" enctype="multipart/form-data">
          <div class="field-wrap">
            <input type="file" id="image" name="image" accept="image/*" required>
            <label for="image"></label>
          </div>
          <div class="field-wrap">
            <input type="text" id="title" name="title" required>
            <label for="title">Titel</label>
          </div>
          <div class="field-wrap">
            <textarea id="description" name="description" required></textarea>
            <label for="description">Beschreibung</label>
          </div>
          <div class="field-wrap">
            <select name="customer_id" id="customer_id" style="margin-left: 90px;">
              <?php
              // Kunden aus der Datenbank abrufen und Optionen generieren
              $conn = new mysqli("localhost", "root", "", "case_studies_db");
              $customer_query = "SELECT id, name FROM customers";
              $customer_result = $conn->query($customer_query);
              while ($row = $customer_result->fetch_assoc()) {
                $customer_id = $row['id'];
                $customer_name = $row['name'];
                echo "<option value='$customer_id'>$customer_name</option>";
              }
              $conn->close();
              ?>
            </select>
            <label for="customer_id" style="display: flex; align-items: center;">Kunde:</label>
          </div>
          <div class="field-wrap">
            <input type="submit" value="Erstellen">
            <div class="back-button">
              <a href="/webnetz/Frontend/case_studies.php">Zurück zu Case Studies</a>
            </div>
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
        </form>
      </div>
    </div>
  </div>
</body>

</html>
