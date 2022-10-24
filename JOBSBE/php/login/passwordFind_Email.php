<?php
    include "../connect/connect.php";
    $id = $_POST['SearchPWEmailID'];
    $name = $_POST['SearchPWEamilName'];
    $email = $_POST['SearchPWEmailEmail'];
    
    $id = $connect -> real_escape_string($id);
    $name = $connect -> real_escape_string($name);
    $email = $connect -> real_escape_string($email);

    $sql = "SELECT myMemberID, youName, youEmail FROM myMember WHERE myMemberID = {$id} and youName = {$name} and youEmail = {$email};";
    $result = $connect -> query($sql);

    $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);

    if($memberInfo['myMemberID'] === $myMemberID) {
        $sql = "UPDATE myNotice SET noticeTitle = '$noticeTitle', noticeContents = '$noticeContents' WHERE myNoticeID={$myNoticeID}";
        $connect -> query($sql);
    }
?>
