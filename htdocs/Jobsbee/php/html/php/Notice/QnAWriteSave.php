<?php
    header('Access-Control-Allow-Origin: *');
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";
?>

<?php
    $myMemberID = $_SESSION['myMemberID'];
    $youName = $_SESSION['youName'];
    $QnAtitle = $_POST['QnAWriteHeader'];
    $QnAContents = $_POST['QnAWriteDesc'];
    $QnACategory = $_POST['searchOption1'];
    $QnATag = $_POST['QnAWriteTag'];
    $regTime = time();

    $categoryNum = 1;
    if($QnACategory === "건강") {
        $categoryNum = 1;
    }
    else if ($QnACategory === "전자기기") {
        $categoryNum = 2;
    }
    else if ($QnACategory === "청소") {
        $categoryNum = 3;
    }
    else if ($QnACategory === "취미") {
        $categoryNum = 4;
    }
    else if ($QnACategory === "라이프 스타일") {
        $categoryNum = 5;
    }
    else if ($QnACategory === "건강2") {
        $categoryNum = 6;
    }

    $sql = "INSERT INTO myQnA(myMemberID, QnATitle, QnAContents, QnACategory, QnATag, regTime) VALUES($myMemberID, '$QnAtitle', '$QnAContents', '$QnACategory', '$QnATag', $regTime);";
    $result = $connect -> query($sql);

    // $selectSql = "SELECT * FROM myQnA ORDER BY myQnAID DESC";
    // $selectResult = $connect -> query($selectSql);
    // $info = $selectResult -> fetch_array(MYSQLI_ASSOC);
    // $myQnAID = $info['myQnAID'];

    // $sql2 = "INSERT INTO myReply(myMemberID, myQnAID, youName, QnAReply, regTime) VALUES($myMemberID, $myQnAID, '$youName', '$QnAReply', $regTime);";
    // $connect -> query($sql2);

    Header("Location: http://bb020440.dothome.co.kr/php/Notice/QnACate0$categoryNum.php");
?>