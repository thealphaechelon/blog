<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <title>Standard Post - Abstract</title>
    <?php
        require 'includes/head.php';
    ?>

</head>
<?php
if (isset($_GET['post']) && !empty($_GET['post']) && is_numeric($_GET['post'])) {
    $post_id = (int)$_GET['post'];
    $stmt = "SELECT * FROM posts WHERE id = '$post_id'";
    $query = mysqli_query($connect, $stmt);
    if (mysqli_num_rows($query) > 0) {
        $post = mysqli_fetch_assoc($query);
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


    <!-- content
    ================================================== -->
    <section class="s-content s-content--single">
        <div class="row">
            <div class="column large-12">

                <article class="s-post entry format-standard">

                    <div class="s-content__media">
                        <div class="s-content__post-thumb">
                            <img src="dashboard/uploads/<?=$post['post_image']?>" 
                                 srcset="dashboard/uploads/<?=$post['post_image']?> 2100w, 
                                        dashboard/uploads/<?=$post['post_image']?> 1050w, 
                                        dashboard/uploads/<?=$post['post_image']?> 525w" sizes="(max-width: 2100px) 100vw, 2100px" alt="">
                        </div>
                    </div> <!-- end s-content__media -->

                    <div class="s-content__primary">
                        <h2 class="s-content__title s-content__title--post"><?=$post['post_title']?></h2>
                        <p><?=$post['post_details']?></p>
                    </div> <!-- end s-content__primary -->
                </article>

            </div> <!-- end column -->
        </div> <!-- end row -->


        <!-- comments
        ================================================== -->
        <div class="comments-wrap">

            <div id="comments" class="row">
                <div class="column">
                    <?php
                     $stmt = "SELECT * FROM comments WHERE post_id = '$post_id'";
                     $query = mysqli_query($connect, $stmt);
                     $numrow = mysqli_num_rows($query);
                    ?>

                    <h3><?=$numrow;?> Comments</h3>

                    <!-- START commentlist -->
                    <ol class="commentlist">
                        <?php
                            while($comment = mysqli_fetch_assoc($query)):
                        ?>
                        <li class="depth-1 comment">

                            <div class="comment__content">

                                <div class="comment__info">
                                    <div class="comment__author"><?=$comment['name'];?></div>

                                    <div class="comment__meta">
                                        <div class="comment__time"><?=date('M d, Y',strtotime($comment['created_on']));?></div>
                                    </div>
                                </div>

                                <div class="comment__text">
                                <p><?=$comment['comment'];?></p>
                                </div>

                            </div>

                        </li> <!-- end comment level 1 -->
                        <?php
                            endwhile;
                        ?>


                    </ol>
                    <!-- END commentlist -->

                </div> <!-- end col-full -->
            </div> <!-- end comments -->


            <div class="row comment-respond">

                <!-- START respond -->
                <div id="respond" class="column">

                    <h3>
                    Add Comment 
                    <span>Your email address will not be published.</span>
                    </h3>
                    <?php include 'includes/script.php'; ?>
                    <form name="contactForm" id="contactForm" method="post" action="" autocomplete="off">
                        <fieldset>

                            <div class="form-field">
                                <input name="cName" id="cName" class="h-full-width" placeholder="Your Name" value="" type="text">
                            </div>

                            <div class="message form-field">
                                <textarea name="cMessage" id="cMessage" class="h-full-width" placeholder="Your Message"></textarea>
                            </div>

                            <input name="submit" id="submit" class="btn btn--primary btn-wide btn--large h-full-width" value="Add Comment" type="submit">

                        </fieldset>
                    </form> <!-- end form -->

                </div>
                <!-- END respond-->

            </div> <!-- end comment-respond -->

        </div> <!-- end comments-wrap -->

    </section> <!-- end s-content -->


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