<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";
?>

<?php
    $boardCateBig = $_POST['searchOption1'];
    $boardCateSamll = $_POST['searchOption2'];
    $boardTitle = $_POST['boardWriteHeader'];
    $boardContents = nl2br($_POST['boardWriteDesc']);
    $boardTag = $_POST['boardWriteTag'];

    $boardTitle = $connect -> real_escape_string($boardTitle);
    $boardContents = $connect -> real_escape_string($boardContents);
    $regTime = time();
    $myMemberID = $_SESSION['myMemberID'];
    $youName = $_SESSION['youName'];

    $sql = "INSERT INTO myTips(myMemberID, TipsTitle, TipsContents, TipsCateBig, TipsCateSmall, TipsTag, regTime) VALUES('$myMemberID','$boardTitle','$boardContents', '$boardCateBig', '$boardCateSamll', '$boardTag', '$regTime')";
    $connect -> query($sql);
    $sql = "SELECT myTipsID FROM myTips WHERE myTipsID = (SELECT max(myTipsID) FROM myTips)";
    $TipsIDResult = $connect -> query($sql);
    $TipsID = $TipsIDResult -> fetch_array(MYSQLI_ASSOC);

?>

<script>
    location.href = "http://hjkang306.dothome.co.kr/php/category/small_cg_detail.php?categoryBig=<?php echo $boardCateBig;?>&categorySmall=<?php echo $boardCateSamll;?>&myTipsID=<?php echo $TipsID['myTipsID']?>";
</script>