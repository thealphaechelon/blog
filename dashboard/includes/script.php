<?php
require 'config.php';
session_start();
$firstname = $lastname = $email = $password = $c_password = $msg = "";
$err_firstname = $err_lastname = $err_email = $err_password = $err_cpassword = "";

function testInput($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Registration Script
if (isset($_POST['register'])) {
    $firstname = testInput($_POST['firstname']);
    //validate Firstname Value
    if (empty($firstname)) {
        $err_firstname = "Required";
    }elseif (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
        $err_firstname = "Invalid firstname value";
    }elseif (strlen($firstname) < 3) {
        $err_firstname = "Invalid firstname value";
    }else{
        $err_firstname = "";
        $firstname = mysqli_real_escape_string($connect, $firstname);
    }

    $lastname = testInput($_POST['lastname']);
    //validate Lastname Value
    if (empty($lastname)) {
        $err_lastname = "Required";
    }elseif (!preg_match("/^[a-zA-Z]*$/", $lastname)) {
        $err_lastname = "Invalid lastname value";
    }elseif (strlen($lastname) < 3) {
        $err_lastname = "Invalid lastname value";
    }else{
        $err_lastname = "";
        $lastname = mysqli_real_escape_string($connect, $lastname);
    }

    $email = testInput($_POST['email']);
    //validate Email Value
    if (empty($email)) {
        $err_email = "Required";
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err_email = "Invalid lastname value";
    }else{
        
        $email = mysqli_real_escape_string($connect, $email);
        $stmt = "SELECT email FROM admin WHERE email = '$email'";
        $query = mysqli_query($connect, $stmt);
        $numrow = mysqli_num_rows($query);
        if ($numrow > 0) {
            $err_email = "Email already exist";
        }else{
            $err_email = "";
        }
    }

    $password = testInput($_POST['password']);
    //validate Password Value
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    if (empty($password)) {
        $err_password = "Required";
    }elseif (strlen($password) < 8) {
        $err_password = "Password must be atleast 8 characters";
    }elseif(!$uppercase || !$lowercase || !$number || !$specialChars){
        $err_password = "Password must contain atleast: 1 uppercase, 1 Lowercase, 1 number and 1 symbol";
    }else{
        $err_password = "";
        $password = mysqli_real_escape_string($connect, $password);
    }
    
    $c_password = testInput($_POST['c_password']);
    //validate Confirm Password Value
    if (empty($c_password)) {
        $err_cpassword = "Required";
    }elseif ($c_password !== $password) {
        $err_cpassword = "Password does not match";
    }else{
        $err_cpassword = "";
    }

    $error = $err_firstname . $err_lastname . $err_email . $err_password . $err_cpassword;
    if (empty($error)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = "INSERT INTO admin (firstname, lastname, email, password)
        VALUES ('$firstname', '$lastname', '$email', '$password')";
        $query = mysqli_query($connect, $stmt);
        if($query){
            $_SESSION['msg'] = "<div class='alert alert-success'>Registration Successfull</div>";
            header('location:login.php');
        
        }else{
            $msg = "<div class='alert alert-danger'>Registration Failed. Something went wrong</div>";
        }
    }

}

if (isset($_POST['login'])) {
    $email = testInput($_POST['email']);
    $password = testInput($_POST['password']);

    if (empty($email) || empty($password)) {
        $msg = "<div class='alert alert-danger'>Email And Password Is Required</div>";
    }else{
        $email = mysqli_real_escape_string($connect, $email);
        $password = mysqli_real_escape_string($connect, $password);
        $stmt = "SELECT * FROM admin WHERE email = '$email'";
        $query = mysqli_query($connect, $stmt);
        $numrow = mysqli_num_rows($query);
        if ($numrow == 1) {
            $admin = mysqli_fetch_assoc($query);
            if (password_verify($password, $admin['password'])) {
                $_SESSION['admin'] = $admin['id'];
                header('location: index.php');
            }else{
                $msg = "<div class='alert alert-danger'>Incorrect Email Or Password</div>";
            }
        }else{
            $msg = "<div class='alert alert-danger'>Incorrect Email Or Password</div>";
        }
    }
}

$post_title = $post_subtitle = $post_image = $post_category = $post_details = "";
$errpost_title = $errpost_subtitle = $errpost_image = $errpost_category = $errpost_details = "";

if (isset($_POST['add_post'])) {
    $post_title = testInput($_POST['post_title']);
    if (empty($post_title)) {
        $errpost_title = "Required";
    }elseif (!preg_match("/^[a-zA-Z0-9,.? ]*$/", $post_title)) {
        $errpost_title = "Invalid firstname value";
    }elseif (str_word_count($post_title) < 3) {
        $errpost_title = "Invalid firstname value";
    }else{
        $errpost_title = "";
        $post_title = mysqli_real_escape_string($connect, $post_title);
    }

    $post_subtitle = testInput($_POST['post_subtitle']);
    if (empty($post_subtitle)) {
        $errpost_subtitle = "Required";
    }elseif (!preg_match("/^[a-zA-Z0-9,.? ]*$/", $post_subtitle)) {
        $errpost_subtitle = "Invalid firstname value";
    }elseif (str_word_count($post_subtitle) < 3) {
        $errpost_subtitle = "Invalid firstname value";
    }else{
        $errpost_subtitle = "";
        $post_subtitle = mysqli_real_escape_string($connect, $post_subtitle);
    }

    $post_image = $_FILES['post_image']['name'];
    $post_tmpimage = $_FILES['post_image']['tmp_name'];
    $ext = strtolower(pathinfo($post_image, PATHINFO_EXTENSION));
    if (empty($post_image)) {
        $errpost_image = "Required";
    }elseif ($ext != "jpg" && $ext != "png" && $ext != "jpeg") {
        $errpost_image = "Invalid File";
    }elseif ($_FILES['post_image']['size'] > 5000000) {
        $errpost_image = "File Is Too Large (Max: 5mb)";
    }else{
        $errpost_image = "";
        $image_name = rand(0000, 9999).".".$ext;
        $target_file = "uploads/".$image_name;
    }


    $post_category = testInput($_POST['category']);

    $post_details = $_POST['post_details'];
    if (empty($post_details)) {
        $errpost_details = "Required";
    }else{
        $errpost_details = "";
        $post_details = mysqli_real_escape_string($connect, $post_details);
    }

    $errors = $errpost_title . $errpost_subtitle . $errpost_image . $errpost_category . $errpost_details;

    if (empty($errors)) {
        $stmt = "INSERT INTO posts(post_title, post_subtitle, post_details, post_image, post_category)
        VAlUES('$post_title', '$post_subtitle', '$post_details', '$image_name', '$post_category')";
        $query = mysqli_query($connect, $stmt);
        if ($query) {
            move_uploaded_file($post_tmpimage, $target_file);
            $msg = "<div class='alert alert-success'>
                <b>New post created successully</b>
            </div>";
        }else{
            $msg = "<div class='alert alert-danger'>
            <b>Oops Something Went Wrong</b>
        </div>";
        }
    }
}

if (isset($_POST['edit_post'])) {
    $post_id = $_POST['post_id'];
    $stmt = "SELECT * FROM posts WHERE id = '$post_id'";
    $query = mysqli_query($connect, $stmt);
    $post = mysqli_fetch_assoc($query);
    
    $post_title = testInput($_POST['post_title']);
    if (empty($post_title)) {
        $errpost_title = "Required";
    }elseif (!preg_match("/^[a-zA-Z0-9,.? ]*$/", $post_title)) {
        $errpost_title = "Invalid firstname value";
    }elseif (str_word_count($post_title) < 3) {
        $errpost_title = "Invalid firstname value";
    }else{
        $errpost_title = "";
        $post_title = mysqli_real_escape_string($connect, $post_title);
    }

    $post_subtitle = testInput($_POST['post_subtitle']);
    if (empty($post_subtitle)) {
        $errpost_subtitle = "Required";
    }elseif (!preg_match("/^[a-zA-Z0-9,.? ]*$/", $post_subtitle)) {
        $errpost_subtitle = "Invalid firstname value";
    }elseif (str_word_count($post_subtitle) < 3) {
        $errpost_subtitle = "Invalid firstname value";
    }else{
        $errpost_subtitle = "";
        $post_subtitle = mysqli_real_escape_string($connect, $post_subtitle);
    }

    $post_image = $_FILES['post_image']['name'];
    $post_tmpimage = $_FILES['post_image']['tmp_name'];
    $ext = strtolower(pathinfo($post_image, PATHINFO_EXTENSION));
    if (empty($post_image)) {
        $image_name = $post['post_image'];
    }elseif ($ext != "jpg" && $ext != "png" && $ext != "jpeg") {
        $errpost_image = "Invalid File";
    }elseif ($_FILES['post_image']['size'] > 500000) {
        $errpost_image = "File Is Too Large (Max: 5mb)";
    }else{
        $errpost_image = "";
        $image_name = rand(0000, 9999).".".$ext;
        $target_file = "uploads/".$image_name;
    }


    $post_category = testInput($_POST['category']);

    $post_details = $_POST['post_details'];
    if (empty($post_details)) {
        $errpost_details = "Required";
    }else{
        $errpost_details = "";
        $post_details = mysqli_real_escape_string($connect, $post_details);
    }

    $errors = $errpost_title . $errpost_subtitle . $errpost_image . $errpost_category . $errpost_details;

    if (empty($errors)) {
        $updated_on = date('Y-m-d H:i:s');
        $stmt = "UPDATE posts SET post_title='$post_title', post_subtitle='$post_subtitle', post_details='$post_details', post_image='$image_name', post_category='$post_category', `update_on`='$updated_on' WHERE id = $post_id";
        $query = mysqli_query($connect, $stmt);
        if ($query) {
           if (!empty($post_image)) {
                if (file_exists("uploads/".$post['post_image'])) {
                    unlink("uploads/".$post['post_image']);
                }
                move_uploaded_file($post_tmpimage, $target_file);
           }

            $msg = "<div class='alert alert-success'>
                        <b>Post updated successully</b>
                    </div>";
        }else{
            $msg = "<div class='alert alert-danger'>
                        <b>Oops Something Went Wrong</b>
                    </div>";
        }
    }
}

if (isset($_GET['delete']) && !empty($_GET['delete']) && is_numeric($_GET['delete'])) {
    $post_id = (int)$_GET['delete'];
    $stmt = "DELETE FROM posts WHERE id = $post_id";
    $query = mysqli_query($connect, $stmt);
    if ($query) {
        $msg = "<div class='alert alert-success'>
                    <b>Post deleted successully</b>
                </div>";
    }else{
        $msg = "<div class='alert alert-danger'>
                    <b>Oops Something Went Wrong</b>
                </div>";
    }
}

if (isset($_POST['addcategory'])) {
    $post_category = testInput($_POST['category']);

    if (empty($post_category)) {
        $errpost_category = "Required";
    }elseif (!preg_match("/^[a-zA-Z ]*$/", $post_category)) {
        $errpost_category = "Invalid category name";
    }else{
        $cat_slug = strtolower($post_category);
        $cat_slug = preg_replace("/ /i", "-", $cat_slug);
        $stmt = "SELECT * FROM categories WHERE category_slug = '$cat_slug'";
        $query = mysqli_query($connect, $stmt);
        $numrow = mysqli_num_rows($query);
        if ($numrow > 0) {
            $errpost_category = "Category already exist";
        }else{
            $stmt = "INSERT INTO categories (category_slug, category_name) VALUES('$cat_slug', '$post_category')";
            $query = mysqli_query($connect, $stmt);
            if ($query) {
                $msg = "<div class='alert alert-success'>
                            <b>Category created successfully</b>
                        </div>";
            }else{
                $msg = "<div class='alert alert-danger'>
                            <b>Oops Something Went Wrong</b>
                        </div>";
            }
        }
    }
}

if (isset($_GET['cat_delete']) && !empty($_GET['cat_delete'])) {
    $category_id = $_GET['cat_delete'];
    $stmt = "DELETE FROM categories WHERE category_slug = '$category_id'";
    $query = mysqli_query($connect, $stmt);
    if ($query) {
        $msg = "<div class='alert alert-success'>
                    <b>Category deleted successully</b>
                </div>";
    }else{
        $msg = "<div class='alert alert-danger'>
                    <b>Oops Something Went Wrong</b>
                </div>";
    }
}

if (isset($_POST['editcategory'])) {
    $post_category = testInput($_POST['category']);
    $cat_id = $_GET['edit'];

    if (empty($post_category)) {
        $errpost_category = "Required";
    }elseif (!preg_match("/^[a-zA-Z ]*$/", $post_category)) {
        $errpost_category = "Invalid category name";
    }else{
        $cat_slug = strtolower($post_category);
        $cat_slug = preg_replace("/ /i", "-", $cat_slug);
        $stmt = "SELECT * FROM categories WHERE category_slug = '$cat_slug'";
        $query = mysqli_query($connect, $stmt);
        $numrow = mysqli_num_rows($query);
        if ($numrow > 0) {
            $errpost_category = "Category already exist";
        }else{
            $stmt = "UPDATE categories SET category_slug = '$cat_slug', category_name = '$post_category' WHERE category_slug = '$cat_id'";
            $query = mysqli_query($connect, $stmt);
            if ($query) {
                // $msg = "<div class='alert alert-success'>
                //             <b>Category updated successfully</b>
                //         </div>";
                        header('location: manage_category.php');
            }else{
                $msg = "<div class='alert alert-danger'>
                            <b>Oops Something Went Wrong</b>
                        </div>";
            }
        }
    }
}