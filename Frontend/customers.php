<?php
// Start der Sitzung
require_once '../Functions/session.php';

sessionManager(false);

?>

<!DOCTYPE html>
<html>

<head>
  <title>Kunden</title>
  <link rel="stylesheet" type="text/css" href="../CSS/style.css">
  <style>
    body {
      background-image: url('../Images/customers/Background.jpg');
      background-size: cover;
      background-repeat: no-repeat;
    }

    h1 {
      text-align: center;
      color: #ffffff;
      font-size: 36px;
    }

    h2,
    p {
      color: #333333;
      margin: 0;
    }
  </style>
</head>

<body>
  <div class="customer-list-container">
    <h1>Kundenliste</h1>

    <table class="case-study-list-container">
      <tr>
        <th>Logo</th>
        <th>Name</th>
        <th>ID</th>
        <th>Status</th>
        <th>Bearbeiten</th>
        <th>Kunde Löschen</th>
      </tr>
      <?php
      // Verbindung zur Datenbank herstellen
      $conn = connectDatabase();

      // Kunden aus der Datenbank abrufen
      $sql = "SELECT * FROM customers";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // Kunden anzeigen
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td><img src=\"/webnetz/Images/customers/{$row['logo']}\" alt='Logo' class='customer-logo'></td>";
          echo "<td>{$row['name']}</td>";
          echo "<td>{$row['id']}</td>";
          echo "<td>{$row['status']}</td>";
          echo '<td><a href="/webnetz/Backend/customers/edit.php?id=' . $row['id'] . '" class="edit-button">Bearbeiten</a></td>';
          echo '<td><a href="/webnetz/Backend/customers/delete.php?id=' . $row['id'] . '" class="delete-button">Löschen</a></td>';
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='6'>Keine Kunden gefunden.</td></tr>";
      }

      $conn->close();
      ?>
    </table>
    <div class="back-button">
      <a href="/webnetz/Backend/customers/create.php" class="create-case-study-button">Kunde erstellen</a>
      <a href="/webnetz/Frontend/index.php">Zurück</a>
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

  <script src="../JS/script.js"></script>
</body>

</html>