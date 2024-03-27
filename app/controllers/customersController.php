<?php
require_once '../app/core/authenticator.php';

class CustomerController
{

    public function __construct()
    {
        //first check if a mechanic is logged in
        Authenticator::checkAuthenticationAdmin();
    }

    public function renderCustommer()
    {
        //then show the view
        require '../app/views/customersView.php';
    }

}