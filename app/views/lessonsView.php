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
                <div class="flex-spacebetween mb-4">
                    <h2>Lessen</h2>
                    <a href="addLesson.php" class="col-md-2 btn btn-tertiary mt-2">
                        voeg les toe
                    </a>
                </div>

                <div class="scroll-table">
                    <table id="accountsTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>leerling</th>
                                <th>datum</th>
                                <th>start tijd</th>
                                <th>eind tijd</th>
                                <th class="text-center">acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lessons as $lesson) : ?>
                                <tr>
                                    <td><?php echo $lesson['leerlingNaam']; ?></td>
                                    <td><?php echo $lesson['datum']; ?></td>
                                    <td><?php echo $lesson['beginTijd']; ?></td>
                                    <td><?php echo $lesson['eindTijd']; ?></td>
                                    <td>
                                        <div class="flex-evenly">
                                            <!-- edit button and delete button -->
                                            <a href="editLesson.php?id=<?php echo $lesson['lesId']; ?>" class="btn btn-primary">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form method="post" id="deleteLessonForm">
                                                <input type="hidden" name="action" value="deleteLesson">
                                                <input type="hidden" name="id" value="<?php echo $lesson['lesId']; ?>">
                                                <a href="" onclick="return confirm('Wil je de geplande les op: <?php echo $lesson['datum'] ?> echt verwijderen? Deze actie kan niet ongedaan worden.')">
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