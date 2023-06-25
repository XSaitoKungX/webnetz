<?php
/*
Ja! Das Formular zum Zurücksetzen des Passworts, 
der Link zu dieser Seite ist in der E-Mail-Nachricht 'forgot.php' enthalten
*/

require_once '../../../SQL/db.php';
session_start();

// Stellen Sie sicher, dass E-Mail- und Hash-Variablen nicht leer sind
if (isset($_GET['email']) && !empty($_GET['email']) and isset($_GET['hash']) && !empty($_GET['hash'])) {
    $email = $mysqli->escape_string($_GET['email']);
    $hash = $mysqli->escape_string($_GET['hash']);

    // Stellen Sie sicher, dass eine Benutzer-E-Mail mit passendem Hash vorhanden ist
    $result = $mysqli->query("SELECT * FROM editors WHERE email='$email' AND hash='$hash'");

    if ($result->num_rows == 0) {
        $_SESSION['message'] = "Sie haben eine ungültige URL zum Zurücksetzen des Passworts eingegeben!";
        header("location: ../../../error/error.php");
    }
} else {
    $_SESSION['message'] = "Entschuldigung, die Verifizierung ist fehlgeschlagen. Versuchen Sie es erneut!";
    header("location: ../../../error/error.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Setze Ihr Passwort zurück</title>
    <?php include '../../CSS/css.html'; ?>
</head>

<body>

    <!-- Site-Logo oben anzeigen -->
    <a href="https://www.web-netz.de"><img src="../../Images/logos/web-netz.png"></a>

    <div class="form">

        <h1>Gebe Ihr neues Passwort ein</h1>

        <form action="reset_password.php" method="post">

            <div class="field-wrap">
                <label>
                    Neues Passwort<span class="req">*</span>
                </label>
                <input type="password" required name="newpassword" autocomplete="off" />
            </div>

            <div class="field-wrap">
                <label>
                    Wiederholen<span class="req">*</span>
                </label>
                <input type="password" required name="confirmpassword" autocomplete="off" />
            </div>

            <!-- Dieses Eingabefeld wird benötigt, um die E-Mail des Benutzers zu erhalten -->
            <input type="hidden" name="email" value="<?= $email ?>">
            <input type="hidden" name="hash" value="<?= $hash ?>">

            <button class="button button-block" />Zurücksetzen</button>

        </form>

    </div>
    <!--Load Cloudflare jquery.min.js online-->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <!--Load index.js from the resource folder-->
    <script src="../../JS/index.js"></script>

</body>

</html>