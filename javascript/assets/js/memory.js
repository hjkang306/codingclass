// 01 HTML/CSS 디자인 구성
// 02 클릭한카드 뒤집기
// 03 두개의 카드 뒤집고 확인하기(첫번째카드, 두번째카드)

const memoryWrap = document.querySelector(".memory__wrap");
const memoryCards = document.querySelectorAll(".cards li");

let cardOne, cardTwo;
let disableDeck = false;
let matchedCard = 0;

let sound = [
    "../assets/audio/match2.mp3",
    "../assets/audio/match.mp3",
    "../assets/audio/up.mp3"
];
let soundMatch = new Audio(sound[0]);
let soundUnMatch = new Audio(sound[1]);
let soundSuccess = new Audio(sound[2]);

// 카드 뒤집기
function flipCard(e) {
    let clickedCard = e.target;
    
    // if(!cardTwo){
    //     cardOne = NULL;
    //     cardTwo = NULL;
    // }
    if(clickedCard !== cardOne && !disableDeck){
        clickedCard.classList.add("flip");
        
        if (!cardOne) {
            return cardOne = clickedCard;
        }
        cardTwo = clickedCard;
        disableDeck = true;
        
        // 카드정보 가져오기
        let cardOneImg = cardOne.querySelector(".back img").src;
        let cardTwoImg = cardTwo.querySelector(".back img").src;
        
        matchcards(cardOneImg, cardTwoImg);
    }
}
// 카드 확인(두개의 이미지 비교)
function matchcards(img1, img2) {
    if(img1 == img2){
        // 같을 경우
        matchedCard++

        if(matchedCard == 8){
            alert("게임 승리!");
            soundSuccess.play();
        }
        cardOne.removeEventListener("click", flipCard);
        cardTwo.removeEventListener("click", flipCard);
        cardOne = cardTwo = "";
        disableDeck = false;
        soundMatch.play();
    } else {
        // 일치하지 않으면 틀린음악 + 이미지 쉐이크
        setTimeout(()=>{
            cardOne.classList.add("shakeX");
            cardTwo.classList.add("shakeX");
        },500);

        setTimeout(()=>{
            cardOne.classList.remove("shakeX", "flip");
            cardTwo.classList.remove("shakeX", "flip");
            cardOne = cardTwo = "";
            disableDeck = false;
        }, 1600);
        soundUnMatch.play();
    }
}

// 카드 섞기
function shuffledCard() {
    cardOne = cardTwo = "";
    disableDeck = false;
    matchedCard = 0;

    let arr = [1,2,3,4,5,6,7,8,1,2,3,4,5,6,7,8];
    let result = arr.sort(() => Math.random() > 0.5 ? 1 : -1);

    memoryCards.forEach((card, index) =>{
        card.classList.remove("flip");

        setTimeout(()=>{
            card.classList.add("flip");
        }, 200 * index);

        setTimeout(()=>{
            card.classList.remove("flip");
        }, 4000);

        let imgTag = card.querySelector(".back img");
        imgTag.src = `../assets/img/memory_img0${arr[index]+1}.svg`;
    });
}

shuffledCard();

// 카드 클릭
memoryCards.forEach((card) => {
  card.addEventListener("click", flipCard);
});
