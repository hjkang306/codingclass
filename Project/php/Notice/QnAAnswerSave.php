<?php
    header('Access-Control-Allow-Origin: *');
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";
?>

<?php
    $myMemberID = $_SESSION['myMemberID'];
    $QnAID = $_POST['QnAID'];
    $youName = $_SESSION['youName'];
    $QnAReply = $_POST['QnAWriteDesc'];
    $regTime = time();

    $category = $_POST['QnACategory'];

    $sql = "INSERT INTO myReply(myMemberID, myQnAID, youName, QnAReply, regTime) VALUES($myMemberID, $QnAID, '$youName', '$QnAReply', $regTime);";
    $result = $connect -> query($sql);

    Header("Location: http://bb020440.dothome.co.kr/php/Notice/QnACate.php?category=$category");
?>