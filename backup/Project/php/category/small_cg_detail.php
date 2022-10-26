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

    // 댓글
    $myMemberID = $_SESSION['myMemberID'];
    $youID = $_SESSION['youID'];
    $myTipsID = $_GET['myTipsID'];
    // echo $myMemberID;

    $commentSql = "SELECT * FROM myComment WHERE myTipsID = {$myTipsID} ORDER BY myCommentID DESC";
    $commentResult = $connect -> query($commentSql);
    $commentInfo = $commentResult -> fetch_array(MYSQLI_ASSOC);
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
                    <h2 class="main__title"><?=$categoryBig?></h2>
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
                    <li><a data-name="핸드폰" href="http://hjkang306.dothome.co.kr/php/category/small_cg.php?categoryBig=<?=$categoryBig?>&categorySmall=핸드폰">핸드폰</a></li>
                    <li><a data-name="컴퓨터" href="http://hjkang306.dothome.co.kr/php/category/small_cg.php?categoryBig=<?=$categoryBig?>&categorySmall=컴퓨터">컴퓨터</a></li>
                    <li><a data-name="아이디어" href="http://hjkang306.dothome.co.kr/php/category/small_cg.php?categoryBig=<?=$categoryBig?>&categorySmall=아이디어">아이디어</a></li>
                    <li><a data-name="관리" href="http://hjkang306.dothome.co.kr/php/category/small_cg.php?categoryBig=<?=$categoryBig?>&categorySmall=관리">관리</a></li>
                </ul>
            </nav>
            <script>
    const subTitList = document.querySelectorAll("#subTitle li");
    const subTitListA = document.querySelectorAll("#subTitle li a");

    subTitListA.forEach((e, i)=>{
        if(e.dataset.name =="<?php echo $categorySmall;?>"){
            subTitList[i].classList.add("active")
        }else{
            subTitList[i].classList.remove("active")
        }
    })


    
</script>

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
                <h3>댓글</h3>
                <article class="comment__view">
            <?php
                foreach($commentResult as $comment){ ?>
                    <div class="comment__wrap" id="Comment<?=$comment['myCommentID']?>">
                        <div class="comment__view__box">
                            <!-- <div class="comment__view__img">
                                <img src="../assets/img/icon_256.png" alt="dd">
                            </div> -->
                            <div class="comment__title clearfix">
                                <h4 class="name"><?=$comment['commentName']?></h4>
                                <span class="date"><?=date('Y-m-d', $comment['regTime'])?></span>
                            </div>
                            <div class="comment__desc">
                                <?=$comment['commentMsg']?>    
                            </div>
                        </div>

                        <div class="comment__del clearfix">
                            <a href="#" class="comment__del__del">삭제</a>
                            <a href="#" class="comment__del__mod">수정</a>
                        </div>
                    </div>
            <?php } ?>
                    <!-- <div class="comment__wrap">
                        <div class="comment__title clearfix">
                            <h4>잡스비네이터</h4>
                            <span class="date">2019-02-04 13:21:23</span>
                        </div>
    
                        <div class="comment__desc">
                            어쩌고 저쩌고 도음이 하나도 안되요 신고할게요!
                        </div>
                    </div> -->
                    <!-- commnet1 -->

                    <!-- 댓글 수정/삭제 버튼 -->
                    <div class="comment__delete" style="display: none">
                        <label for="commentDeletePass" class="blind">비밀번호</label>
                        <input type="text" id="commentDeletePass" name="commentDeletePass" placeholder="삭제하려면 비밀번호를 입력해 주세요.">
                        <button id="commentDeleteCancel">취소</button>
                        <button id="commentDeleteButton">삭제</button>
                    </div>
                    <div class="comment__modify" style="display: none">
                        <label for="commentModify">수정 내용</label>
                        <input type="text" id="commentModify" name="commentModify">
                        <label for="commentModifyPass" class="blind">비밀번호</label>
                        <input type="text" id="commentModifyPass" name="commentModifyPass" placeholder="수정하려면 비밀번호를 입력해 주세요.">
                        <button id="commentModifyCancel">취소</button>
                        <button id="commentModifyButton">수정</button>
                    </div>

                    <!-- 댓글 작성 폼 -->
                    <!-- <div class="comment__write">
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
                    </div> -->
                    <div class="comment__write">
                        <div class="comment__write__msg">
                            <label for="commentWrite" class="blind">댓글 작성하기</label>
                            <textarea id="commentWrite" name="commentWrite" rows="5" placeholder="여러분들의 댓글을 입력하세요.. 악플은 NO"></textarea>
                        </div>
                        <div class="comment__write__info">
                            <label for="commentName" class="blind">이름</label>
                            <input type="hidden" id="commentName" name="commentName" placeholder="이름" value="<?= $youID?>">
                            <label for="commentPass" class="blind">비밀번호</label>
                            <input type="text" id="commentPass" name="commentPass" placeholder="비밀번호 입력">
                            <button type="submit" id="commentBtn">댓글 작성하기</button>
                        </div>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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

<!-- 댓글 스크립트 -->
<script>

    const commentName = $("#commentName");    // 댓글 이름
    const commentPass = $("#commentPass");    // 댓글 비밀번호
    const commentWrite = $("#commentWrite");  // 댓글 내용
    const commentModify = $("#commentModify");  // 댓글 수정 내용


    let commentID = "";


    // 댓글 삭제 버튼 클릭시
    $(".comment__del__del").click(function(e){
        e.preventDefault();
        // alert("댓글 삭제 버튼 클릭시");
        $(".comment__delete").show();
        
        // 클릭한 ID값 가져오기
        commentID = $(this).parent().parent().attr('id');
    })
    // 댓글 삭제 버튼 --> 취소 버튼 클릭
    $("#commentDeleteCancel").click(function(){
        $(".comment__delete").hide();
    })

    console.log(commentID)
    // 댓글 삭제 버튼 --> 삭제 버튼 클릭
    $("#commentDeleteButton").click(function(){

        let number = commentID.replace(/[^0-9]/g, "");

        if($("#commentDeletePass").val() == ''){
            alert("댓글 작성시의 비밀번호를 적어주세요!");
            $("#commentDeletePass").focus();
        } else {
            $.ajax({
                url: "tipsCommentDelete.php",
                method: "POST",
                dataType: "json",
                data: {
                    "myMemberID": <?=$myMemberID?>,
                    "pass": $("#commentDeletePass").val(),
                    "commentID": number
                },
                success: function(data){
                    console.log(data);
                    location.reload();              //데이터 받아오고 깜빡이면서 바로 받기
                },
                error: function(request, status, error){
                    console.log("request" + request);
                    console.log("status" + status);
                    console.log("error" + error);
                }
            })
        }

    })

    // 댓글 수정 버튼 클릭시
    $(".comment__del__mod").click(function(e){
        e.preventDefault();
        
        $(".comment__modify").show();
        
        commentID = $(this).parent().parent().attr('id');

        // 수정칸에 이전댓글 불러오고 싶었는데 실패
        // commentModMsg = $(this).parent(`#${commentID}`).children(".comment__desc").text();
        // console.log(commentModMsg);
        // commentModify.val(commentModMsg);
    })

    // 댓글 수정 버튼 --> 취소 버튼 클릭
    $("#commentModifyCancel").click(function(){
        $(".comment__modify").hide();
    })

    // 댓글 수정 버튼 --> 수정 버튼 클릭
    $("#commentModifyButton").click(function(){

        let number = commentID.replace(/[^0-9]/g, "");

        if($("#commentModify").val() == '' || $("#commentModifyPass").val() == ''){
            alert("수정 내용 및 비밀번호를 입력해주세요!");
            $("#commentModifyPass").focus();
        } else {
            $.ajax({
                url: "tipsCommentModify.php",
                method: "POST",
                dataType: "json",
                data: {
                    "pass": $("#commentModifyPass").val(),
                    "commentID": number,
                    "commentmsg": $("#commentModify").val()
                },
                success: function(data){
                    console.log(data);
                    location.reload();              //데이터 받아오고 깜빡이면서 바로 받기
                },
                error: function(request, status, error){
                    console.log("request" , request);
                    console.log("status" , status);
                    console.log("error" , error);
                }
            })
        }
    })

    // 댓글 쓰기 버튼
    $("#commentBtn").click(function(){
        if($("#commentWrite").val() == ""){
            alert("댓글을 작성해 주세요.");
            $("#commentWrite").focus();
        } else {
            $.ajax({
                url: "tipsCommentWrite.php",
                method: "POST",
                dataType : "json",
                data: {
                    "myMemberID": <?=$myMemberID?>,
                    "myTipsID": <?=$myTipsID?>,
                    "name": commentName.val(),
                    "pass": commentPass.val(),
                    "msg": commentWrite.val()
                },
                success: function(data){
                    console.log(data);
                    location.reload();              //데이터 받아오고 깜빡이면서 바로 받기
                },
                error: function(request, status, error){
                    console.log("request" + request);
                    console.log("status" + status);
                    console.log("error" + error);
                }
            })
        }
    })
</script>


</html>