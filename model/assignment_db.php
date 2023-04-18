<?php
function get_assignments_by_course($course_id)
{
    global $db;
    if ($course_id) {
        $query = 'SELECT A.ItemNum, A.Description, C.categoryName, A.Title From todoitems A
            LEFT JOIN categories C ON A.categoryID = C.categoryID
                WHERE A.categoryID = :courseID ORDER BY A.categoryID';
    } else {
        $query = 'SELECT A.ItemNum, A.Description, C.categoryName, A.Title From todoitems A
        LEFT JOIN categories C ON A.categoryID = C.categoryID ORDER BY C.categoryID';
    }
    $statement = $db->prepare($query);
    if ($course_id) {
        $statement->bindValue(':courseID', $course_id);
    }
    $statement->execute();
    $assignments = $statement->fetchAll();
    $statement->closeCursor();
    return $assignments;
}

function delete_assignment($assignment_id)
{
    global $db;
    $query = 'DELETE FROM todoitems WHERE ItemNum = :assignment_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':assignment_id', $assignment_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_assignment($Title, $course_id, $description)
{
    global $db;
    $query = 'INSERT INTO todoitems ( Title, categoryID, Description ) VALUES ( :Title, :course_id, :description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':Title', $Title);
    $statement->bindValue(':course_id', $course_id);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();
}







?>