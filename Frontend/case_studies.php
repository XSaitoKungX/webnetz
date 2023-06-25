<?php
require_once '../SQL/db.php';
require_once '../Functions/session.php';

sessionManager(false);

$conn = connectDatabase();

// Case Studies aus der Datenbank abrufen
$sql = "SELECT case_studies.id, case_studies.image, case_studies.title, case_studies.description, customers.name AS customer_name
FROM case_studies
INNER JOIN customers ON case_studies.customer_id = customers.id";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();

?>

<!DOCTYPE html>
<html>

<head>
  <title>Case Studies</title>
  <link rel="stylesheet" type="text/css" href="../CSS/style.css">
  <link rel="stylesheet" type="text/css" href="../CSS/case_studies.css">
</head>

<body>
  <div class="case-study-list-container">
    <h1>Case Studies</h1>

    <table class="case-study-list">
      <tr>
        <th>Titel</th>
        <th>Beschreibung</th>
        <th>Kunde</th>
        <th>Bild</th>
        <th>Bearbeiten</th>
        <th>Löschen</th>
      </tr>

      <?php if ($result->num_rows > 0) : ?>
        <?php foreach ($rows as $row) : ?>
          <?php // var_dump($row); 
          ?>
          <tr>
            <td><?= $row['title'] ?></td>
            <td><?= $row['description'] ?></td>
            <td><?= $row['customer_name'] ?></td>
            <td><img src="/webnetz/Images/case_studies/<?= $row['image'] ?>" alt='Case Study' class='case-study-image'></td>
            <td><a href="/webnetz/Backend/case_studies/edit.php?id=<?= $row['id'] ?>" class="edit-button">Bearbeiten</a></td>
            <td><a href="/webnetz/Backend/case_studies/delete.php?id=<?= $row['id'] ?>" class="edit-button">Löschen</a></td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan='3'>Keine Case Studies gefunden.</td>
        </tr>
        <tr>
        </tr>
      <?php endif; ?>
    </table>

    <div class="back-button">
      <a href="/webnetz/Backend/case_studies/create.php" class="create-case-study-button">Neue Case Study erstellen</a>
      <a href="/webnetz/Frontend/index.php">Zurück zur Übersicht</a>
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