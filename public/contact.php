<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'components/head.php';
?>

<body>
    <?php
    require 'components/nav.php';
    ?>

    <div class="container">
        <div class="col-12 card">
            <div class="text-center mb-3">
                <h2>Contact</h2>
                <p>
                    Neem contact op met DriveSmart.
                </p>
                <hr>
            </div>
            <div class="row mb-4">
                <div class="col-lg-6 col-md-12 col-sm-12"></div>
                <div class="col-lg-6 col-md-12 col-sm-12"></div>
            </div>
        </div>
    </div>

    <?php
    include 'components/footer.php';
    ?>
</body>

</html>