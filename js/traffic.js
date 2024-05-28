var moving = new Array();

$(document).ready(function () {
  if (document.querySelector("#street")) {
    $("#street div span").css("top", "-1000px");
    traffic(randomC(1, 3));
    traffic(randomC(4, 6));
  }
});

function traffic(lane) {
  var theindex = moving.indexOf(lane);
  if (theindex == -1) {
    var tcolors = [
      "img/car1.svg",
      "img/car2.svg",
      "img/car3.svg",
      "img/car4.svg",
    ];
    console.log(lane);
    var heightVH = $(window).height();
    var element = $("#c-" + lane + " span");
    if (lane == 2 || lane == 5) {
      element.css("background-image", `url(${tcolors[randomC(0, 3)]})`);
    }

    if (lane < 4) {
      element.css("top", element.height() * -1);
      element.animate({ top: heightVH }, 2000);
    } else {
      element.css("top", heightVH);
      element.animate({ top: element.height() * -1 }, 2000);
    }
    moving.push(lane);
  } else {
    moving.splice(theindex, 1);
  }

  setTimeout(traffic, randomC(600, 2000), randomC(1, 6));
}
function randomC(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}
