<?php 
/*
Verifiziert die E-Mail-Adresse des registrierten Benutzers. 
Der Link zu dieser Seite ist in der E-Mail-Nachricht „register.php“ enthalten
*/

require_once '../SQL/db.php';
session_start();

// Stellen Sie sicher, dass E-Mail- und Hash-Variablen nicht leer sind
if(isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['hash']) && !empty($_GET['hash']))
{
    $email = $mysqli->escape_string($_GET['email']); 
    $hash = $mysqli->escape_string($_GET['hash']); 
    
    // Wählen Sie einen Benutzer mit passender E-Mail-Adresse und Hash aus, der sein Konto noch nicht bestätigt hat (aktiv = 0).
    $result = $mysqli->query("SELECT * FROM editors WHERE email='$email' AND hash='$hash' AND active='0'");

    if ( $result->num_rows == 0 )
    { 
        $_SESSION['message'] = "Das Konto wurde bereits aktiviert oder die URL ist ungültig!";

        header("location: /webnetz/error/error.php");
    }
    else {
        $_SESSION['message'] = "Dein Konto wurde aktiviert!";
        
        // Setzen Sie den Benutzerstatus auf aktiv (aktiv = 1)
        $mysqli->query("UPDATE users SET active='1' WHERE email='$email'") or die($mysqli->error);
        $_SESSION['active'] = 1;
        
        header("location: /verify/success.php");
    }
}
else {
    $_SESSION['message'] = "Ungültige Parameter zur Kontobestätigung angegeben!";
    header("location: /webnetz/error/error.php");
}     
?>