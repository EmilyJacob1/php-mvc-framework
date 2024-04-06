<?php

require_once '../app/core/authenticator.php';

class HomeController
{
    public function __construct()
    {
        // start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        //check if any user is logged in
        Authenticator::checkIsLoggedin();
    }


    public function renderHome()
    {
        //show the view
        require '../app/views/homeView.php';
    }
}
