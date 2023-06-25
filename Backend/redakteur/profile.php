<?php
require_once '../../Functions/session.php';

// Überprüfen, ob der Benutzer angemeldet ist
sessionManager();

// Verbindung zur Datenbank herstellen
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "case_studies_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Benutzerinformationen abrufen
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM editors WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];
} else {
    // Benutzer nicht gefunden
    $_SESSION['message'] = "Benutzer nicht gefunden.";
    header("location: ../../error/error.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Willkommen <?php echo $first_name . ' ' . $last_name; ?></title>
    <link rel="stylesheet" type="text/css" href="../../CSS/style.css">
</head>

<body>
    <a href="https://www.web-netz.de"><img src="../../Images/logos/web-netz.png"></a>

    <div class="form">
        <h1>Willkommen</h1>
        <h2><?php echo $first_name . ' ' . $last_name; ?></h2>
        <p><?php echo $email; ?></p>
        <a href="/webnetz/Frontend/index.php"><button class="button button-block"/>Übersicht</button></a>
        <br>
        <a href="logout.php"><button class="button button-block" name="logout" />Log Out</button></a>
    </div>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="../../JS/index.js"></script>
</body>

</html>
