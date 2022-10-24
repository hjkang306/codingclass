<?php
    header('Access-Control-Allow-Origin: *');
    include "../connect/connect.php";
    include "../connect/session.php";
    // include "../connect/sessionCheck.php";
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>small_cg_detail</title>
    <link rel="stylesheet" href="../../html/asset/css/style.css">
    <link rel="stylesheet" href="../../html/asset/css/small_cg_detail.css">

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
                    <h2 class="main__title">전자기기</h2>
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
                    <li class="active"><a href="#">핸드폰</a></li>
                    <li><a href="#">컴퓨터</a></li>
                    <li><a href="#">선풍기</a></li>
                    <li><a href="#">에어컨</a></li>
                </ul>
            </nav>
            <a href="#" class="prev"><span class="ir">이전</span></a>
            <a href="#" class="next"><span class="ir">다음</span></a>
        </section>
        <!-- //subTitle -->

        <section id="view">
            <div class="view__inner container">
<?php
    $myTipsID = $_GET['myTipsID'];

    // 조회수 ++
    
    $sql = "UPDATE myTips SET TipsView = TipsView + 1 WHERE myTipsID = {$myTipsID}";
    $connect -> query($sql);
    $sql = "UPDATE myTips SET TipsView = 1 WHERE myTipsID = {$myTipsID} AND TipsView IS NULL";
    $connect -> query($sql);


    $sql = "SELECT t.myMemberID, t.TipsTitle, t.TipsContents, t.TipsCateBig, t.TipsLike, t.TipsHate, t.TipsCateSmall, t.regTime, t.TipsTag, m.youName FROM myTips t JOIN myMember m ON(m.myMemberID = t.myMemberID) WHERE t.myTipsID = {$myTipsID};";
    $result = $connect -> query($sql);
    if($result){
        $Tips = $result -> fetch_array(MYSQLI_ASSOC);


        if($Tips['TipsTag']){

        }else{ $Tips['TipsTag'] = "# 해시태그가 없습니다(⊙x⊙;)";}
        ?>
                <div class="category">
                    <span class="bigCg"><?=$Tips['TipsCateBig']?>&nbsp;&nbsp;&gt;&nbsp;&nbsp;</span>
                    <span class="smallCg"> <?=$Tips['TipsCateSmall']?></span>
                </div>
                <h2><?=$Tips['TipsTitle']?></h2>
                <p class="author">
                    <span><?=$Tips['youName']?></span> <span><?=date('Y-m-d H:i:s',$Tips['regTime'])?></span>
                </p>

                <div class="view__text">
                    <div class="view__desc">
                        <?=$Tips['TipsContents']?>
                        <img src="../../html/asset/img/card_bg06.jpg" alt="만두 이미지">
                    </div>

                    <div class="view__hashtag"><?=$Tips['TipsTag']?></div>
                    <div class="recom">
                        <div class="good"><span class="ir">추천하기</span></div>
                        <div class="bad"><span class="ir">비추하기</span></div>
                    </div>


                    <div class="view__icon">
                        <div class="report">
                            <div class="rp"><span class="ir">신고하기</span></div>
                        </div>
                        <div class="sns">
                            <div class="youtube"><span class="ir">유튜브</span></div>
                            <div class="facebook"><span class="ir">페이스북</span></div>
                            <div class="twiter"><span class="ir">트위터</span></div>
                            <div class="kakaotalk"><span class="ir">카카오톡</span></div>
                            <div class="instar"><span class="ir">인스타</span></div>
                        </div>
                    </div>
                </div>

<?php }else {
    echo "IF문 출력 오류. 확인 요망";
} ?>
            </div>
        </section>
        <!-- //view -->

        <section id="comment">
            <div class="comment__inner container">
                <h3>댓글 3</h3>
                <article class="comment__view">
                    <div class="comment__wrap">
                        <div class="comment__title clearfix">
                            <h4>잡스비네이터</h4>
                            <span class="date">2019-02-04 13:21:23</span>
                        </div>
    
                        <div class="comment__desc">
                            어쩌고 저쩌고 도음이 하나도 안되요 신고할게요!
                        </div>
                    </div>
                    <!-- commnet1 -->

                    <div class="comment__wrap">
                        <div class="comment__title clearfix">
                            <h4>잡스비네이터</h4>
                            <span class="date">2019-02-04 13:21:23</span>
                        </div>
    
                        <div class="comment__desc">
                            어쩌고 저쩌고 도음이 하나도 안되요 신고할게요!
                        </div>
                    </div>
                    <!-- commnet2 -->

                    <div class="comment__wrap">
                        <div class="comment__title clearfix">
                            <h4>잡스비네이터</h4>
                            <span class="date">2019-02-04 13:21:23</span>
                        </div>
    
                        <div class="comment__desc">
                            어쩌고 저쩌고 도음이 하나도 안되요 신고할게요!
                        </div>
                    </div>
                    <!-- commnet3 -->

                    <div class="comment__box">
                        <form action="" method="post">
                            <fieldset class="clearfix">
                                <legend class="blind">댓글 작성 폼</legend>
                                <div>
                                    <label for="comment" class="blind">댓글</label>
                                    <textarea name="comment" id="comment" rows="5"
                                        placeholder="여러분들의 댓글을 입력하세요.. 악플은 NO"></textarea>
                                </div>
                                <button type="submit">댓글 작성하기</button>
                            </fieldset>
                        </form>
                    </div>
                </article>
                <!-- //commnet01 -->
            </div>
        </section>
        <!-- //comment -->

        <div class="comment__btn container">
<?php
    $prevPage = $myTipsID - 1;
    $nextPage = $myTipsID + 1;

    if($prevPage == 0){
        echo "<div class='noPrev'>No Prev</div>";
        $prevPage = 1;
    }
    $sql = "SELECT myTipsID FROM myTips";
    $CountSql = $connect -> query($sql);
    $count = $CountSql -> num_rows;
    if($nextPage > $count){
        echo "<div class='noNext'>No Next</div>";
        $prevPage = $count;

    }

    echo "<div class='prev__wrap'><a href='small_cg_detail.php?myTipsID={$prevPage}' class='prev'><span class='ir'>이전</span></a></div>";
    echo "<div class='list__wrap'><a href='small_cg.php?page=1' class='list'><span class='ir'>목록</span></a></div>";
    echo "<div class='next__wrap'><a href='small_cg_detail.php?myTipsID={$nextPage}' class='next'><span class='ir'>다음</span></a></div>";
?>
            <!-- <div class="prev__wrap"><a href="#" class="prev"><span class="ir">이전</span></a></div>
            <div class="list__wrap"><a href="small_cg.php?page=1" class="list"><span class="ir">목록</span></a></div>
            <div class="next__wrap"><a href="#" class="next"><span class="ir">다음</span></a></div> -->
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

<script>
    // 좋아요 눌렀을 때
    const goodBtn = document.querySelector(".recom .good");
    goodBtn.addEventListener("click",(e)=>{
        e.target.classList.add("clickedGood");
        e.preventDefault();

    });

    <?php
        $TipsHateCount = $Tips['TipsHate'];
        if($TipsHateCount >= 1){
            
        }else{
            $TipsHateCount = 0;
        };
        
    ?>

    // 싫어요 눌렀을 때
    const badBtn = document.querySelector(".recom .bad");
    console.log(badBtn)
    badBtn.addEventListener("click",(e)=>{
        let TipsHateCount = <?php echo $TipsHateCount;?>;
        console.log(TipsHateCount)
        if(TipsHateCount == 0){
            TipsHateCount++;
        } else{
            TipsHateCount++
        };
        e.target.classList.add("clickedBad");
        e.preventDefault();
    
    });


</script>


</html>