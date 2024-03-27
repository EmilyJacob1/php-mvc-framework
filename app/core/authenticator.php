<?php

class Authenticator
{

    public static function checkIsLoggedin()
    {
        // start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // if any user is not logged in else redirect to login page
        if (!isset($_SESSION['accountid'])) {
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
        // if admin is not logged in, redirect to login page
        if (!isset($_SESSION['accountid']) || $_SESSION['accountrole'] !== 'admin') {
            header("Location: index.php");
            exit();
        }
    }

    public static function checkAuthenticationVisitor()
    {
        // start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // if klant is not logged in, redirect to login page
        if (!isset($_SESSION['accountid']) || $_SESSION['accountrole'] !== 'visitor') {
            header("Location: index.php");
            exit();
        }
    }

    public static function checkAuthenticationMechanic()
    {
        // start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // if klant is not logged in, redirect to login page
        if (!isset($_SESSION['accountid']) || ($_SESSION['accountrole'] !== 'monteur' && $_SESSION['accountrole'] !== 'admin')) {
            header("Location: index.php");
            exit();
        }
    }
}
