<?php
require_once __DIR__ . '/../SQL/db.php';

// ================================ Register ================================ //

function registerUser($mysqli)
{
    // Set session variables to be used on profile.php page
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['first_name'] = $_POST['firstname'];
    $_SESSION['last_name'] = $_POST['lastname'];
    $_SESSION['password'] = $_POST['password'];

    // Escape all $_POST variables to protect against SQL injections
    $first_name = $mysqli->escape_string($_POST['firstname']);
    $last_name = $mysqli->escape_string($_POST['lastname']);
    $email = $mysqli->escape_string($_POST['email']);
    $username = $mysqli->escape_string($_POST['username']);
    $password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));

    // Check if user with that email or username already exists
    $stmt = $mysqli->prepare("SELECT * FROM editors WHERE email=? OR username=?");
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['message'] = 'Ein Benutzer existiert bereits mit dieser E-Mail-Adresse oder diesem Benutzernamen!';
        header("location: /webnetz/error/error.php");
        exit();
    }

    // Insert user into the database
    $stmt = $mysqli->prepare("INSERT INTO editors (first_name, last_name, email, username, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $username, $password);

    if ($stmt->execute()) {
        $_SESSION['active'] = ''; // 0 until user activates their account with verify.php
        $_SESSION['logged_in'] = true; // So we know the user has logged in
        $_SESSION['message'] = "Großartig! Du hast dich erfolgreich registriert und hast nun bei uns ein Konto!";
        header("location: ../../verify/sucess.php");
        exit();
    } else {
        $_SESSION['message'] = 'Registrierung fehlgeschlagen!';
        header("location: /webnetz/error/error.php");
        exit();
    }
}

// ================================ Login ================================ //

function is_login()
{
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

function sessionManager($required_login = true)
{
    session_start();

    // Überprüfen, ob der Benutzer angemeldet ist
    if (!is_login() && $required_login) {
        // Benutzer ist nicht angemeldet, umleiten zur Anmeldeseite
        $_SESSION['message'] = "Sie müssen sich anmelden, bevor Sie irgendwas bearbeiten können!";
        header("Location: /webnetz/error/error.php");
        exit();
    }
}

function login($email, $password)
{
    $conn = connectDatabase();
    // Escape email to protect against SQL injections
    $stmt = $conn->prepare("SELECT * FROM editors WHERE email=? limit 1");
    $stmt->execute([$email]);
    $result = $stmt->get_result();
    $editor = $result->fetch_assoc();

    if (!$editor) { // Redakteur existiert nicht
        $_SESSION['message'] = "Der Benutzer mit dieser E-Mail existiert nicht!";
        header("location: /webnetz/error/error.php");
        exit();
    }

    if (!password_verify($password, $editor['password'])) {
        $_SESSION['message'] = "Sie haben ein falsches Passwort eingegeben, versuchen Sie es erneut!";
        header("location: /webnetz/error/error.php");
        exit();
    }

    // Setze die Nutzerdaten in die Session
    $_SESSION['email'] = $editor['email'];
    $_SESSION['user_id'] = $editor['id'];
    $_SESSION['username'] = $editor['username'];
    $_SESSION['active'] = $editor['active']; // Setze den Wert auf einen Standardwert, falls 'active' nicht vorhanden ist

    // So wissen wir, dass der Redakteur angemeldet ist
    $_SESSION['logged_in'] = true;

    header("location: /webnetz/Backend/redakteur/profile.php");
}

// ================================ Logout ================================ //

function logout()
{
    /*Yeah! Log out process, unsets and destroys session variables */
    session_start();
    session_unset();
    session_destroy();
}

// ================================ /case_studies/create.php ================================ //

function createCaseStudy($mysqli, $image, $title, $description, $customer_id)
{
    $stmt = $mysqli->prepare("INSERT INTO case_studies (image, title, description, customer_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $image, $title, $description, $customer_id);

    return $stmt->execute();
}

function customerExists($mysqli, $customer_id)
{
    $stmt = $mysqli->prepare("SELECT id FROM customers WHERE id = ?");
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $stmt->store_result();

    return $stmt->num_rows > 0;
}

function uploadImage($image)
{
    $case_studies_directory = "/xampp/htdocs/webnetz/Images/case_studies/";
    if (!is_dir($case_studies_directory)) {
        mkdir($case_studies_directory, 0755, true);
    }

    $image_path = $case_studies_directory . $image;
    move_uploaded_file($_FILES['image']['tmp_name'], $image_path);

    return $image_path;
}

function updateCaseStudy($mysqli, $case_study_id, $title, $description, $customer_id)
{
    $stmt = $mysqli->prepare("UPDATE case_studies SET title = ?, description = ?, customer_id = ? WHERE id = ?");
    $stmt->bind_param("ssii", $title, $description, $customer_id, $case_study_id);

    return $stmt->execute();
}

