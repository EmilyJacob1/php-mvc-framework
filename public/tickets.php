<?php
require '../app/controllers/ticketsController.php';

$ticketsController = new TicketsController();
$ticketsController->renderTickets();



