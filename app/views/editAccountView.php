<?php
require '../public/components/head.php';
?>

<body>
    <?php
    require '../public/components/nav.php';
    ?>

    <section class="edit-movie">

        <div class="container col-12 col-sm-8 col-md-6 col-lg-4 mx-auto" data-bs-theme="dark">
            <div class="text-end mb-3">
                <a class="return-link" href="accounts.php">
                    <i class="bi bi-arrow-left"></i> terug naar het overzicht
                </a>
            </div>
            <div class="card">
                <div class="row mt-1 mb-3">
                    <h2>Bewerk gebruiker</h2>
                </div>

                <form method="post" id="editAccountForm">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value="<?php echo isset($formData['id']) ? $formData['id'] : $account['accountId']; ?>">
                    <div class="mb-3">
                        <label for="username" class="form-label">gebruikersnaam</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($formData['username']) ? $formData['username'] : $account['username']; ?>" required />
                    </div>
                    <div class="mb-3">
                        <label for="accountRole" class="form-label">account rol</label>
                        <select class="form-select" id="accountRole" name="accountRole" required>
                            <?php
                            $roles = ['admin', 'verkoopmedewerker', 'monteur', 'klant'];
                            foreach ($roles as $role) {
                                $selected = isset($formData['accountRole']) && $formData['accountRole'] === $role ? 'selected' : ($account['accountRole'] === $accountRole ? 'selected' : '');
                                echo "<option value=\"$role\" $selected>$role</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="accountEmail" class="form-label">email adres</label>
                        <input type="email" class="form-control" id="accountEmail" name="accountEmail" value="<?php echo isset($formData['accountEmail']) ? $formData['accountEmail'] : $account['accountEmail']; ?>" required />
                    </div>
                    <div class="mb-3">
                        <label for="accountPassword" class="form-label">wachtwoord</label><br>
                        <input type="password" class="form-control" id="accountPassword" name="accountPassword" value="<?php echo isset($formData['accountPassword']) ? $formData['accountPassword'] : $account['accountPassword']; ?>" required />
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
                        <button type="submit" class="btn btn-primary">Opslaan</button>
                    </div>
                </form>
            </div>
    </section>


</body>

</html>