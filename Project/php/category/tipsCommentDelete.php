<?php
    include "../connect/connect.php";

    $myMemberID = $_POST['myMemberID'];
    $commentPass = $_POST['pass'];
    $commentID = $_POST["commentID"];

    // $sql = "SELECT * FROM myComment WHERE myCommentID = {$commentID}";
    // $myMemberID2 = $myComment['myMemberID'];
    // echo $myMemberID2

    $sql = "DELETE FROM myComment WHERE myCommentID = {$commentID}";
    $result = $connect -> query($sql);
    echo json_encode(array("info" => $sql));

    // if($myMemberID == $myMemberID2){
    //     $sql = "DELETE FROM myComment WHERE myCommentID = {$commentID}";
    //     $result = $connect -> query($sql);
    //     echo json_encode(array("info" => $sql));
    // } else {
    //     echo "<script>alert('당신의 댓글이 아닙니다.'); history.back();</script>";
    // }



?>