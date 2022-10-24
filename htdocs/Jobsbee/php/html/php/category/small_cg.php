<?php
    header('Access-Control-Allow-Origin: *');
    include "../connect/connect.php";
    include "../connect/session.php";
    // include "../connect/sessionCheck.php";

    $categoryBig = $_GET['categoryBig'];
    $categorySmall = $_GET['categorySmall'];

    $categorySql = "SELECT * FROM myTips WHERE TipsCateBig = '$categoryBig' AND TipsCateSmall = '$categorySmall' ORDER BY myTipsID DESC ";
    $categoryResult = $connect -> query($categorySql);
    $categoryInfo = $categoryResult -> fetch_array(MYSQLI_ASSOC);
    $categoryCount = $categoryResult -> num_rows;

?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>small_cg</title>
    <link rel="stylesheet" href="../../html/asset/css/style.css">
    <link rel="stylesheet" href="../../html/asset/css/small_cg.css">

    <?php 
        include "../include/link.php";
    ?>

</head>

<body>
    <?php
        include "../include/header.php";
    ?>
    <!-- //header -->
    

    <main id="main">
        <section id="banner">
            <div class="banner__inner">
                <figure>
                    <img src="../../html/asset/img/bannerBee.png" alt="마스코트">
                </figure>

                <div class="banner__desc">
                    <span class="sub__title">TIPS</span>
                    <h2 class="main__title"><?=$categoryInfo['TipsCateBig']?></h2>
                    <p class="banner__info">
                        다양한 정보를 <br>
                        종류별로 모아놨습니다.
                    </p>
                </div>
            </div>
        </section>
        <!-- //banner -->

        <section id="subTitle">
            <nav>
                <ul>
                    <li class="active"><a href="http://bb020440.dothome.co.kr/php/category/small_cg.php?categoryBig=<?=$categoryBig?>&categorySmall=<?=$categorySmall?>">핸드폰</a></li>
                    <li><a href="#c">컴퓨터</a></li>
                    <li><a href="#c">선풍기</a></li>
                    <li><a href="#c">에어컨</a></li>
                </ul>
            </nav>
            <a href="#c" class="prev"><span class="ir">이전</span></a>
            <a href="#c" class="next"><span class="ir">다음</span></a>
        </section>
        <!-- //subTitle -->

        <section id="issue">
            <div class="issue__inner container">
                <h2>🔥 오늘의 인기 글</h2>
                <article class="cont">
<?php

    // 두개의 테이블 join
    // $sql = "SELECT myTipsID, TipsTitle, TipsView, TipsLike, regTime FROM myTips ORDER BY TipsLike DESC LIMIT 0, 1";
    $sql = "SELECT myTipsID, TipsTitle, TipsView, TipsLike, regTime FROM myTips WHERE TipsView = (SELECT max(TipsView) FROM myTips) AND TipsCateBig = '$categoryBig' AND TipsCateSmall = '$categorySmall'";
    $result = $connect -> query($sql);
    if($result){
        $count = $result -> num_rows;
        if($count > 0){
            $info = $result -> fetch_array(MYSQLI_ASSOC);
            echo "<div class = 'issue__title'>";
            echo "<h3>";
            echo "<a href='small_cg_detail.php?myTipsID={$info['myTipsID']}'>".$info['TipsTitle']."</a>";
            echo "</h3>";
            echo "<div class='icon'>";
            echo "<a href='#' class='like'>".$info['TipsLike']."</a>";
            echo "<a href='#' class='view'>".$info['TipsView']."</a>";
            echo "</div>";
            echo "</div>";
            echo "<div class='issue__date'>".date('Y-m-d', $info['regTime'])."</div>";
        } else if($count==0){
            echo "<div class='issue__title'>게시글이 없습니다(┬┬﹏┬┬)</div>";
        }else {
                echo "<div class='issue__title'>게시글 오류입니다. 관리자에게 문의하세요!</div>";
        }
    }
?>
                    <!-- <div class="issue__title">
                        <h3>    
                            <a href="#">스미싱 당한것 같은데 신고해야 되나요? 어쩌고저쩌고</a>
                        </h3>
                        <div class="icon">
                            <a href="#" class="like">10k</span></a>
                            <a href="#" class="view">1.2k</a>
                        </div>
                    </div>

                    <div class="issue__date">
                        2019-02-04
                    </div> -->
                </article>
            </div>
        </section>
        <!-- //issue -->

        <section id="info">
            <div class="info__inner container">
                <h2>🧐 정보 모아보기</h2>

<?php
     if(isset($_GET['page'])){
        $page = (int)$_GET['page'];
    } else {
        $page = 1;
    }
    $viewNum = 4;
    $viewLimit = ($viewNum * $page) - $viewNum;

    $cateSql = "SELECT * FROM myTips WHERE TipsCateBig = '$categoryBig' AND TipsCateSmall = '$categorySmall' ORDER BY myTipsID DESC LIMIT {$viewLimit}, {$viewNum}";
    $cateResult = $connect -> query($cateSql);
    // $cateInfo = $cateResult -> fetch_array(MYSQLI_ASSOC);
    if($cateResult){
        $count = $cateResult -> num_rows;
        if($count > 0){
            if(!$cateInfo['TipsLike']){
                $cateInfo['TipsLike'] = 0;
            }
            for($i =1; $i <= $count; $i++){
                $cateInfo = $cateResult -> fetch_array(MYSQLI_ASSOC);
                echo "<article class='cont'>";
                echo "<div class='info__title'>";
                echo "<h3>";
                echo "<a href='small_cg_detail.php?myTipsID={$cateInfo['myTipsID']}'>".$cateInfo['TipsTitle']."</a></h3>";
                echo "<div class='icon'>";
                echo "<a href='#' class='like'>".$cateInfo['TipsLike']."</a>";
                echo "<a href='#' class='view'>".$cateInfo['TipsView']."</a></div>";
                echo "</div>";
                echo "<div class='info__date'>".date('Y-m-d', $cateInfo['regTime'])."</div>";
                echo "</article>";
            }
        }else if ($count==0) {
            echo "<div class='issue__title'>게시글이 없습니다(┬┬﹏┬┬)</div>";
        }else {
            echo "<div class='issue__title'>게시글 오류입니다. 관리자에게 문의하세요!</div>";
        }
            
    }
?>

<!--                 
                <article class="cont">
                    <div class="info__title">
                        <h3>
                            <a href="#">에어팟 위치 찾기!!</a>
                        </h3>
                        <div class="icon">
                            <a href="#" class="like">10k</span></a>
                            <a href="#" class="view">1.2k</a>
                        </div>
                    </div>

                    <div class="info__date">
                        2019-02-04
                    </div>
                </article> -->
                <!-- //cont1 -->
                <div class="small_cg_page">
                    <ul>
<?php
    $sql = "SELECT count(myTipsID) FROM myTips WHERE TipsCateBig = '$categoryBig' AND TipsCateSmall = '$categorySmall'";
    $result = $connect -> query($sql);
    $boardCount = $result -> fetch_array(MYSQLI_ASSOC);
    $boardCount = $boardCount['count(myTipsID)'];

    // 총 페이지 개수
    $boardCount = ceil($boardCount/$viewNum);
    // echo $boardCount;
    // 현재 페이지를 기준으로 보여주고 싶은 개수
    $pageCurrent = 3;
    $startPage = $page - $pageCurrent;
    $endPage = $page + $pageCurrent;
    // 처음 페이지 초기화
    if($startPage < 1) $startPage = 1;
    // 마지막 페이지 초기화
    if($endPage >= $boardCount) $endPage = $boardCount;

    // 이전 페이지, 처음 페이지
    if($page != 1){
        $prevPage = $page - 1;
        echo "<li><a href='small_cg.php?categoryBig=$categoryBig&categorySmall=$categorySmall&page=1' class='firstPage'></a></li>";
        echo "<li><a href='small_cg.php?categoryBig=$categoryBig&categorySmall=$categorySmall&page={$prevPage}' class='prev'></a></li>";
    }
    // 페이지 넘버 표시
    for($i=$startPage; $i<=$endPage; $i++){
        $active = "";
        if($i == $page) $active = "active";
        echo "<li class='{$active}'><a href='small_cg.php?categoryBig=$categoryBig&categorySmall=$categorySmall&page={$i}'>{$i}</a></li>";
    }
    // 다음 페이지, 마지막 페이지
    if($page != $endPage){
        $nextPage = $page + 1;
        echo "<li><a href='small_cg.php?categoryBig=$categoryBig&categorySmall=$categorySmall&page={$nextPage}' class='next'></a></li>";
        echo "<li><a href='small_cg.php?categoryBig=$categoryBig&categorySmall=$categorySmall&page={$boardCount}' class='endPage'></a></li>";
    }
?>
                        <!-- <li><a href="#">처음으로</a></li>
                        <li><a href="#">이전</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">다음</a></li>
                        <li><a href="#">마지막으로</a></li> -->
                    </ul>
                </div>
            </div>


        <aside id="ad">
            <img src="../../html/asset/img/ad01.jpg" alt="멘트문명">
            <img src="../../html/asset/img/ad02.jpg" alt="오렌지쥬스">
        </aside>
        <!-- //ad -->
    </main>
    <!-- //main -->


    <?php
        include "../include/footer.php";
    ?>


</body>


</html>