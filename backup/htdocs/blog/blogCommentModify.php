<?php
    include "../connect/connect.php";

    $commentMsg = $_POST['msg'];
    $commentPass = $_POST['pass'];
    $myCommentID = $_POST['commentID'];

    $sql = "UPDATE myComment SET commentMsg = '$commentMsg' WHERE myCommentID = $myCommentID";
    $result = $connect -> query($sql);

    echo json_encode(array("info" => $sql));
?>