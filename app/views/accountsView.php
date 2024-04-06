<?php
require '../public/components/head.php';
?>

<body>
    <?php
    require '../public/components/nav.php';
    ?>

    <section class="accounts">

        <div class="container">
            <div class="col-12 card">
                <div class="flex-spacebetween mb-3">
                    <h2>Gebruikers</h2>
                    <a href="addAccount.php" class="col-md-2 btn btn-tertiary mt-2">
                        voeg gebruiker toe
                    </a>
                </div>

                <div class="scroll-table">
                    <table id="accountsTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>gebruikersnaam</th>
                                <th>email</th>
                                <th>gebruikers rol</th>
                                <th class="text-center">acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($accounts as $account) : ?>
                                <tr>
                                    <td><?php echo $account['username']; ?></td>
                                    <td><?php echo $account['accountEmail']; ?></td>
                                    <td><?php echo $account['accountRole']; ?></td>
                                    <td>
                                        <div class="flex-evenly">
                                            <!-- edit button and delete button -->
                                            <a href="editAccount.php?id=<?php echo $account['accountId']; ?>" class="btn btn-primary">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form method="post" id="deleteAccountForm">
                                                <input type="hidden" name="action" value="deleteaccount">
                                                <input type="hidden" name="id" value="<?php echo $account['accountId']; ?>">
                                                <a href="" onclick="return confirm('Wil je de gebruiker: <?php echo $account['username'] ?> echt verwijderen? Deze actie kan niet ongedaan worden.')">
                                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                </a>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>

</body>

</html>