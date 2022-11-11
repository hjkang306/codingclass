const slider = document.querySelector(".slider");
let index = 0;

setInterval(() => {
  index == 2 ? (index = 0) : index++;
  slider.style.top = index * -500 + "px";
}, 2000);

const tit1 = document.querySelector(".tit1");
const tit2 = document.querySelector(".tit2");
const notice = document.querySelector(".notice");
const gallary = document.querySelector(".gallary");

tit1.addEventListener("click", () => {
  tit1.classList.add("active");
  tit2.classList.remove("active");
  notice.classList.add("active");
  gallary.classList.remove("active");
});
tit2.addEventListener("click", () => {
  tit2.classList.add("active");
  tit1.classList.remove("active");
  gallary.classList.add("active");
  notice.classList.remove("active");
});
document.querySelector(".banner__wrap").addEventListener("click", () => {
  document.querySelector(".popup").classList.add("show");
});
document.querySelector(".popup .close span").addEventListener("click", () => {
  document.querySelector(".popup").classList.remove("show");
});
