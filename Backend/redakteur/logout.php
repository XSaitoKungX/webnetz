<?php
require_once '../../Functions/session.php';
logout();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Logout</title>
    <link rel="stylesheet" type="text/css" href="../../CSS/style.css">
</head>

<body>
    <!--Yeah! Site-Logo oben anzeigen-->
    <a href="https://www.web-netz.de"><img src="../../Images/logos/web-netz.png"></a>
    <div class="form">
        <h1>Vielen Dank für Ihren Besuch auf unserer Website</h1>
        <h5 style="color: white"><?= 'Lass eine' . '<a href="https://www.web-netz.de/kontakt/">' . ' Rückmeldung da' . '</a>' . ' damit wir Sie viel besser bedienen können' ?></h5>
        <p><?= 'Sie wurden erfolgreich ausgeloggt!'; ?></p>

        <!--Yeah! We navigate back to Home page of the site-->
        <a href="index.php"><button class="button button-block" />Home</button></a>

    </div>
</body>

</html>