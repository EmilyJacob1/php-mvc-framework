<?php
require_once '../app/core/authenticator.php';

class TicketsController
{

    public function __construct()
    {
        //first check if a mechanic is logged in
        Authenticator::checkAuthenticationMechanic();
    }

    public function renderTickets()
    {
        //then show the view
        require '../app/views/ticketsView.php';
    }

}
