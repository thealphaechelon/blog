<?php
    if (isset($_POST['submit'])) {
        $name = $_POST['cName'];
        $comment = $_POST['cMessage'];

        $stmt = "INSERT INTO comments(post_id, name, comment) VALUES($post_id, '$name', '$comment')";
        $query = mysqli_query($connect, $stmt);
    }
?>