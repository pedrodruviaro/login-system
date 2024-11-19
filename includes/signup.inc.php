<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try { 
        require_once "dbh.inc.php";
        require_once "signup_model.inc.php";
        require_once "signup_controller.inc.php";

        // Error handling
        $errors = [];

        if (is_input_empty ($username, $pwd, $email)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        if (is_email_invalid ($email)) {
            $errors["invalid_email"] = "Invalid email used!";
        }
        
        if (is_username_taken ($pdo, $username)) { // $pdo comed from require_once (dbh)
            $errors["username_taken"] = "Username already taken!";
        }

        if (is_email_registered ($pdo, $email) ) {
            $errors["email_used"] = "Email already registered!";
        }

        require_once "config_session.inc.php";

        if ($errors) {
            $_SESSION['errors_signup'] = $errors;

            $signupdata = [
                "username" => $username,
                "email" => $email
            ];

            $_SESSION["signup_data"] = $signupdata; 

            header("Location: ../index.php");
            die();
        }

        // success
        unset($_SESSION["signup_data"]);

        create_user($pdo, $username, $pwd, $email);

        header("Location: ../index.php?signup=success");

        $pdo = null;
        $stmt = null;

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}