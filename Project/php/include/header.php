<?php
    include "../connect/connect.php";
    include "../connect/session.php";
?>

<div id="skip">
    <a href="#header">헤더 영역 바로가기</a>
    <a href="#main">컨텐츠 영역 바로가기</a>
    <a href="#footer">푸터 영역 바로가기</a>
</div>
<!-- //skip -->

<header id="header" class="show">
    <div class="header__inner">
        <div class="left">
            <a href="http://bb020440.dothome.co.kr/php/main/main.php"><span class="blind">메인페이지 이동</span></a>
        </div>
        <div class="middle">
            <ul>
                <li><a href="http://bb020440.dothome.co.kr/php/category/small_cg.php">오늘의 이슈</a></li><!-- 임시 경로 -->
                <li><a href="http://bb020440.dothome.co.kr/php/category/category_R.php">꿀팁 저장소</a></li>
                <li><a href="http://bb020440.dothome.co.kr/php/Notice/QnACate.php">QnA</a></li>
                <li><a href="http://bb020440.dothome.co.kr/php/board/notice.php">공지사항</a></li>
            </ul>
        </div>
        <div class="right">
            <ul>
            <?php 
                if(isset($_SESSION['myMemberID'])) {
                ?> 
                <li><a href="#"><span class="blind">알림</span></a></li>
                <li><a href="http://bb020440.dothome.co.kr/php/category/categoryWrite.php"><span class="blind">글쓰기</span></a></li>
                <li><a href="../login/logout.php"><?=$_SESSION['youName']?>로그아웃</a></li>
                <?php 
                    }  
                    else { 
                ?>
                <li style="display:none;"><a href="#"></a></li>
                <li style="display:none;"><a href="#"></a></li>
                <li><a class="btn3 loginBtn" href="#">로그인</a></li>
                <?php 
                    } 
                ?>
            </ul>
        </div>
    </div>
</header>

<div class="header__none" aria-hidden="true">
    <div class="header__inner">
        <div class="left">
            <a href="main.html"><span class="blind">메인페이지 이동</span></a>
        </div>
        <div class="middle">
            <ul>
                <li><a href="Today_issue.html">오늘의 이슈</a></li>
                <li><a href="Tip_infor.html">꿀팁 저장소</a></li>
                <li><a href="QnA_page.html">QnA</a></li>
                <li><a href="Notice.html">공지사항~~</a></li>
            </ul>
        </div>
        <div class="right">
            <ul>
                <?php 
                    if(isset($_SESSION['myMemberID'])) {
                ?> 
                <?php echo "aaa"; ?>
                <li><a href="#" class="black"><?= $_SESSION['youName'] ?>님 환영합니다.</a></li>
                <li><a href="#"><span class="blind">알림</span></a></li>
                <li><a href="board_write.html"><span class="blind">글쓰기</span></a></li>
                <li><a href="../login/logout.php">로그아웃</a></li>
                
                <?php 
                    }  
                    else { 
                ?>
                <li style="display:none;"><a href="#"></a></li>
                <li style="display:none;"><a href="#"></a></li>
                <li><a class="btn3 loginBtn" href="#">로그인</a></li>
                <?php 
                    } 
                ?>
            </ul>
        </div>
    </div>
</div>
<!-- //header -->

<?php
    include "../login/login.php";
?>