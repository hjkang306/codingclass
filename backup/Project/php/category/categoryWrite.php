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
    <title>꿀팁 작성하기</title>
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
            <h2>나의 꿀팁 작성하기</h2>
            <div class="boardWrite_Wrap">
                <form action="./categoryWriteSave.php" method="post">
                    <fieldset>
                        <legend class="blind">대분류 / 소분류 카테고리 선택하기</legend>
                        <div>
                            <select name="searchOption1" id="searchOption1" onchange="categoryChage(this)">
                                <option>대분류 선택</option>
                                <option value="건강">건강</option>
                                <option value="전자기기">전자 기기</option>
                                <option value="청소">청소</option>
                                <option value="취미">취미</option>
                                <option value="라이프스타일">라이프 스타일</option>
                            </select>
                            <select name="searchOption2" id="searchOption2">
                                <option>소분류 선택</option>
                                <!-- <option value="핸드폰">핸드폰</option>
                                <option value="컴퓨터">컴퓨터</option>
                                <option value="아이디어">아이디어</option>
                                <option value="관리">관리</option> -->
                            </select>
                        </div>
                        <div>
                            <label for="boardWriteHeader">제목</label>
                            <input type="text" name="boardWriteHeader" id="boardWriteHeader" placeholder="제목을 입력하세요" required>
                        </div>
                        <div>
                            <label for="boardWriteDesc">본문</label>
                            <textarea name="boardWriteDesc" id="boardWriteDesc"></textarea>
                        </div>
                        <div class="TagWrap">
                            <label for="boardWriteTag" class="blind">#태그</label>
                            <input class="boardWriteTag" type="text" name="boardWriteTag" id="boardWriteTag" placeholder="#태그 (#으로 구분해주세요)" required>
                        </div>
                        <div class="Writebtn">
                            <button type="submit" class="btn1">작성</button>
                            <a href="../main/main.php" class="btn2">취소</a>
                        </div>
                    </fieldset>
                </form>
            </div>
        </section>
    </main>
    
    <?php
        include "../include/footer.php";
    ?>
    
    <script>
        //옵션 바꾸기
        function categoryChage(e) {
            const health = ["건강", "민간요법", "약"];
            const electronics = ["수리", "중고", "관리", "분해"];
            const cleaning = ["실내", "실외", "세탁", "세차"];
            const hobby = ["운동", "등산", "뜨개질", "드로잉"];
            const lifeStyle = ["원예", "반려동물", "운세", "퀴즈"];
            const target = document.getElementById("searchOption2");
            let categoryBig = e.value;
            let categorySmall = '';

            switch(categoryBig) {
                case "건강" :
                    categorySmall = health;
                    break;
                case "전자기기" :
                    categorySmall = electronics;
                    break;
                case "청소" :
                    categorySmall = cleaning;
                    break;
                case "취미" :
                    categorySmall = hobby;
                    break;
                case "라이프스타일" :
                    categorySmall = lifeStyle;
                    break;
            };

            target.options.length = 0;

            for ( x in categorySmall ) {
                let option = document.createElement("option");
                option.value = categorySmall[x];
                option.innerHTML = categorySmall[x];
                target.appendChild(option);
            }
        }
    </script>
</body>
</html>
