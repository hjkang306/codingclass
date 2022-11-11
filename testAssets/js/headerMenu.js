$(function () {
  //header menu--------------------------------------------------------
  $("header nav >ul").mouseenter(function () {
    $("ul.lv2").slideDown(500);
  });

  $("header nav >ul").mouseleave(function () {
    $("ul.lv2").stop().slideUp(500);
  });
});
