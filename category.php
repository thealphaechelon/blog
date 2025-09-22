<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <title>Category - Abstract</title>
    <?php
        require 'includes/head.php';
    ?>

</head>
<?php
if (isset($_GET['cat']) && !empty($_GET['cat'])) {
    $cat_slug = $_GET['cat'];
    $stmt = "SELECT * FROM categories WHERE category_slug = '$cat_slug'";
    $query = mysqli_query($connect, $stmt);
    if (mysqli_num_rows($query) > 0) {
        $category = mysqli_fetch_assoc($query);
        $cat_id = $category['id'];
    }else{
        header('location: index.php');
    }
}else{
    header('location: index.php');
}
?>
<body id="top">




    <!-- header
    ================================================== -->
    <?php
        require 'includes/nav.php';
    ?>
    <!-- end header -->


    <!-- page header
    ================================================== -->
    <section class="s-pageheader">
        <div class="row current-cat">
            <div class="column">
                <h1 class="h2">Category: <?=ucfirst($category['category_name'])?></h1>
            </div>
        </div>
    </section>


    <!-- masonry
    ================================================== -->
    <section class="s-bricks with-top-sep">

        <div class="masonry">

            <!-- brick-wrapper -->
            <div class="bricks-wrapper h-group">
 
                <div class="grid-sizer"></div>
                <?php
                    $stmt = "SELECT * FROM categories c INNER JOIN posts p ON p.post_category = c.id WHERE p.post_category = $cat_id ORDER BY p.id DESC";
                    $query = mysqli_query($connect, $stmt);
                    while($post = mysqli_fetch_assoc($query)):
                ?>
                <article class="brick entry format-standard animate-this">
    
                    <div class="entry__thumb">
                        <a href="post.php?post=<?=$post['id'];?>" class="thumb-link">
                            <img src="dashboard/uploads/<?=$post['post_image'];?>" 
                                 srcset="dashboard/uploads/<?=$post['post_image'];?> 1x, dashboard/uploads/<?=$post['post_image'];?> 2x" alt="">
                        </a>
                    </div> <!-- end entry__thumb -->
    
                    <div class="entry__text">
                        <div class="entry__header">
    
                            <div class="entry__meta">
                                <span class="entry__cat-links">
                                    <a href="#"><?=$category['category_name'];?></a> 
                                </span>
                            </div>
    
                            <h1 class="entry__title"><a href="post.php?post=<?=$post['id'];?>"><?=$post['post_title'];?></a></h1>
                            
                        </div>
                    </div> <!-- end entry__text -->
    
                </article> <!-- end entry -->
                <?php
                    endwhile;
                ?>
 
            </div> <!-- end brick-wrapper --> 
 
        </div> <!-- end masonry -->

        <div class="row">
            <div class="column large-12">
                <nav class="pgn">
                    <ul>
                        <li>
                            <a class="pgn__prev" href="#0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12.707 17.293L8.414 13H18v-2H8.414l4.293-4.293-1.414-1.414L4.586 12l6.707 6.707z"></path></svg>
                            </a>
                        </li>
                        <li><a class="pgn__num" href="#0">1</a></li>
                        <li><span class="pgn__num current">2</span></li>
                        <li><a class="pgn__num" href="#0">3</a></li>
                        <li><a class="pgn__num" href="#0">4</a></li>
                        <li><a class="pgn__num" href="#0">5</a></li>
                        <li><span class="pgn__num dots">…</span></li>
                        <li><a class="pgn__num" href="#0">8</a></li>
                        <li>
                            <a class="pgn__next" href="#0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11.293 17.293l1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path></svg>
                            </a>
                        </li>
                    </ul>
                </nav> <!-- end pgn -->
            </div> <!-- end column -->
        </div> <!-- end row -->

    </section> <!-- end s-bricks -->


    <!-- footer
    ================================================== -->
    <?php
        require 'includes/footer.php';
    ?>
    <!-- end s-footer -->


   <!-- Java Script
   ================================================== --> 
   <script src="js/jquery-3.2.1.min.js"></script>
   <script src="js/plugins.js"></script>
   <script src="js/main.js"></script>

</body>

</html>