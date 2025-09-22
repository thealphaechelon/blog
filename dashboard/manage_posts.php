<?php require 'includes/script.php'; ?>
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
                        <h1 class="mt-4">Manage Posts</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Posts</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <?=$msg;?>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Post Title</th>
                                            <th>Post Subtitle</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Views</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Post Title</th>
                                            <th>Post Subtitle</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Views</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                       <?php
                                            $stmt = "SELECT *, DATE(p.created_on) AS post_date FROM categories c INNER JOIN posts p ON p.post_category = c.id";
                                            $query = mysqli_query($connect, $stmt);
                                            $numrow = mysqli_num_rows($query);
                                            if ($numrow > 0) {
                                                while ($row = mysqli_fetch_assoc($query)) {
                                       ?>
                                       <tr>
                                            <td><?=$row['post_title'];?></td>
                                            <td><?=$row['post_subtitle'];?></td>
                                            <td><img src="uploads/<?=$row['post_image'];?>" alt="" width="150px"></td>
                                            <td><?=$row['category_name'];?></td>
                                            <td><?=$row['views'];?></td>
                                            <td><?=$row['post_date'];?></td>
                                            <td>
                                                <a href="editpost.php?post=<?=$row['id'];?>" class="btn btn-warning">Edit</a>
                                                <a href="?delete=<?=$row['id'];?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                             }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
