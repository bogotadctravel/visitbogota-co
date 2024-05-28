$(document).ready(function () {
  if (document.querySelector("#characters_gallery")) {
    $("#characters_gallery").slick({
      dots: true,
      arrows: true,
      nextArrow:
        '<button type="button" class="slick-next"><img src="img/rld/nextarrow.svg"></button>',
      prevArrow:
        '<button type="button" class="slick-prev"><img src="img/rld/prevarrow.svg"></button>',
    });
  }
  if (document.querySelector("#characters_gallery_2")) {
    $("#characters_gallery_2").slick({
      dots: true,
      arrows: true,
      nextArrow:
        '<button type="button" class="slick-next"><img src="img/rld/nextarrow.svg"></button>',
      prevArrow:
        '<button type="button" class="slick-prev"><img src="img/rld/prevarrow.svg"></button>',
    });
  }
});

function box(position, route) {
  $.fancybox.open({
    src:
      "b/rld_location/?i=" + position + "&row=" + route + "&lang=" + actualLang,
    type: "ajax",
    touch: false,
  });
}
