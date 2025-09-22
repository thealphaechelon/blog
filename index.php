<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <title>Abstract</title>
    <?php
        require 'includes/head.php';
    ?>
</head>

<body id="top">

    <!-- header
    ================================================== -->
    <?php
        require 'includes/nav.php';
    ?>
    <!-- end header -->


    <!-- masonry
    ================================================== -->
    <section class="s-bricks">

        <div class="masonry">
            <div class="bricks-wrapper h-group">
 
                <div class="grid-sizer"></div>

                <div class="brick entry featured-grid animate-this">
                    <div class="entry__content">

                        <div class="featured-post-slider">
                            <?php
                                $stmt = "SELECT * FROM posts ORDER BY id DESC LIMIT 3";
                                $query = mysqli_query($connect, $stmt);
                                while ($post = mysqli_fetch_assoc($query)):
                            ?>
                            <div class="featured-post-slide">
                                <div class="f-slide">
                                    
                                    <div class="f-slide__background" style="background-image:url('dashboard/uploads/<?=$post['post_image'];?>');"></div>
                                    <div class="f-slide__overlay"></div>

                                    <div class="f-slide__content">
                                        <h1 class="f-slide__title"><a href="post.php?post=<?=$post['id'];?>" title=""><?=$post['post_title'];?></a></h1> 
                                    </div>

                                </div> <!-- f-slide -->
                            </div> <!-- featured-post-slide -->
                            <?php
                                endwhile;
                            ?>

                        </div> <!-- end feature post slider -->
                        
                        <div class="featured-post-nav">
                            <button class="featured-post-nav__prev">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12.707 17.293L8.414 13H18v-2H8.414l4.293-4.293-1.414-1.414L4.586 12l6.707 6.707z"></path></svg>
                            </button>
                            <button class="featured-post-nav__next">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11.293 17.293l1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path></svg>
                            </button>
                        </div> <!-- featured-post-nav -->

                    </div> <!-- end entry content -->
                </div> <!-- end entry, featured grid -->
                <?php
                     if(isset($_GET['page']))
                     {
                         $page=$_GET['page'];
                     }
                     else
                     {
                         $page = 1;
                     }
                     
                     $limit = 1;                     
                     $offset=($page-1)*$limit;
                    $stmt = "SELECT * FROM categories c INNER JOIN posts p ON p.post_category = c.id ORDER BY p.id DESC LIMIT $offset,$limit";
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
                                    <a href="#"><?=$post['category_name'];?></a> 
                                </span>
                            </div>
    
                            <h1 class="entry__title"><a href="post.php?post=<?=$post['id'];?>"><?=$post['post_title'];?></a></h1>
                            
                        </div>
                        <!-- <div class="entry__excerpt">
                            <p>
                                Lorem ipsum Sed eiusmod esse aliqua sed incididunt aliqua incididunt mollit id et sit proident dolor nulla sed commodo est ad minim elit reprehenderit nisi officia aute incididunt velit sint in aliqua cillum in consequat consequat in culpa in anim.
                            </p>
                        </div> -->
                    </div> <!-- end entry__text -->
    
                </article> <!-- end entry -->

                <?php endwhile; ?>
 
            </div> <!-- end brick-wrapper --> 
 
        </div> <!-- end masonry -->
        
        <div class="row">
            <div class="column large-12">
                <nav class="pgn">
                    <?php
                        $stmt = "SELECT * FROM posts";
                        $query = mysqli_query($connect, $stmt);
                        $numrow = mysqli_num_rows($query);
                        if ($numrow > 0) {
                            $totalpage = ceil($numrow / $limit);
                        }
                    ?>
                    <ul>
                        <?php
                            if ($page > 1):
                        ?>
                        <li>
                            <a class="pgn__prev" href="?page=<?=($page - 1); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12.707 17.293L8.414 13H18v-2H8.414l4.293-4.293-1.414-1.414L4.586 12l6.707 6.707z"></path></svg>
                            </a>
                        </li>
                        <?php 
                            endif;
                            for ($i=1; $i <= $totalpage; $i++):
                         ?>
                        <li><a class="pgn__num <?=$page==$i?'current':'';?>" href="?page=<?=$i;?>"><?=$i?></a></li>
                        <?php
                            endfor;
                            if ($totalpage > $page):
                        ?>
                        <li>
                            <a class="pgn__next" href="?page=<?=($page + 1); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11.293 17.293l1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path></svg>
                            </a>
                        </li>
                        <?php endif; ?>
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