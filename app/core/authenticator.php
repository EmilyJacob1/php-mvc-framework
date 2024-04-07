<?php

class Authenticator
{

    public static function checkIsLoggedin()
    {
        // if any user is not logged in else redirect to login page
        if (!isset($_SESSION['accountId'])) {
            header("Location: index.php");
            exit();
        }
    }

    public static function checkAuthenticationAdmin()
    {
        // if a admin is not logged in, redirect to login page
        if (!isset($_SESSION['accountId']) || $_SESSION['accountRole'] !== 'admin') {
            header("Location: index.php");
            exit();
        }
    }

    public static function checkAuthenticationInstructor()
    {
        // if a instructor is not logged in, redirect to login page
        if (!isset($_SESSION['accountId']) || $_SESSION['accountRole'] !== 'instructeur') {
            header("Location: index.php");
            exit();
        }
    }

    public static function checkForStudent()
    {
        // if a student is not logged in, redirect to login page
        // if (!isset($_SESSION['accountId']) || ($_SESSION['accountRole'] !== 'leerling' && $_SESSION['accountRole'] !== 'leerling')) {
            if (!isset($_SESSION['accountId']) || $_SESSION['accountRole'] !== 'leerling') {
            header("Location: index.php");
            exit();
        }
    }
}
