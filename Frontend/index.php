<?php
require_once '../Functions/session.php';

sessionManager(false);

?>

<!DOCTYPE html>
<html>

<head>
  <title>Startseite</title>
  <link rel="stylesheet" type="text/css" href="../CSS/style.css">
  <link rel="stylesheet" type="text/css" href="../CSS/case_studies.css">
  <style>
    body {
      background-image: url("/webnetz/Images/logos/webnetz_Background.jpg");
      background-repeat: no-repeat;
      background-size: cover;
    }

    h1 {
      color: #ff0000;
      /* Hier kannst du die gewünschte Farbe angeben */
    }

    .logo-container {
      position: absolute;
      top: 10px;
      left: 10px;
    }
  </style>
</head>

<body>
  <div class="logo-container">
    <a href="https://www.web-netz.de"><img src="/webnetz/Images/logos/web-netz.png"></a> <!--Site Logo-->
  </div>
  <div id="container">
    <div class="user-dropdown">
      <?php if (is_login()) : ?>
        <span>Status: <?php echo $_SESSION['active'] == 0 ? "Online" : "Offline"; ?></span>
        <br>
        <span>Angemeldet als: <?php echo $_SESSION['username']; ?></span>
        <br>
        <form method="POST" action="../Backend/redakteur/logout.php">
          <input type="submit" class="button button-block" name="logout" value="Abmelden">
        </form>
      <?php else : ?>
        <span>Status: Offline</span>
        <br>
        <span>Angemeldet als: Gast</span>
        <br>
        <form method="POST" action="../Backend/redakteur/index.php">
          <input type="submit" class="button button-block" name="logout" value="Anmelden">
        </form>
      <?php endif; ?>
    </div>

    <h1>Übersicht</h1>

    <div id="centered-links">
      <div class="centered-link">
        <h2>Kunden</h2>
        <a href="customers.php" class="edit-button">Zu den Kunden</a>
      </div>

      <div class="centered-link">
        <h2>Case Studies</h2>
        <a href="case_studies.php" class="edit-button">Zu den Case Studies</a>
      </div>
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