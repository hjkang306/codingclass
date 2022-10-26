<?php
    include "../connect/connect.php";

    $commentPass = $_POST['pass'];
    $myCommentID = $_POST['commentID'];

    $sql = "DELETE FROM myComment WHERE myCommentID = $myCommentID";
    $result = $connect -> query($sql);

    echo json_encode(array("info" => $myCommentID));
?>