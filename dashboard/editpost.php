<?php 
    require 'includes/script.php';
    if (isset($_GET['post']) && !empty($_GET['post']) && is_numeric($_GET['post'])) {
        $post_id = (int)$_GET['post'];
        $stmt = "SELECT * FROM posts WHERE id = '$post_id'";
        $query = mysqli_query($connect, $stmt);
        if (mysqli_num_rows($query) > 0) {
            $post = mysqli_fetch_assoc($query);
        }else{
            header('location: manage_posts.php');
        }
    }else{
        header('location: manage_posts.php');
    }
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Static Navigation - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php require 'includes/nav.php' ?>
        <div id="layoutSidenav">
            <?php require 'includes/sidebar.php' ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Edit Post</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Posts</li>
                        </ol>
                        <div class="card mb-4">
                        <?=$msg;?>
                            <div class="card-body mt-2">
                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-6 mt-2">
                                                <div class="form-floating">
                                                    <input class="form-control" id="postTitle" type="text" name="post_title" value="<?=$post['post_title']?>" placeholder="Post Title" />
                                                    <label for="postTitle">Post Title</label>
                                                    <span class="text-danger"><?=$errpost_title;?></span>
                                                </div>
                                            </div>
                                            <div class="col-6 mt-2">
                                                <div class="form-floating">
                                                    <input class="form-control" id="subTitle" type="text" name="post_subtitle" value="<?=$post['post_subtitle']?>" placeholder="Post Subtitle" />
                                                    <label for="subTitle">Post Subtitle</label>
                                                </div>
                                                <span class="text-danger"><?=$errpost_subtitle;?></span>
                                            </div>
                                            <div class="col-6 mt-2">
                                                <div class="form-input">
                                                    <input class="form-control p-3" id="postImage" type="file" name="post_image" />
                                                </div>
                                                <span class="text-danger"><?=$errpost_image;?></span>
                                            </div>
                                            <div class="col-6 mt-2">
                                                <div class="form-floating">
                                                    <select name="category" id="category" class="form-control">
                                                        <?php
                                                            $stmt = "SELECT * FROM categories";
                                                            $query = mysqli_query($connect, $stmt);
                                                            while($row = mysqli_fetch_assoc($query)){
                                                        ?>
                                                        <option value="<?=$row['id']?>" <?=($post['post_category'] == $row['id']) ? "selected" : ""; ?>><?=$row['category_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <label for="inputEmail">Select Category</label>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-input">
                                                    <label for="postDetails">Post Details</label>
                                                    <span class="text-danger float-end"><?=$errpost_details;?></span>
                                                    <textarea name="post_details" id="postDetails" class="form-control" cols="50">
                                                    <?=$post['post_details']?>
                                                    </textarea>
                                                </div>
                                            </div>
                                            <input type="hidden" name="post_id" value="<?=$post['id']?>">
                                            <button type="submit" name="edit_post" class="btn btn-success col-3 mt-4 mx-auto">Update Post</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.tiny.cloud/1/qj6pq78gszoq0h88gjziag5yj10ol9jk0y0vbzr7nqjop5lx/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
