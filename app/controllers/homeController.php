<?php

require_once '../app/core/authenticator.php';

class HomeController
{
    public function __construct()
    {
        //first check if any user is logged in
        Authenticator::checkIsLoggedin();
    }


    public function renderHome()
    {
        //show the view
        require '../app/views/homeView.php';
    }
}
