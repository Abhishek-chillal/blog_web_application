<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $author_id = $_SESSION['user-id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    //set is_featured to 0 if unchecked
    $is_featured = $is_featured == 1 ?: 0;

    //validate form data
    if (!$title) {
        $_SESSION['add-post'] = "Enter post title";
    } elseif (!$body) {
        $_SESSION['add-post'] = "Enter post body";
    } elseif (!$category_id) {
        $_SESSION['add-post'] = "Select post category";
    } elseif (!$thumbnail['name']) {
        $_SESSION['add-post'] = "Choose post thumbnail";
    } else {
        //work on thumbnail
        //rename the image
        $time = time();
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = '../images/' . $thumbnail_name;

        //make sure file is an image
        $allowed_files = ['png', 'jpg', 'jpeg', 'JPG', 'JPEG', 'PNG'];
        $extension = explode('.', $thumbnail_name); //here we split words from .  eg: if file name is blog7.jpg then we will get array of 2 elements blog7 and jpg
        $extension = end($extension);           //take last word

        if (in_array($extension, $allowed_files)) {
            //make sure image is not too large (2mb+)
            if ($thumbnail['size'] <= 2_000_000) {
                //upload avatar
                move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
            } else {
                $_SESSION['add-post'] = "File size too big. Should be less than 2mb";
            }
        } else {
            $_SESSION['add-post'] = "File should be png, jpg or jpeg";
        }
    }

    //if anything goes wrong redirect to add post form
    if (isset($_SESSION['add-post'])) {
        //pass form data back to form
        $_SESSION['add-post-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-post.php');
        die();
    } else {

        if ($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
        }
        $insert_post_query = "INSERT INTO posts SET title='$title', body='$body', thumbnail='$thumbnail_name', category_id=$category_id, author_id=$author_id, is_featured=$is_featured";
        $insert_post_result = mysqli_query($connection, $insert_post_query);

        if (!mysqli_errno($connection)) {
            //redirect to admin with success message
            $_SESSION['add-post-success'] = "New post added successfully.";
            header('location: ' . ROOT_URL . 'admin/');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/add-post.php');
    die();
}
