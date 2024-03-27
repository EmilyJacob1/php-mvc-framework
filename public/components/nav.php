<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark px-4 py-2 mb-5" aria-label="Fourth navbar example">
    <div class="container-fluid">
        <a class="navbar-brand">FIRE ARCADE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample04">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">

            <?php if (isset($_SESSION['userId'])): ?>
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <?php switch ($_SESSION['role']):
                        case 'monteur': ?>
                            <li class="nav-item"><a class="nav-link" href="tickets.php">Ticket Overzicht</a></li>
                            <?php break; ?>
                        <?php case 'verkoopmedewerker': ?>
                            <li class="nav-item"><a class="nav-link" href="bestellingtickets.php">Bestelling Tickets</a></li>
                            <li class="nav-item"><a class="nav-link" href="customers.php">Klanten</a></li>
                            <?php break; ?>
                        <?php case 'klant': ?>
                            <li class="nav-item"><a class="nav-link" href="storing.php">Storing Tickets</a></li>
                            <?php break; ?>
                        <?php case 'admin': ?>
                            <li class="nav-item"><a class="nav-link" href="accounts.php">Gebruikers</a></li>
                            <li class="nav-item"><a class="nav-link" href="customers.php">Klanten</a></li>
                            <li class="nav-item"><a class="nav-link" href="bestellingtickets.php">Bestelling Tickets</a></li>
                            <li class="nav-item"><a class="nav-link" href="tickets.php">Ticket Overzicht</a></li>
                            <?php break; ?>
                    <?php endswitch; ?>
                <?php endif; ?>
            </ul>

            <?php
            if (isset($_SESSION['userId'])) {
                // user is logged in
                echo '<a>welkom ,  ' . $_SESSION['username'] . '</a>';
                echo '<a href="logout.php" class="btn btn-outline-light ms-4 me-3">log uit</a>';
            } else {
                // user is not logged in
                echo '<a href="index.php" class="btn btn-outline-light ms-4 me-3">login</a>';
            }
            ?>
        </div>
    </div>
</nav>