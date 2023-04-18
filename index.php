<?php
require('model/database.php');
require('model/assignment_db.php');
require('model/course_db.php');

//so I've taken the week 6 class assignment and configured it accordingly
//apparently i struggle to rename variables so I'm leaving many of them the same
//with the addition of Title being the item name

$assignment_id = filter_input(INPUT_POST, 'assignment_id', FILTER_VALIDATE_INT); //item id
if (!$assignment_id) {
    $assignment_id = filter_input(INPUT_GET, 'assignment_id', FILTER_VALIDATE_INT);
}
$description = filter_input(INPUT_POST, 'description', FILTER_UNSAFE_RAW);
$course_name = filter_input(INPUT_POST, 'course_name', FILTER_UNSAFE_RAW);  // category name
$Title = filter_input(INPUT_POST, 'Title', FILTER_UNSAFE_RAW);              // item name

$course_id = filter_input(INPUT_POST, 'course_id', FILTER_VALIDATE_INT);    // category id
if (!$course_id) {
    $course_id = filter_input(INPUT_GET, 'course_id', FILTER_VALIDATE_INT);
}


$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
if (!$action) {
    $action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW);
    if (!$action) {
        $action = 'list_assignments';
    }
}

switch ($action) {
    case "list_courses":
        $courses = get_courses();
        include('view/course_list.php');
        break;
    case "add_course":
        add_course($course_name);
        header("Location: .?action=list_courses");
        break;
    case "add_assignment":
        if ($Title) {
            add_assignment($Title, $course_id, $description);
            header("Location: .?action=$course_id");
        } else {
            $error = "Invalid item data . A Title is required, check all fields and try again";
            include("view/error.php");
            exit();
        }
    case "delete_course":
        if ($course_id) {
            try {
                delete_course($course_id);
            } catch (PDOException $e) {
                $error = "You cannot delete a category if items exists in the category";
                include('view/error.php');
                exit();
            }
            header("Location: .?action=list_courses");
        }
        break;
    case "delete_assignment":
        if ($assignment_id) {
            delete_assignment($assignment_id);
            header("Location: .?action=null");
        } else {
            $error = "Missing or incorrect item number.";
            include('view/error.php');
        }

    default:
        $course_name = get_course_name($course_id);
        $courses = get_courses();
        $assignments =  get_assignments_by_course($course_id);
        include('view/assignment_list.php');
}