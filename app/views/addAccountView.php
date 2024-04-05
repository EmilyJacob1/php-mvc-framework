<?php
require '../public/components/head.php';
?>

<body>
    <?php
    require '../public/components/nav.php';
    ?>

    <section class="add-user">

        <div class="container col-12 col-sm-8 col-md-6 col-lg-4 mx-auto">
            <div class="text-end mb-3">
                <a class="return-link" href="accounts.php">
                    <i class="bi bi-arrow-left"></i> terug naar het overzicht
                </a>
            </div>
            <div class="card">
                <div class="row mt-1 mb-3">
                    <h2>gebruiker toevoegen</h2>
                </div>

                <form method="post">
                    <input type="hidden" name="action" value="add">
                    <div class="mb-3">
                        <label for="username" class="form-label">gebruikersnaam</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($formData['username']) ? $formData['username'] : ''; ?>" required />
                    </div>
                    <div class="mb-3">
                        <label for="accountRole" class="form-label">account rol</label>
                        <select class="form-select" id="accountRole" name="accountRole" required>
                            <option value="admin" <?php echo isset($formData['accountRole']) && $formData['accountRole'] === 'admin' ? 'selected' : ''; ?>>admin</option>
                            <option value="leerling" <?php echo isset($formData['accountRole']) && $formData['accountRole'] === 'leerling' ? 'selected' : ''; ?>>leerling</option>
                            <option value="instructeur" <?php echo isset($formData['accountRole']) && $formData['accountRole'] === 'instructeur' ? 'selected' : ''; ?>>instructeur</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="accountEmail" class="form-label">email adres</label>
                        <input type="email" class="form-control" id="accountEmail" name="accountEmail" value="<?php echo isset($formData['accountEmail']) ? $formData['accountEmail'] : ''; ?>" required />
                    </div>
                    <div class="mb-3">
                        <label for="accountPassword" class="form-label">wachtwoord</label><br>
                        <input type="password" class="form-control" id="accountPassword" name="accountPassword" required />
                    </div>

                    <?php if (!empty($errors)) : ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errors as $error) : ?>
                                    <li>* <?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="mt-5">
                        <button type="submit" class="btn btn-tertiary">Opslaan</button>
                    </div>
                </form>
            </div>

    </section>

</body>

</html>