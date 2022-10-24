<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";
?>

<?php

    $myTipsID = $_GET['myTipsID'];

    $boardCateBig = $_POST['searchOption1'];
    $boardCateSmall = $_POST['searchOption2'];
    $boardTitle = $_POST['boardWriteHeader'];
    $boardContents = nl2br($_POST['boardWriteDesc']);
    $boardTag = $_POST['boardWriteTag'];

    $boardTitle = $connect -> real_escape_string($boardTitle);
    $boardContents = $connect -> real_escape_string($boardContents);
    $regTime = time();
    $myMemberID = $_SESSION['myMemberID'];
    $youName = $_SESSION['youName'];

    $sql = "SELECT myMemberID FROM myMember WHERE myMemberID = {$myMemberID};";
    $result = $connect -> query($sql);

    $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);

    if($memberInfo['myMemberID'] === $myMemberID) {
        $sql = "UPDATE myTips SET TipsTitle = '$boardTitle', TipsContents = '$boardContents', TipsCateBig = '$boardCateBig', TipsCateSmall = '$boardCateSmall', TipsTag = '$boardTag', regTime = '$regTime' WHERE myTipsID={$myTipsID}";
        $connect -> query($sql);
    }

?>

<script>
    location.href = "http://bb020440.dothome.co.kr/php/category/small_cg_detail.php?categoryBig=<?php echo $boardCateBig;?>&categorySmall=<?php echo $boardCateSamll;?>&myTipsID=<?php echo $myTipsID;?>";
</script>