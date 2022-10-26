<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>

    <?php include "../include/link.php" ?>
</head>
<body>
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">컨텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>
    <!-- //skip -->

    <?php include "../include/header.php" ?>

    <main id="main">
        <section id="board" class="container">
            <h2>게시판 보기 영역입니다.</h2>
            <div class="board__inner">
                <div class="board__title">
                    <h3>게시판 보기</h3>
                    <p>웹디자이너, 웹퍼블리셔, 프론트앤드 개발자를 위한 게시판입니다.</p>
                </div>
                <div class="board__view">
                    <table>
                        <colgroup>
                            <col style="width: 20%">
                            <col style="width: 80%">
                        </colgroup>
                        <tbody>
<?php
    $myBoardID = $_GET['myBoardID'];
    
    //echo $myBoardID;
    // 조회수 + 1
    $sql = "UPDATE myBoard SET boardView = boardView +1 WHERE myBoardID = {$myBoardID}";
    $connect -> query($sql);
    
    $sql = "SELECT b.boardTitle, m.youName, b.regTime, b.boardView, b.boardContents FROM myBoard b JOIN myMember m ON(m.myMemberID = b.myMemberID) WHERE b.myBoardID = $myBoardID";
    $result = $connect -> query($sql);
    
    if($result){
        $info = $result -> fetch_array(MYSQLI_ASSOC);

        // echo "<pre>";
        // var_dump($info);
        // echo "</pre>";

        echo "<tr><th>제목</th><td>".$info['boardTitle']."</td></tr>";
        echo "<tr><th>등록자</th><td>".$info['youName']."</td></tr>";
        echo "<tr><th>등록일</th><td>".date('Y-m-d H:i', $info['regTime'])."</td></tr>";
        echo "<tr><th>조회수</th><td>".$info['boardView']."</td></tr>";
        echo "<tr><th>내용</th><td class='height'>".$info['boardContents']."</td></tr>";
    };
?>
                            <!-- <tr>
                                <th>제목</th>
                                <td>치안정책리뷰 제75호</td>
                            </tr>
                            <tr>
                                <th>등록자</th>
                                <td>경찰대학 치안정책연구소 치안정책연구부</td>
                            </tr>
                            <tr>
                                <th>등록일</th>
                                <td>2022.09.02</td>
                            </tr>
                            <tr>
                                <th>조회수</th>
                                <td>466</td>
                            </tr>
                            <tr>
                                <th>내용</th>
                                <td class="height">
                                    경찰대학 치안정책연구소에서는 치안정책리뷰 제75호를 발간하였습니다.<br>
                                    이번 호에는 아래와 같은 내용이 있습니다.<br><br>
                                    
                                    ★ 치안정책리뷰 제75호 ★<br>
                                    <특집 : 경찰의 불송치 결정의 제문제><br><br>
                                    
                                    1. 권 두 언<br>
                                    ○ 개정 형사소송법상 경찰의 불송치결정의 법적 성격<br>
                                        (경성대학교 경찰행정학과 김현철 초빙교수(변호사))<br><br>
                                    
                                    2. 전문가 제언<br>
                                    ○ 수사상 경찰의 불송치 결정에 대한 절차적 통제방안의 적정성 검토<br>
                                        (전남대학교 해양경찰학과 이기수 교수)<br>
                                    ○ 수사권 개혁법 시행 2년에 즈음하여 사법경찰관의 결정에 대한 규율을 진단하다<br>
                                        (충남경찰청 천안서북경찰서 이형근 수사심사관)<br><br>
                                    
                                    3. 해외 법제 동향<br>
                                    ○ 영국 경찰의 사건종결처분<br>
                                        (아주대학교 인권센터 양승국 전문위원)<br><br>
                                    
                                    4. 현장 인터뷰<br>
                                    ○ 대구형 스마트 셉테드(CPTED) 플랫폼 구축<br>
                                        - 스마트 치안 구현으로 지역문제 해결 -<br>
                                        (대구광역시 자치경찰위원회 자치경찰정책과 정책TF팀 유영우 경사)<br>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
                <div class="board__btn">
                    <a href="boardModify.php?myBoardID=<?=$myBoardID?>">수정하기</a>
                    <a href="boardRemove.php?myBoardID=<?=$myBoardID?>" onclick="alert('정말 삭제하시겠습니까?')">삭제하기</a>
                    <a href="board.php">목록보기</a>
                </div>
            </div>
        </section>
        <!-- //board -->

    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- footer -->
</body>
</html>