<?php
require '../public/components/head.php';
?>

<body>
    <?php
    require '../public/components/nav.php';
    ?>

    <section class="add-lesson">

        <div class="container col-12 col-sm-8 col-md-6 col-lg-4 mx-auto">
            <div class="text-end mb-3">
                <a class="return-link" href="accounts.php">
                    <i class="bi bi-arrow-left"></i> terug naar het overzicht
                </a>
            </div>
            <div class="card">
                <div class="row mt-1 mb-3">
                    <h2>les toevoegen</h2>
                </div>

                <form method="post">
                    <div class="mb-3">
                        <label for="instructeurId" class="form-label">Instructeur</label>
                        <select class="form-select" id="instructeurId" name="instructeurId" required>
                            <?php foreach ($instructeurs as $instructeur) : ?>
                                <option value="<?php echo $instructeur['instructeurId']; ?>"><?php echo $instructeur['instructeurId']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="lessonDate" class="form-label">Datum</label>
                        <input type="date" class="form-control" id="lessonDate" name="lessonDate" value="<?php echo isset($formData['lessonDate']) ? $formData['lessonDate'] : ''; ?>"  />
                    </div>
                    <div class="mb-3">
                        <label for="startTime" class="form-label">Starttijd</label>
                        <input type="time" class="form-control" id="startTime" name="startTime" value="<?php echo isset($formData['startTime']) ? $formData['startTime'] : ''; ?>" required />
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