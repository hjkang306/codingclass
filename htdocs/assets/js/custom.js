const loginBtn = document.querySelector(".loginBtn");
const popup = document.querySelector(".login__popup");
const close = document.querySelector(".login__footer .btn-close");

loginBtn.addEventListener("click", ()=>{
    popup.classList.add("open");
});
close.addEventListener("click", ()=>{
    popup.classList.remove("open");
});