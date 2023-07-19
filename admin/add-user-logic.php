<?php
session_start();
require 'config/database.php';

//get signup form data if submit button was clicked
if (isset($_POST['submit'])) {
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];        //files superglobal variable

    //var_dump($avatar); //gives all information about field like its type, full path,temp_name,size,error(array) and more


    //validate input values
    if (!$firstname) {
        $_SESSION['add-user'] = "Please enter your first name";
    } elseif (!$lastname) {
        $_SESSION['add-user'] = "Please enter your last name";
    } elseif (!$username) {
        $_SESSION['add-user'] = "Please enter your username";
    } elseif (!$email) {
        $_SESSION['add-user'] = "Please enter your valid email";
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['add-user'] = "Password should be 8+ characters";
    } elseif (!$avatar['name'])                       //if name of the avatar is not their
    {
        $_SESSION['add-user'] = "Please add avatar";
    } else {
        //check if passwords do not match
        if ($createpassword !== $confirmpassword) {
            $_SESSION['add-user'] = "Passwords do not match";
        } else {
            //hash password
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);


            //check if username or email already exist in database
            $user_check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);

            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['add-user'] = "Username or Email already exist";
            } else {
                //work on avatar
                //rename avatar
                $time = time();
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = '../images/' . $avatar_name;

                //make sure file is an image
                $allowed_files = ['png', 'jpg', 'jpeg', 'JPG', 'JPEG', 'PNG'];
                $extension = explode('.', $avatar_name); //here we split words from .  eg: if file name is blog7.jpg then we will get array of 2 elements blog7 and jpg
                $extension = end($extension);           //take last word

                if (in_array($extension, $allowed_files)) {
                    //make sure image is not too large (1mb+)
                    if ($avatar['size'] < 1000000) {
                        //upload avatar
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    } else {
                        $_SESSION['add-user'] = "File size too big. Should be less than 1mb";
                    }
                } else {
                    $_SESSION['add-user'] = "File should be png, jpg or jpeg";
                }
            }
        }
    }

    //if anything goes wrong redirect to signup page
    if (isset($_SESSION['add-user'])) {
        //pass form data back to sign up page
        $_SESSION['add-user-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-user.php');
        die();
    } else {

        $insert_user_query = "INSERT INTO users SET firstname='$firstname', lastname='$lastname', username='$username', email='$email', password='$hashed_password', avatar='$avatar_name',is_admin=$is_admin";
        $insert_user_result = mysqli_query($connection, $insert_user_query);

        if (!mysqli_errno($connection)) {
            //redirect to login with success message
            $_SESSION['add-user-success'] = "New user $firstname $lastname added successfully.";
            header('location: ' . ROOT_URL . 'admin/manage-users.php');
            die();
        }
    }
} else {
    //if singup button was not clicked then bounce back to signup
    header('location:' . ROOT_URL . 'admin/add-user.php');
    die();
}
