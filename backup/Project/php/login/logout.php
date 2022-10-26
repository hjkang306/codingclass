<?php
    include "../connect/session.php";

    unset($_SESSION['myMemberID']);
    unset($_SESSION['youID']);
    unset($_SESSION['youName']);
?>

<script>
    location.href = 'http://hjkang306.dothome.co.kr/php/main/main.php';
</script>