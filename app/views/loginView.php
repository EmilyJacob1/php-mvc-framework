<?php
require '../public/components/head.php';
?>

<body>

    <?php
    require '../public/components/nav.php';
    ?>

    <section class="container text-center">

        <form method="post" class="card col-12 col-sm-8 col-md-6 col-lg-4 mx-auto">
            <h1 class="login-icon"><i class="bi bi-person"></i></h1>
            <h5 class="mb-4">Log in op je account</h5>
            <hr>
            <div class="form-floating mb-4">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="email adres">
                <label for="floatingInput">Email adres</label>
            </div>
            <div class="form-floating mb-2">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="wachtwoord">
                <label for="floatingPassword">Wachtwoord</label>
            </div>
            <hr>
            <button class="btn btn-primary w-100 py-2 mb-2" type="submit">Log in</button>
            <!--display the errors if there are any--->
            <?php if (!empty($errors)) : ?>
                <div class="alert alert-danger mt-3">
                    <ul>
                        <?php foreach ($errors as $error) : ?>
                            <li> <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </form>
    </section>


    <?php
    require '../public/components/footer.php';
    ?>

</body>

</html>