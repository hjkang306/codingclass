<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QnA 작성하기</title>
    <link rel="stylesheet" href="../../html/asset/css/style.css">

    <?php 
        include "../include/link.php";
    ?>
</head>
<body>
    <?php
        include "../include/header.php";
    ?>

    <main id="main">
        <section id="boardWrite" class="container">
            <h2>질문 작성하기</h2>
            <div class="boardWrite_Wrap">
                <form action="QnAWriteSave.php" method="post">
                    <fieldset>
                        <legend class="blind">질문 작성하기</legend>
                        <div>
                            <select name="searchOption1" id="searchOption1">
                                <option value="건강">건강</option>
                                <option value="전자기기">전자 기기</option>
                                <option value="청소">청소</option>
                                <option value="취미">취미</option>
                                <option value="라이프 스타일">라이프 스타일</option>
                                <option value="건강2">건강2</option>
                            </select>
                        </div>
                        <div>
                            <label for="QnAWriteHeader">제목</label>
                            <input type="text" name="QnAWriteHeader" id="QnAWriteHeader" placeholder="제목을 입력하세요" required>
                        </div>
                        <div>
                            <label for="QnAWriteDesc">본문</label>
                            <textarea name="QnAWriteDesc" id="QnAWriteDesc"></textarea>
                        </div>
                        <div class="TagWrap">
                            <label for="QnAWriteTag" class="blind">#태그</label>
                            <input class="boardWriteTag" type="text" name="QnAWriteTag" id="QnAWriteTag" placeholder="태그는 #으로 시작해서 최대 3개까지 작성해주세요. (#잡스비 #멋저요)" required>
                        </div>
                        <div class="Writebtn">
                            <button type="submit" class="btn1">작성</button>
                            <a href="http://bb020440.dothome.co.kr/php/Notice/QnACate.php?category=%EA%B1%B4%EA%B0%95" class="btn2">취소</a>
                        </div>
                    </fieldset>
                </form>
            </div>
        </section>
    </main>
    
    <?php
        include "../include/footer.php";
    ?>
</body>
</html>