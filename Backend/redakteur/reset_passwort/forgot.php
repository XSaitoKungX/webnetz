<?php
/* Reset your password form, sends reset.php password link */
require_once '../../../SQL/db.php';
session_start();

// Check if form submitted with method="post"
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $mysqli->escape_string($_POST['email']);
    $result = $mysqli->query("SELECT * FROM editors WHERE email='$email'");

    if ($result->num_rows == 0) // User doesn't exist
    {
        $_SESSION['message'] = "Der Benutzer mit dieser E-Mail existiert nicht!";
        header("location: ../../../error/error.php");
    } else { // User exists (num_rows != 0)

        $user = $result->fetch_assoc(); // $user becomes array with user data

        $email = $user['email'];
        $hash = $user['hash'];
        $first_name = $user['first_name'];

        // Session message to display on success.php
        $_SESSION['message'] = "<p>Bitte überprüfen Sie Ihre E-Mail <span>$email</span>"
            . " für einen Bestätigungslink zum Abschließen des Zurücksetzens Ihres Passworts!</p>";

        // Send registration confirmation link (reset.php)
        $to      = $email;
        $subject = 'Link zum Zurücksetzen des Passworts';
        $message_body = '
        Hallo ' . $first_name . ',

        Sie haben das Zurücksetzen des Passworts angefordert!

        Bitte klicken Sie auf diesen Link, um Ihr Passwort zurückzusetzen:

        http://localhost/Backend/redakteur/reset_passworr/reset.php?email=' . $email . '&hash=' . $hash;

        mail($to, $subject, $message_body);

        header("location: ../../../verify/success.php");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Setze Ihr Passwort zurück</title>
    <?php include '../../../CSS/css.html'; ?>
</head>

<body>
    <!--Site-Logo oben anzeigen-->
    <a href="https://www.web-netz.de"><img src="../../../Images/logos/web-netz.png"></a>

    <div class="form">
        <h1>Ihr Passwort zutücksetzen</h1>

        <form action="forgot.php" method="post">
            <div class="field-wrap">
                <label>
                    Email Address<span class="req">*</span>
                </label>
                <input type="email" required autocomplete="off" name="email" />
            </div>
            <button class="button button-block" />Reset</button>
        </form>
    </div>

    <!--Load Cloudflare jquery.min.js online-->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <!--Load index.js from the resource folder-->
    <script src="../../../JS/index.js"></script>
</body>

</html>