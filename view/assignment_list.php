<?php include('view/header.php') ?>

<?php include('view/header.php'); ?>

<section id="list" class="list">
    <header>
        <h1>Todo Items</h1>
        <form action="." method="get" id="list_header_select" class="list__header__select">
            <input type="hidden" name="action" value="list_assignments">
            <label>Category:</label>
            <select name="course_id" required>
                <option value="0">View All</option>
                <?php foreach ($courses as $course) : ?>
                    <?php if ($course_id == $course['categoryID']) { ?>
                        <option value="<?= $course['categoryID'] ?>" selected>
                        <?php } else { ?>
                        <option value="<?= $course['categoryID'] ?>">
                        <?php } ?>
                        <?= $course['categoryName'] ?>
                        </option>
                    <?php endforeach; ?>
            </select>
            <button class="add-button bold">Go</button>
        </form>
    </header>
    <?php if ($assignments) {  ?>
        <?php foreach ($assignments as $assignment) : ?>
            <div class="list__row">
                <div class="list__item">
                    <p class="bold"><?= $assignment['Title'] ?></p>
                    <p><?= $assignment['Description'] ?></p>
                    <p><?= $assignment['categoryName'] ?></p>
                </div>
                <div class="list__removeItem">
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_assignment">
                        <input type="hidden" name="assignment_id" value="<?= $assignment['ItemNum'] ?>">
                        <button>X</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php } else {  ?>
        <br>
        <?php if ($course_id) { ?>
            <p>No items exist for this category yet.</p>
        <?php } else { ?>
            <p>No items exist yet.</p>
        <?php } ?>
        <br>
    <?php } ?>
</section>

<section id="add" class="add">
    <h2>Add items</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_assignment">
        <div class="add__inputs">
            
            <label>Title</label>
            <input type="text" name="Title" maxlength="20" placeholder="Title" required>
            
            <label>Description</label>
            <input type="text" name="description" maxlength="120" placeholder="Description">

            <label>Category:</label>
            <select name="course_id">
                <option value="">Please select</option>
                <?php foreach ($courses as $course) : ?>
                    <option value="<?= $course['categoryID'] ?>">
                        <?= $course['categoryName']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

        </div>
        <div class="add_addItem">
            <button class="add-button bold">Add</button>
        </div>
    </form>
</section>
<p><a href=".?action=list_courses">View/Edit Categories</a></p>
<?php include('view/footer.php'); ?>
