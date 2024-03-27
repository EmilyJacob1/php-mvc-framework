<?php
require '../public/components/head.php';
?>

<body>

    <?php
    require '../public/components/nav.php';
    ?>

    <section class=" container text-center">

        <form method="post" class="card col-12 col-sm-8 col-md-6 col-lg-4 mx-auto" data-bs-theme="dark">
            <h1 class="login-icon mb-3"><i class="bi bi-person-fill"></i></h1>
            <h5 class="mb-4">Login to your account</h5>

            <div class="form-floating mb-4">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>

            <div class="form-floating mb-4">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <button class="btn btn-primary w-100 py-2 mb-5" type="submit">Sign in</button>

            <?php if (!empty($errors)) : ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error) : ?>
                            <li>* <?php echo $error; ?></li>
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