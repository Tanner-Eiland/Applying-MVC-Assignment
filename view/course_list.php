<?php include("view/header.php") ?>
<?php if ($courses) { ?>
    <section id="list" class="list">
        <header>
            <h1>Category List</h1>
        </header>
        <?php foreach ($courses as $course) : ?>
            <div class="list__row">
                <div class="list__item">
                    <p class="bold"><?= $course['categoryName'] ?></p>
                </div>
                <div class="list__removed">
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_course">
                        <input type="hidden" name="course_id" value="<?= $course['categoryID'] ?>">
                        <button class="remove-button">X</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
<?php } else { ?>
    <p>No Categories exist yet</p>
<?php } ?>
<section>
    <h2>Add Categories</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_course">
        <div class="add__inputs">
            <label>Name:</label>
            <input type="text" name="course_name" maxlength="30" placeholder="Name" autofocus required>
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Add</button>
        </div>
    </form>
</section>
<p><a href=".?action=list_assignments">View/Edit Items</a></p>
<?php include("view/footer.php") ?>