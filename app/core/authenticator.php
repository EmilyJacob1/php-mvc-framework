<?php

class Authenticator
{

    public static function checkIsLoggedin()
    {
        // start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // // if any user is not logged in else redirect to login page
        if (!isset($_SESSION['accountId'])) {
            header("Location: index.php");
            exit();
        }
    }

    public static function checkAuthenticationAdmin()
    {
        // start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // // if a admin is not logged in, redirect to login page
        if (!isset($_SESSION['accountId']) || $_SESSION['accountRole'] !== 'admin') {
            header("Location: index.php");
            exit();
        }
    }

    public static function checkAuthenticationInstructor()
    {
        // start session if not already started
        // if (session_status() == PHP_SESSION_NONE) {
        //     session_start();
        // }

        // // if a instructor is not logged in, redirect to login page
        if (!isset($_SESSION['accountId']) || $_SESSION['accountRole'] !== 'instructeur') {
            header("Location: index.php");
            exit();
        }
    }

    public static function checkAuthenticationStudent()
    {
        // start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // // if a student is not logged in, redirect to login page
        // if (!isset($_SESSION['accountId']) || ($_SESSION['accountRole'] !== 'leerling' && $_SESSION['accountRole'] !== 'leerling')) {
            if (!isset($_SESSION['accountId']) || $_SESSION['accountRole'] !== 'leerling') {
            header("Location: index.php");
            exit();
        }
    }
}
