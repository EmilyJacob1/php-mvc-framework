<nav class="navbar navbar-expand-lg  bg-body px-4 py-2 mb-5">
    <div class="container-fluid">
        <a class="navbar-brand text-blue text-bold">DriveSmart</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample04">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <!--check if logged in and -->
                <?php if (isset($_SESSION['accountId'])) : ?>
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <?php switch ($_SESSION['accountRole']):
                        case 'leerling': ?>
                            <li class="nav-item"><a class="nav-link" href="lessons.php">lessen</a></li>
                            <li class="nav-item"><a class="nav-link" href="account.php">account</a></li>
                            <?php break; ?>
                        <?php
                        case 'instructeur': ?>
                            <li class="nav-item"><a class="nav-link" href="lessons.php">lessen</a></li>
                            <li class="nav-item"><a class="nav-link" href="account.php">account</a></li>
                            <?php break; ?>
                        <?php
                        case 'admin': ?>
                            <li class="nav-item"><a class="nav-link" href="autos.php">auto's</a></li>
                            <li class="nav-item"><a class="nav-link" href="strippenkaarten.php">strippenkaarten</a></li>
                            <li class="nav-item"><a class="nav-link" href="accounts.php">gebruikers</a></li>
                            <?php break; ?>
                    <?php endswitch; ?>
                <?php endif; ?>
                <!--contact is always accesible-->
                <li class="nav-item"><a class="nav-link" href="contact.php">contact</a></li>

            </ul>

            <?php
            if (isset($_SESSION['accountId'])) {
                // user is logged in
                echo '<a>welkom ,  ' . $_SESSION['username'] . '</a>';
                echo '<a href="logout.php" class="btn btn-outline-primary ms-4 me-3">log uit</a>';
            } else {
                // user is not logged in
                echo '<a href="index.php" class="btn btn-outline-primary ms-4 me-3">login</a>';
            }
            ?>
        </div>
    </div>
</nav>