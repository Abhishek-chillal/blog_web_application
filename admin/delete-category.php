<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //For Later
    //update the category id of posts that belong to uncategorized category





    //delete category from database
    $delete_category_query = "DELETE FROM categories WHERE id = $id LIMIT 1";
    $delete_category_result = mysqli_query($connection, $delete_category_query);
    $_SESSION['delete-category-success'] = "Category deleted successfully";
}

header('location: ' . ROOT_URL . 'admin/manage-categories.php');
die();
