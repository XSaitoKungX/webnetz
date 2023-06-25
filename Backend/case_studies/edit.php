<?php
session_start();

// Überprüfen, ob der Benutzer angemeldet ist
if (!isset($_SESSION['logged_in'])) {
  // Benutzer ist nicht angemeldet, umleiten zur Anmeldeseite
  header("Location: ../redakteur/index.php");
  exit();
}

// Überprüfen, ob die Fallstudien-ID übergeben wurde
if (!isset($_GET['id'])) {
  // Fallstudien-ID wurde nicht übergeben, umleiten zur Fallstudienliste
  header("Location: ../../Frontend/case_studies.php");
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

// Überprüfen, ob das Formular abgesendet wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Formulardaten validieren und mit der Datenbank überprüfen

  // Formulardaten abrufen
  $title = $_POST['title'];
  $description = $_POST['description'];
  $customer_id = $_POST['customer_id'];

  // Bild/Logo verarbeiten
  $image = $_FILES['image'];
  $image_name = $image['name'];
  $image_tmp = $image['tmp_name'];
  $image_path = '../../Images/case_studies/' . $image_name;

  // Bild/Logo in den Zielordner verschieben
  move_uploaded_file($image_tmp, $_SERVER['DOCUMENT_ROOT'] . $image_path);

  // SQL-Abfrage ausführen, um die Fallstudie in der Datenbank zu aktualisieren
  $stmt = $conn->prepare("UPDATE case_studies SET image = ?, title = ?, description = ?, customer_id = ? WHERE id = ?");
  if ($stmt->execute([$image_path, $title, $description, $customer_id , $case_study_id]) === TRUE) {
    // Fallstudie erfolgreich aktualisiert
    $success_message = "Fallstudie erfolgreich aktualisiert";
    header("Location: ../../Frontend/case_studies.php");
  } else {
    // Fehler beim Aktualisieren der Fallstudie
    $error_message = "Fehler beim Aktualisieren der Fallstudie: " . $conn->error;
  }
}


// Fallstudieninformationen aus der Datenbank abrufen
$query = "SELECT * FROM case_studies WHERE id = $case_study_id";
$result = $conn->query($query);
if ($result->num_rows === 1) {
  $case_study = $result->fetch_assoc();
} else {
  // Fallstudien-Datensatz nicht gefunden, umleiten zur Fallstudienliste
  header("Location: ../../Frontend/case_studies.php");
  exit();
}

// Kundenliste aus der Datenbank abrufen
$customers_query = "SELECT * FROM customers";
$customers_result = $conn->query($customers_query);
$customers = [];
while ($row = $customers_result->fetch_assoc()) {
  $customers[] = $row;
}

// Verbindung zur Datenbank schließen
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Fallstudie bearbeiten</title>
  <link rel="stylesheet" type="text/css" href="../../CSS/case_studies.css">
  <style>
    body {
      background-image: url('/webnetz/Images/case_studies/Background.jpg');
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

    form {
      display: inline-block;
      text-align: left;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input, textarea, select {
      width: 100%;
      padding: 5px;
      margin-bottom: 10px;
    }

    button {
      padding: 10px 20px;
      background-color: #333333;
      color: #ffffff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    footer {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      background-color: #ffffff;
      padding: 10px;
      text-align: center;
    }

    footer p {
      margin: 0;
    }

    footer a {
      color: #333333;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <a href="https://www.web-netz.de"><img src="/webnetz/Images/logos/web-netz.png"></a> <!--Site Logo-->
    <h1>Fallstudie bearbeiten</h1>
    <?php if (isset($success_message)): ?>
      <p><?php echo $success_message; ?></p>
    <?php endif; ?>
    <?php if (isset($error_message)): ?>
      <p><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
      <label for="title">Titel:</label>
      <input type="text" id="title" name="title" value="<?php echo $case_study['title']; ?>" required><br>
      <label for="description">Beschreibung:</label>
      <textarea id="description" name="description" required><?php echo $case_study['description']; ?></textarea><br>
      <label for="customer_id">Kunde:</label>
      <select id="customer_id" name="customer_id">
        <?php foreach ($customers as $customer): ?>
          <option value="<?php echo $customer['id']; ?>" <?php if ($customer['id'] === $case_study['customer_id']) echo 'selected'; ?>><?php echo $customer['name']; ?></option>
        <?php endforeach; ?>
      </select><br>
      <label for="image">Bild/Logo:</label>
      <input type="file" id="image" name="image"><br>
      <button type="submit">Fallstudie aktualisieren</button>
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
