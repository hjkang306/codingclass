<?php
    header('Access-Control-Allow-Origin: *');
    include "../connect/connect.php";
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QnA 페이지</title>
    <link rel="stylesheet" href="../../html/asset/css/style.css">
    <link rel="stylesheet" href="../../html/asset/css/QnA.css">
</head>

<body>
    <?php
        include "../include/header.php";
    ?>

    <main id="main" class="QnA">
        <div class="subMenu">
            <h2>QnA</h2>
            <hr>
            <nav>
                <ul>
                    <li><a href="http://bb020440.dothome.co.kr/php/Notice/QnACate01.php">분류1</a></li>
                    <li><a href="http://bb020440.dothome.co.kr/php/Notice/QnACate02.php">분류2</a></li>
                    <li class="active"><a href="http://bb020440.dothome.co.kr/php/Notice/QnACate03.php">분류3</a></li>
                    <hr>
                    <li><a href="http://bb020440.dothome.co.kr/php/Notice/QnACate04.php">분류4</a></li>
                    <li><a href="http://bb020440.dothome.co.kr/php/Notice/QnACate05.php">분류5</a></li>
                    <li><a href="http://bb020440.dothome.co.kr/php/Notice/QnACate06.php">분류6</a></li>
                </ul>
            </nav>
        </div>

        <section id="QnA__wrap">
            <div class="QnA__inner container">
                <div class="QnA__tab">
                    <h3 class="AnswerPlus active">추가 답변하기</h3>
                    <h3 class="AnswerFast">빠른 답변하기</h3>
                    <a class="QnA__ask" href="#">나도 질문하기</a>
                </div>
                <!-- // 상단 메뉴 -->
                    <?php
                        if(isset($_GET['page'])){
                            $page = (int)$_GET['page'];
                        } else {
                            $page = 1;
                        }
                        $viewNum = 4;
                        $viewLimit = ($viewNum * $page) - $viewNum;

                        $sql = "SELECT * FROM myQnA WHERE QnACategory=3 ORDER BY myQnAID ASC LIMIT {$viewLimit}, {$viewNum}";
                        $result = $connect -> query($sql);
                        if($result) {
                            $count = $result -> num_rows;
                            if($count > 0){
                                for($i = 1; $i <= $count; $i++) {
                                    $info = $result -> fetch_array(MYSQLI_ASSOC);
                                    $QnAID = $info['myQnAID'];
                                    $QnATitle = $info['QnATitle'];
                                    $QnAChoice = $info['QnAChoice'];
                                    $QnAAnswer = $info['QnAAnswer'];
                                    $QnAStar = $info['QnAStar'];
                                    $QnAGood = $info['QnAGood'];
                                    $QnAVeiw = $info['QnAVeiw'];
                                    $QnAregTime = $info['regTime'];
                                    
                                    $second_sql = "SELECT r.youName,r.myReplyID,r.QnAReply, r.regTime FROM myReply r JOIN myQnA q ON (r.myQnAID = q.myQnAID) WHERE r.myQnAID = $QnAID ORDER BY r.regTime DESC;";
                                    $second_result = $connect -> query($second_sql);

                                    echo "<article class='cont'>";
                                    echo "<div class='accept'>$QnAChoice</div>";
                                    echo "<h4 class='QnA__title'><a href='#'>$QnATitle</a></h4>";
                                    echo "<div class='icon'>
                                            <a href='#' class='AnserNum'>$QnAAnswer</span></a>
                                            <a href='#' class='star active'>$QnAStar</span></a>
                                            <a href='#' class='like active'>$QnAGood</a>
                                        </div>";
                                    echo "<div class='QnA__date'>".date('Y-m-d', $QnAregTime)."</div>";
                                    
                                    echo "<div class='cont__wrap'>";

                                    foreach($second_result as $reply) {
                    ?>
                                    <div class='QnA__cont'>
                                        <div class='reply'><span>'<?=$reply['youName']?>'의 답변</span></div>
                                        <div><?=$reply['QnAReply']?></div>
                                    </div>
                    <?php
                                    }
                                    echo "</article>";
                            } 
                    ?>
                                        
                    <?php
                        }
                                echo "</div>";
                            } 
                            else {
                                echo "<div class='issue__title'>게시글 오류입니다. 관리자에게 문의하세요!</div>";
                            }
                    ?>
                    <!-- <div class="accept">10</div>
                    <h4 class="QnA__title"><a href="#">스미싱 당한것 같은데 신고해야 되나요?</a></h4>
                    <div class="icon">
                        <a href="#" class="AnserNum">2</span></a>
                        <a href="#" class="star active">1</span></a>
                        <a href="#" class="like active">1</a>
                    </div>
                    <div class="QnA__date">2019-02-04</div> -->
                    <!-- // 보이는 영역 -->
                    
                    <!-- <div class="QnA__cont">
                        <div class="reply"><span>김치만두의 답변</span></div>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat nemo animi asperiores sequi amet provident nesciunt magnam consequatur obcaecati inventore accusamus consequuntur similique rem in at, quos accusantium. Aut recusandae perspiciatis ipsum, fuga nihil voluptatem. Illo necessitatibus eum consequatur reprehenderit dolores, temporibus dicta praesentium possimus est? Nam debitis velit commodi minus est, nobis ducimus libero pariatur officia facere ullam fuga voluptas ratione sint quis sequi eligendi iste dolore ex modi corrupti sapiente praesentium eius! Suscipit amet facere voluptates ratione commodi quasi quidem, culpa, pariatur nesciunt nobis praesentium laboriosam eaque, beatae laborum ex perspiciatis tenetur repudiandae libero porro inventore aut iusto odio illo? Libero eaque quam eos provident optio officia repellat et, exercitationem maiores quasi aperiam, voluptatum eligendi odit impedit debitis nam, fugit eveniet. Facilis atque amet asperiores blanditiis recusandae, magnam, incidunt totam obcaecati voluptatum quidem nam quaerat aliquid reprehenderit beatae nesciunt cumque, porro cupiditate expedita assumenda? Ipsum blanditiis tenetur sit voluptatem obcaecati eius, delectus recusandae numquam architecto distinctio ea molestias est perferendis cum officiis laudantium. Architecto voluptatum cupiditate ut asperiores cum at, hic tempore sunt rem fugiat voluptates illo necessitatibus quod quaerat doloribus non sapiente laudantium ea aperiam obcaecati eos quidem? Maxime molestiae repellendus numquam suscipit sunt soluta. Possimus, inventore.
                    </div>   -->
                    <!-- // 나올 영역 -->
                </article>
                <!-- //cont1 -->
            </div>
            <div class="qna__page">
                <ul>
            <?php
                $sql = "SELECT count(myQnAID) FROM myQnA WHERE QnACategory=3;";
                $result = $connect -> query($sql);
                $boardCount = $result -> fetch_array(MYSQLI_ASSOC);
                $boardCount = $boardCount['count(myQnAID)'];
                
                // 총 페이지 개수
                $boardCount = ceil($boardCount/$viewNum);

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
                    echo "<li><a href='QnACate01.php?page=1' class='firstPage'></a></li>";
                    echo "<li><a href='QnACate01.php?page={$prevPage}' class='prev'></a></li>";
                }
                
                // 페이지 넘버 표시
                for($i=$startPage; $i<=$endPage; $i++){
                    $active = "";
                    if($i == $page) $active = "active";
                    echo "<li class='{$active}'><a href='QnACate01.php?page={$i}'>{$i}</a></li>";
                }
                
                // 다음 페이지, 마지막 페이지                                                                                                                           
                if($page != $endPage){
                    $nextPage = $page + 1;
                    echo "<li><a href='QnACate01.php?page={$nextPage}' class='next'></a></li>";
                    echo "<li><a href='QnACate01.php?page={$boardCount}' class='endPage'></a></li>";
                }
            ?>
                </ul>
            </div>
        </section>
        <!-- //QnA -->

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

    <script>
        const title = document.querySelectorAll('.QnA__title a');
        const cont = document.querySelectorAll('.cont__wrap');

        title.forEach((a, index) => {
            a.addEventListener('click', (e) => {
                e.preventDefault();
                cont[index].classList.toggle('show');
            });
        });
    </script>
</body>

</html>