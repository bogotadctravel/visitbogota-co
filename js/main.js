window.onload = function () {
  var widgetId1 = "";
  var ln = window.navigator.language || navigator.browserLanguage;
  var bogotaApp = {};

  /**
   * Gets cookie value by name
   * @param  {string} name Name of cookie to retrieve
   * @return {string}      Value of cookie if found
   */
  bogotaApp.ReadCookie = function (name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(";");
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == " ") c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  };

  /**
   * Removes cookie value
   * @param  {string} name Name of cookie
   */
  bogotaApp.EraseCookie = function (name) {
    if (bogotaApp.ReadCookie(name)) document.cookie = name + "=";
  };

  /**
   * Deletes cookie reference
   * @param  {string} name Name of cookie
   */
  bogotaApp.DeleteCookie = function (name) {
    document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
  };

  /**
   * Set cookie value
   * @param  {string} name Name of cookie
   */
  bogotaApp.SetCookie = function (name, value, expires) {
    var cookiestring = [[name, "=", encodeURIComponent(value)].join("")];
    var expire_time = "";

    if (expires) {
      expire_time = new Date();
      expire_time.setTime(expire_time.getTime() + expires);
      expire_time = expire_time.toGMTString();
      cookiestring.push(["expires=", expire_time].join(""));
    }
    cookiestring = cookiestring.join(";") + ";";
    document.cookie = cookiestring;
  };

  if (bogotaApp.ReadCookie("lang_redirect")) {
    return;
  }

  bogotaApp.SetCookie("lang_redirect", ln);

  // if (ln.substring(0, 2) == "en") {
  //   if (location.href === "https://files.visitbogota.co/") {
  //     location.href = `https://files.visitbogota.co/${newLang}`;
  //   } else {
  //     location.href = location.href.replace(`/${actualLang}`, `/${newLang}`);
  //   }
  // } else if (ln.substring(0, 2) == "es") {
  //   if (location.href === "https://files.visitbogota.co/") {
  //     location.href = `https://files.visitbogota.co/${newLang}`;
  //   } else {
  //     location.href = location.href.replace(`/${actualLang}`, `/${newLang}`);
  //   }
  // } else if (ln.substring(0, 2) == "pt") {
  //   if (location.href === "https://files.visitbogota.co/") {
  //     location.href = `https://files.visitbogota.co/${newLang}`;
  //   } else {
  //     location.href = location.href.replace(`/${actualLang}`, `/${newLang}`);
  //   }
  // } else {
  //   if (location.href === "https://files.visitbogota.co/") {
  //     location.href = `https://files.visitbogota.co/en`;
  //   } else {
  //     location.href = location.href.replace(`/${actualLang}`, `/en`);
  //   }
  // }
};
const getBogotaData = async (containerId, data) => {
  const bogotaContainer = document.querySelector(`#${containerId} ul`);
  bogotaContainer.innerHTML = "";
  const promises = data.map(async (item) => {
    let urlImg;

    if (item.field_format_img) {
      urlImg = await getImageFromCacheOrFetch(
        "https://files.visitbogota.co" + item.field_format_img
      );
    } else if (item.field_banner_prod) {
      urlImg = await getImageFromCacheOrFetch(
        "https://files.visitbogota.co" + item.field_banner_prod
      );
    }

    // Si ninguna imagen fue encontrada, usar una imagen por defecto.
    urlImg = urlImg || "https://placehold.co/400x400.jpg?text=visitbogota";
    let urlSite = `/${actualLang}/explora/${get_alias(item.name)}/${item.tid}`;
    let template = `
      <li class="splide__slide">
        <a href="${urlSite}">
          <img loading="lazy" data-src="${urlImg}" alt="${item.name}" class="zone_img lazyload" src="https://placehold.co/400x400.jpg?text=visitbogota">
          <span>${item.name}</span>
        </a>
      </li>`;
    if (item.field_categor == "1") {
      bogotaContainer.innerHTML += template;
    }
  });

  await Promise.all(promises);

  new Splide(`#${containerId}`, {
    perPage: 5,
    gap: 0,
    type: "loop",
    pagination: false,
    lazyLoad: "nearby",
    breakpoints: {
      768: {
        perPage: 1,
      },
    },
  }).mount();

  lazyImages();
};
const getExploraBogota = async () => {
  const bogotaContainerFooter = document.querySelector(`#footerDescubre ul`);
  const bogotaContainerMenuMobile = document.querySelector(`.explora`);
  const response = await fetch(`/g/getMenuCategories/?lang=${actualLang}`);
  const data = await response.json();
  let productos = data.map((prod) => ({
    id: prod.tid,
    title: prod.name,
    url: `/${actualLang}/explora/${get_alias(prod.name)}/${prod.tid}`,
    field_categor: prod.field_categor,
  }));

  bogotaContainerFooter.innerHTML = "";
  bogotaContainerMenuMobile.innerHTML = "";
  document.querySelector("nav li.explora ul").innerHTML = "";

  // Encuentra el producto con ID 216
  const index = productos.findIndex((producto) => producto.id == 216);
  if (index > -1) {
    // Extrae el producto con ID 216 y lo coloca al inicio
    const [productoEspecial] = productos.splice(index, 1);
    productos.unshift(productoEspecial);
  }

  productos.forEach((producto) => {
    if (producto.field_categor == "1") {
      document.querySelector(
        "nav li.explora ul"
      ).innerHTML += `<li><a href="${producto.url}" class="wait ms700">${producto.title}</a></li>`;
      bogotaContainerFooter.innerHTML += `<li><a href="${producto.url}" class="wait">${producto.title}</a></li>`;
      bogotaContainerMenuMobile.innerHTML += `<li><a href="${producto.url}" class="wait">${producto.title}</a></li>`;
      if (document.querySelector("#categorias_blog select")) {
        document.querySelector(
          "#categorias_blog select"
        ).innerHTML += `<option value="${producto.id}">${producto.title}</option>`;
      }
    }
  });

  if (document.querySelector("#bogota-natural")) {
    await getBogotaData("bogota-natural", data);
  }
};
const getAgendaEventos = async () => {
  const response = await fetch(`/g/getAgendaTax/?lang=${actualLang}`);
  const data = await response.json();
  let agendas = data.map((prod) => ({
    id: prod.tid,
    title: prod.name,
    url: `/${actualLang}/eventos/${get_alias(prod.name)}-${prod.tid}`,
  }));

  const eventosListItem = document.querySelector("li.eventosList");
  const subMenu = document.querySelector("nav li.eventosList ul");

  // Limpiar el contenido actual
  eventosListItem.innerHTML = "Eventos"; // Restaura el texto inicial
  subMenu.innerHTML = "";

  if (agendas.length === 1) {
    // Si solo hay un elemento, hacer que el <li> principal sea un enlace
    const singleAgenda = agendas[0];
    eventosListItem.innerHTML = `<a href="${singleAgenda.url}" class="wait ms700">Eventos</a>`;
  } else if (agendas.length > 1) {
    // Si hay más de un elemento, crear un submenú
    agendas.forEach((agenda) => {
      subMenu.innerHTML += `<li><a href="${agenda.url}" class="wait ms700">${agenda.title}</a></li>`;
    });
  }
};

// Función para manejar el desplazamiento suave cuando se carga la página
document.addEventListener("DOMContentLoaded", async function () {
  if (document.querySelector("nav li.explora")) {
    await getExploraBogota();
  }
  if (document.querySelector("nav li.eventosList")) {
    await getAgendaEventos();
  }
  if (window.location.hash) {
    // Obtén el ID del fragmento de la URL (el valor después de '#')
    var targetId = window.location.hash.substring(1);

    // Encuentra el elemento con el ID correspondiente
    var targetElement = document.getElementById(targetId);

    if (targetElement) {
      // Calcula la posición de desplazamiento hacia el elemento
      var offset = targetElement.offsetTop;

      // Realiza el desplazamiento suave
      window.scrollTo({
        top: offset - 250,
        behavior: "smooth",
      });
    }
  }
});
function number_format(number, decimals, dec_point, thousands_point) {
  if (number == null || !isFinite(number)) {
    throw new TypeError("number is not valid");
  }

  if (!decimals) {
    var len = number.toString().split(".").length;
    decimals = len > 1 ? len : 0;
  }

  if (!dec_point) {
    dec_point = ".";
  }

  if (!thousands_point) {
    thousands_point = ",";
  }

  number = parseFloat(number).toFixed(decimals);

  number = number.replace(".", dec_point);

  var splitNum = number.split(dec_point);
  splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
  number = splitNum.join(dec_point);

  return number;
}
const urlGlobal = "https://files.visitbogota.co";
const imageCache = {};
const getImageFromCacheOrFetch = async (url) => {
  return url;
};

async function setBannerImage() {
  const containerImgBanner = document.querySelector(
    ".principal-banner .media video source"
  );
  const containervideoBanner = document.querySelector(
    ".principal-banner .media video"
  );
  if (containerImgBanner) {
    try {
      const url = await getImageFromCacheOrFetch(`${urlGlobal}${videoUrl}`);

      containervideoBanner.src = url;
      containerImgBanner.src = url;

      // Cargar las imágenes perezosamente (lazy load)
      lazyImages();
    } catch (error) {
      console.error("Error al obtener la URL de la imagen:", error);
    }
  }
}

setBannerImage();

if (document.querySelector(".slide_explora_item")) {
  fetch("/g/products/")
    .then((res) => res.json())
    .then((data) => {
      const container = document.querySelector(".slide_explora_item");

      const promises = data.map(async (product, exploraCount) => {
        let icon = await getImageFromCacheOrFetch(
          product.field_icon
            ? urlGlobal + product.field_icon
            : "img/senderismo.svg"
        );
        let template = ` <a href="${actualLang}/explora/${get_alias(
          product.title
        )}/${
          product.nid
        }" class="mini_item wait ${exploraCount}"><div class="icon"><img loading="lazy" class="lazyload" data-src="${icon}" src="https://picsum.photos/20/20" alt="${
          product.title
        }"></div> <h3 class="">${
          product.title
        }</h3><img src="img/curve_mini.png" alt="curve_mini" class="curve_mini"></a>`;
        container.innerHTML += template;
      });

      return Promise.all(promises);
    })
    .then(() => {
      lazyImages();
    });
}

$(document).ready(function () {
  // document.querySelector("html, body").scrollTop = 0;
  $("video").each(function () {
    enableInlineVideo(this);
  });

  geoFindMe();
  var ua = navigator.vendor.toLowerCase();
  var is_safari = ua.indexOf("apple") > -1;
  if (
    !document.querySelector(".closetome") ||
    !document.querySelector(".closetomePlace")
  ) {
    if ($(window).width() < 1023) {
      if (is_safari) {
        $('img[alt="playstore"]').hide();
        $("#close_menu").css({ right: "initial" });
      } else {
        $('img[alt="appstore"]').hide();
      }
    }
  }
  if (!is_safari && window.innerWidth < 1023) {
    if (window.matchMedia("(prefers-color-scheme)").media !== "not all") {
      if (
        window.matchMedia &&
        window.matchMedia("(prefers-color-scheme: dark)").matches
      ) {
        document.querySelector("body").classList.add("dark");
      }
      if (
        window.matchMedia &&
        window.matchMedia("(prefers-color-scheme: light)").matches
      ) {
        document.querySelector("body").classList.remove("dark");
      }
      window
        .matchMedia("(prefers-color-scheme: dark)")
        .addEventListener("change", (e) => {
          document.querySelector("body").classList.toggle("dark");
        });
    }
  }
  $("body").fadeIn("slow");
  // Lazy load IMages
  lazyImages();
  // SLIDERS
  slideExplora();
  sliderInstagram();
  slider_know_more();
  campaign_slider();

  // SCROLL EFFECT BOGOTA HOME
  if ($(window).width() > 1023) {
    $(window).scroll(function (e) {
      if ($(window).scrollTop() > 20 && $(window).scrollTop() < 170) {
        $(".principal-banner > h2").css({
          "letter-spacing": $(window).scrollTop(),
        });
        $(".principal-banner > h2").css({ opacity: 0 });
      } else if ($(window).scrollTop() < 20) {
        $(".principal-banner > h2").css({ "letter-spacing": 30 });
        $(".principal-banner > h2").css({ opacity: 1 });
      }
    });
  }
  if ($(".portal").length) {
    $(window).scroll(function (e) {
      $(".list_filters").removeClass("active");
    });
  }
  if (document.querySelector(".accordions")) {
    // ACCORDIONS
    $(".accordions").accordion({
      header: "h3",
      collapsible: true,
      animate: 200,
      active: false,
      heightStyle: "content",
    });
  }
  if (document.querySelector(".fixed_filter .categories")) {
    var heightcategories =
      document.querySelector(".fixed_filter .categories").offsetHeight + 4;
    document.querySelector(".fixed_filter .categories").style.bottom =
      -heightcategories + "px";
  }
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();

      document.querySelector(this.getAttribute("href")).scrollIntoView({
        behavior: "smooth",
      });
    });
  });
  $("#preloader").fadeOut("slow");

  if ($(".backLinkN").length == 0) {
    setCookie("prevurl", window.location.href, 15);
  } else {
    setBackLinks(getCookie("prevurl"));
  }
  // document.addEventListener("contextmenu", (event) => event.preventDefault());
  // instagramScript();
});
window.addEventListener("resize", function () {
  var relatedPosts = document.querySelector(".slider_posts");
  if (relatedPosts) {
    var widthElement = relatedPosts.offsetWidth;
    document
      .querySelectorAll("#slider_posts .single_post_img")
      .forEach((el) => {
        el.setAttribute("style", "height: calc(" + widthElement + "px / 16*9)");
      });
    if ($(window).width() > 768) {
      var sliderWidth = widthElement - 160;
    } else {
      var sliderWidth = widthElement - 80;
    }
    document
      .querySelector("#slider_posts")
      .setAttribute("style", "width: " + sliderWidth + "px");
  }
  if ($(window).width() < 1023) {
    circInterest();
  }
});
// LAZY LOADING IMAGES
function lazyImages() {
  if ("loading" in HTMLImageElement.prototype) {
    const images = document.querySelectorAll("img.lazyload");
    images.forEach((img) => {
      img.src = img.dataset.src;
    });
  } else {
    // Importamos dinámicamente la libreria `lazysizes`
    let script = document.createElement("script");
    script.async = true;
    script.src = "js/lazysizes.min.js";
    document.body.appendChild(script);
  }
}
function instagramScript() {
  let script = document.createElement("script");
  script.async = true;
  script.src = "//www.instagram.com/embed.js";
}
// Resize circles "Tambien te puede interesar"
function circInterest() {
  if (document.querySelector("#slider_interest_you")) {
    var width = document.querySelector(
      "#slider_interest_you .slider_interest_you_item"
    ).offsetWidth;
    document
      .querySelectorAll("#slider_interest_you .slider_interest_you_item img")
      .forEach((interestItem) => {
        interestItem.style.height = width + "px";
      });
  }
}
// Resize circles "Que hacer en la zona"
function circQueHacerZona() {
  // Que hacer en la zona
  if (document.querySelector(".interna_atractivo")) {
    document
      .querySelectorAll(".interna_atractivo .do-area_list_item a")
      .forEach((atractivo) => {
        atractivo.style.height = atractivo.offsetWidth + "px";
      });
  }
}
// Resize circles "Más alrededores"
function circ_slider_know_more() {
  // Que hacer en la zona
  if (document.querySelector("#slider_know_more")) {
    document
      .querySelectorAll(".slider_know_more_item a")
      .forEach((atractivo) => {
        atractivo.style.height = atractivo.offsetWidth + "px";
      });
  }
}
// LANGUAGES LIST
$(".languages").click(function (e) {
  $(".languages").toggleClass("active");
});
// HELPS TOGGLE - WIDGET
$(".arrow").click(function (e) {
  e.preventDefault();
  $(".arrow").toggleClass("active");
  $("#widget").toggleClass("active");
});
$("#widget button").click(function (e) {
  e.preventDefault();
  $(".arrow").toggleClass("active");
  $("#widget").toggleClass("active");
});
// MENU TOGGLE
$("#menuBtn, #close_menu").click(function (e) {
  e.preventDefault();
  if ($(window).width() < 1023) {
    $("#menu_mobile").toggleClass("active");
  } else {
    $("#menu").toggleClass("active");
  }
});
// SLide Explora Bogotá
function slideExplora() {
  if ($("#slide_explora").length) {
    $("#slide_explora").slick({
      prevArrow:
        '<button type="button" class="slick-prev"><img src="img/arrow_l_slider.svg" alt="prev"></button>',
      nextArrow:
        '<button type="button" class="slick-next"><img src="img/arrow_r_slider.svg" alt="next"></button>',
      dots: true,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
    });
  }
}
if ($(".bannerinformation").length) {
  $(".bannerinformation").slick({
    prevArrow:
      '<button type="button" class="slick-prev"><img src="img/arrow_l_slider.svg" alt="prev"></button>',
    nextArrow:
      '<button type="button" class="slick-next"><img src="img/arrow_r_slider.svg" alt="next"></button>',
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    autoplay: true,
    adaptiveHeight: true,
  });
}
// SLide Posts
function sliderPosts() {
  if ($("#slider_posts").length && $(window).width() > 768) {
    $("#slider_posts").slick({
      prevArrow:
        '<button type="button" class="slick-prev"><img src="img/arrow_blue_l.svg" alt="prev"></button>',
      nextArrow:
        '<button type="button" class="slick-next"><img src="img/arrow_blue_r.svg" alt="next"></button>',
      dots: true,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
    });
  }
}
// SLide Instagram
function sliderInstagram() {
  if ($("#instagram_slider").length && $(window).width() < 1023) {
    $("#instagram_slider").slick({
      prevArrow:
        '<button type="button" class="slick-prev"><img src="img/arrow_l_slider.svg" alt="prev"></button>',
      nextArrow:
        '<button type="button" class="slick-next"><img src="img/arrow_r_slider.svg" alt="next"></button>',
      slidesToShow: 1,
      dots: false,
    });
  }
}
// SLide Zonas Moviles
// function sliderZonasMobile() {
//   if ($("#zone_mobile_slider").length && $(window).width() < 1023) {
//     $("#zone_mobile_slider").slick({
//       prevArrow:
//         '<button type="button" class="slick-prev"><img src="img/arrow_blue_l.svg" alt="prev"></button>',
//       nextArrow:
//         '<button type="button" class="slick-next"><img src="img/arrow_blue_r.svg" alt="next"></button>',
//       slidesToShow: 1,
//       dots: false,
//       centerPadding: "60px",
//     });
//   }
// }
// SLide Interesar
function sliderInteres() {
  if ($("#slider_interest_you").length && $(window).width() < 1023) {
    $("#slider_interest_you").slick({
      prevArrow:
        '<button type="button" class="slick-prev"><img src="img/arrow_blue_l.svg" alt="prev"></button>',
      nextArrow:
        '<button type="button" class="slick-next"><img src="img/arrow_blue_r.svg" alt="next"></button>',
      slidesToShow: 1,
      dots: false,
      centerPadding: "60px",
    });
  }
}

function slider_know_more() {
  if ($("#slider_know_more").length && $(window).width() < 1023) {
    $("#slider_know_more").slick({
      prevArrow:
        '<button type="button" class="slick-prev"><img src="img/arrow_blue_l.svg" alt="prev"></button>',
      nextArrow:
        '<button type="button" class="slick-next"><img src="img/arrow_blue_r.svg" alt="next"></button>',
      slidesToShow: 1,
      dots: true,
      centerPadding: "60px",
    });
  }
}
function campaign_slider() {
  if ($("#campaign_slider").length && $(window).width() < 1023) {
    $("#campaign_slider").slick({
      slidesToShow: 1,
      dots: false,
      arrows: false,
      slidesToScroll: 1,
      centerMode: true,
      variableWidth: true,
      centerPadding: "40px",
    });
  }
}
$.validator.methods.email = function (value, element) {
  return (
    this.optional(element) ||
    /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/.test(
      value
    )
  );
};
function startRecaptcha() {
  widgetId1 = grecaptcha.render("recaptcha", {
    sitekey: "6Ld8r44fAAAAANfoX_j3luhSUrB0CkWgPM1zK12f",
  });
}
function validateSubscribe() {
  $("#subscribe").validate({
    ignore: "",
    rules: {
      emailSub: "required",
      politics: "required",
    },
    messages: {
      emailSub: messageError,
      politics: "Debe aceptar las políticas",
    },
    submitHandler: function (form) {
      if (grecaptcha.getResponse(widgetId1) != "") {
        $("#subscribe button").attr("disabled", true);
        $("#subscribe button").text("Enviando");
        $("#subscribe").ajaxSubmit({
          dataType: "json",
          success: function (data) {
            if (data.message == 1) {
              form.reset();
              $.fancybox.close();
              $("#subscribe button").text("enviado");
              $.fancybox.open({
                src: "b/subscribeMsg/",
                type: "ajax",
                opts: {
                  afterShow: function (instance, current) {
                    console.info("done!");
                  },
                },
              });
            } else {
              $("#subscribe button").text("Reintentar");
            }
            $("#subscribe button").attr("disabled", false);
          },
        });
      }
      /*
       */
    },
  });
}
function readAll() {
  if ($(".interna_atractivo .descripton .txt").length) {
    $(".interna_atractivo .descripton .txt").css({ height: "auto" });
    $(".interna_atractivo .descripton .txt .readMore").fadeOut();
  } else if ($(".alrededor .desc .txt .readMore").length) {
    $(".alrededor .desc .txt").css({ height: "auto" });
    $(".alrededor .desc .txt .readMore").fadeOut();
  }
}
function ViewFilters() {
  $(".filterMobile form .list_filters").toggleClass("active");
}
// OPEN BLOG FILTERS
function openFilterBlog() {
  $.fancybox.open({
    src: "b/blog_search/",
    type: "ajax",
    opts: {
      afterShow: function () {
        customSelect();
        $(".blog .boxes .select-items div").click(function (e) {
          if ($("#category option:selected")[0].value == -1) {
            $(`.blog_list a.blog_item`).fadeIn();
          } else {
            $(`.blog_list a.blog_item`).fadeOut();
            $(
              `.blog_list a[data-productid="${
                $("#category option:selected")[0].value
              }"]`
            ).fadeIn();
          }
          $.fancybox.close();
        });
      },
    },
  });
}
// OPEN INFORMACIÓN UTIL
function utilBoxes(id, applink1 = false, applink2 = false) {
  $("#preloader").fadeIn("fast");
  if (id == "apps") {
    $.fancybox.open({
      src: "/b/info_util/?boxID=" + id,
      type: "ajax",
      opts: {
        afterLoad: function () {
          document.querySelector(".boxes .boxes-container h2.title").innerHTML =
            "Descarga nuestra App";
          document.querySelector(".boxes .boxes-container .desc").innerHTML = `
            <p>En tu móvil tienes los mejores momentos para compartir con quien más quieres. Por eso, no esperes más y descarga la APP Bogotá DC Travel ¡Todo sobre la ciudad está en tus manos!</p>
            <div class="apps-box">
            <a href="${applink1}" target="_blank" rel="noopener"><img loading="lazy" class="lazyload" src="https://picsum.photos/20/20" data-src="img/playstore.svg" alt="playstore"></a>
            <a href="${applink2}" target="_blank" rel="noopener"><img loading="lazy" class="lazyload" src="https://picsum.photos/20/20" data-src="img/appstore.svg" alt="appstore"></a>
            </div>
            `;
          document.querySelector(
            ".boxes .boxes-container .desc"
          ).style.cssText =
            "height: 270px;margin: 0 auto;max-width: 900px;padding: 0 20px,display: flex;align-items: center;justify-content: center;flex-direction: column;display: flex;";
          $("#preloader").fadeOut("fast");
          lazyImages();
        },
      },
    });
  } else if (id == "free") {
    var singleInfo;
    fetch(actualLang + "/g/getNode/")
      .then((res) => res.json())
      .then((info) => {
        singleInfo = info;
      })
      .then(function () {
        $.fancybox.open({
          src: "/b/info_util/",
          type: "ajax",
          opts: {
            afterLoad: function () {
              document.querySelector(
                ".boxes .boxes-container h2.title"
              ).innerHTML = singleInfo.title;
              document.querySelector(
                ".boxes .boxes-container .desc"
              ).innerHTML = `<p>${singleInfo.body}</p>`;
              if ("loading" in HTMLImageElement.prototype) {
                const images = document.querySelectorAll("img.lazyload");
                images.forEach((img) => {
                  img.src = img.dataset.src;
                });
              } else {
                // Importamos dinámicamente la libreria `lazysizes`
                let script = document.createElement("script");
                script.async = true;
                script.src =
                  "https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.2.0/lazysizes.min.js";
                document.body.appendChild(script);
              }
              console.info("done!");
              $("#preloader").fadeOut("fast");
            },
          },
        });
      });
  } else {
    var singleInfo;
    fetch("/" + actualLang + "/g/tripInfo/?boxID=" + id)
      .then((res) => res.json())
      .then((info) => {
        singleInfo = info[0];
      })
      .then(function () {
        $.fancybox.open({
          src: "/b/info_util/?boxID=" + id,
          type: "ajax",
          opts: {
            afterLoad: function () {
              document.querySelector(
                ".boxes .boxes-container h2.title"
              ).innerHTML = singleInfo.title;
              if (
                document.querySelector(".boxes .boxes-container h2.title")
                  .textContent.length > 32
              ) {
                document.querySelector(
                  ".boxes .boxes-container h2.title"
                ).style.fontSize = "1.2rem";
              }
              document.querySelector(
                ".boxes .boxes-container .desc"
              ).innerHTML = `
                    <img loading="lazy" class="lazyload" data-src="${urlGlobal}${
                singleInfo.field_image
                  ? singleInfo.field_image
                  : "/img/noimg.png"
              }" src="https://picsum.photos/20/20" alt="Bogotá">
              <p>${singleInfo.body}</p>`;
              if (singleInfo.field_download_file != "") {
                let langtext = {
                  es: "Descargar",
                  en: "Download",
                  pt: "Baixar",
                };
                document.querySelector(
                  ".boxes .boxes-container .desc"
                ).innerHTML += `
                      <a href="https://files.visitbogota.co${singleInfo.field_download_file}" download>
                      ${langtext[actualLang]} ${singleInfo.title}
                    </a>
                      `;
              }
              if ("loading" in HTMLImageElement.prototype) {
                const images = document.querySelectorAll("img.lazyload");
                images.forEach((img) => {
                  img.src = img.dataset.src;
                });
              } else {
                // Importamos dinámicamente la libreria `lazysizes`
                let script = document.createElement("script");
                script.async = true;
                script.src =
                  "https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.2.0/lazysizes.min.js";
                document.body.appendChild(script);
              }
              console.info("done!");
              $("#preloader").fadeOut("fast");
            },
          },
        });
      });
  }
}
// OPEN INFORMACIÓN UTIL
function utilBoxes2(id, applink1 = false, applink2 = false) {
  $("#preloader").fadeIn("fast");
  if (id == "apps") {
    $.fancybox.open({
      src: "/b/info_util_2/?boxID=" + id,
      type: "ajax",
      opts: {
        afterLoad: function () {
          document.querySelector(".boxes .boxes-container h2.title").innerHTML =
            "Descarga nuestra App";
          document.querySelector(".boxes .boxes-container .desc").innerHTML = `
            <p>En tu móvil tienes los mejores momentos para compartir con quien más quieres. Por eso, no esperes más y descarga la APP Bogotá DC Travel ¡Todo sobre la ciudad está en tus manos!</p>
            <div class="apps-box">
            <a href="${applink1}" target="_blank" rel="noopener"><img loading="lazy" class="lazyload" src="https://picsum.photos/20/20" data-src="img/playstore.svg" alt="playstore"></a>
            <a href="${applink2}" target="_blank" rel="noopener"><img loading="lazy" class="lazyload" src="https://picsum.photos/20/20" data-src="img/appstore.svg" alt="appstore"></a>
            </div>
            `;
          document.querySelector(
            ".boxes .boxes-container .desc"
          ).style.cssText =
            "height: 270px;margin: 0 auto;max-width: 900px;padding: 0 20px,display: flex;align-items: center;justify-content: center;flex-direction: column;display: flex;";
          $("#preloader").fadeOut("fast");
          lazyImages();
        },
      },
    });
  } else if (id == "free") {
    var singleInfo;
    fetch(actualLang + "/g/getNode/")
      .then((res) => res.json())
      .then((info) => {
        singleInfo = info;
      })
      .then(function () {
        $.fancybox.open({
          src: "/b/info_util/",
          type: "ajax",
          opts: {
            afterLoad: function () {
              document.querySelector(
                ".boxes .boxes-container h2.title"
              ).innerHTML = singleInfo.title;
              document.querySelector(
                ".boxes .boxes-container .desc"
              ).innerHTML = `<p>${singleInfo.body}</p>`;
              if ("loading" in HTMLImageElement.prototype) {
                const images = document.querySelectorAll("img.lazyload");
                images.forEach((img) => {
                  img.src = img.dataset.src;
                });
              } else {
                // Importamos dinámicamente la libreria `lazysizes`
                let script = document.createElement("script");
                script.async = true;
                script.src =
                  "https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.2.0/lazysizes.min.js";
                document.body.appendChild(script);
              }
              console.info("done!");
              $("#preloader").fadeOut("fast");
            },
          },
        });
      });
  } else {
    var singleInfo;
    fetch("/" + actualLang + "/g/tripInfo/?boxID=" + id)
      .then((res) => res.json())
      .then((info) => {
        singleInfo = info[0];
      })
      .then(function () {
        $.fancybox.open({
          src: "/b/info_util/?boxID=" + id,
          type: "ajax",
          opts: {
            afterLoad: function () {
              document.querySelector(
                ".boxes .boxes-container h2.title"
              ).innerHTML = singleInfo.title;
              document.querySelector(
                ".boxes .boxes-container .desc"
              ).innerHTML = `
                    <img loading="lazy" class="lazyload" data-src="${
                      singleInfo.field_image
                        ? singleInfo.field_image
                        : "/img/noimg.png"
                    }" src="https://picsum.photos/20/20" alt="Bogotá">
                    <p>${singleInfo.body}</p>`;
              if ("loading" in HTMLImageElement.prototype) {
                const images = document.querySelectorAll("img.lazyload");
                images.forEach((img) => {
                  img.src = img.dataset.src;
                });
              } else {
                // Importamos dinámicamente la libreria `lazysizes`
                let script = document.createElement("script");
                script.async = true;
                script.src =
                  "https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.2.0/lazysizes.min.js";
                document.body.appendChild(script);
              }
              console.info("done!");
              $("#preloader").fadeOut("fast");
            },
          },
        });
      });
  }
}
function upFilterBlog() {
  document.querySelector(".fixed_filter").classList.toggle("active");
}
function slidersUtil() {
  if ($(".utilSlide").length) {
    $(".utilSlide").slick({
      prevArrow:
        '<button type="button" class="slick-prev"><img src="images/ep_arrow-left-bold.svg" alt="left"></button>',
      nextArrow:
        '<button type="button" class="slick-next"><img src="images/ep_arrow-right-bold.svg" alt="right"></button>',
      slidesToShow: 5,
      dots: false,
      arrows: true,
      slidesToScroll: 5,
      responsive: [
        {
          breakpoint: 1023,
          settings: {
            slidesToScroll: 1,
            arrows: true,
            dots: false,
            slidesToShow: 1,
          },
        },
      ],
    });
  }
}
function get_alias(str) {
  str = str.replace(/¡/g, "", str); //Signo de exclamación abierta.&iexcl;
  str = str.replace(/'/g, "", str); //Signo de exclamación abierta.&iexcl;
  str = str.replace(/!/g, "", str); //Signo de exclamación abierta.&iexcl;
  str = str.replace(/¢/g, "-", str); //Signo de centavo.&cent;
  str = str.replace(/£/g, "-", str); //Signo de libra esterlina.&pound;
  str = str.replace(/¤/g, "-", str); //Signo monetario.&curren;
  str = str.replace(/¥/g, "-", str); //Signo del yen.&yen;
  str = str.replace(/¦/g, "-", str); //Barra vertical partida.&brvbar;
  str = str.replace(/§/g, "-", str); //Signo de sección.&sect;
  str = str.replace(/¨/g, "-", str); //Diéresis.&uml;
  str = str.replace(/©/g, "-", str); //Signo de derecho de copia.&copy;
  str = str.replace(/ª/g, "-", str); //Indicador ordinal femenino.&ordf;
  str = str.replace(/«/g, "-", str); //Signo de comillas francesas de apertura.&laquo;
  str = str.replace(/¬/g, "-", str); //Signo de negación.&not;
  str = str.replace(/®/g, "-", str); //Signo de marca registrada.&reg;
  str = str.replace(/¯/g, "&-", str); //Macrón.&macr;
  str = str.replace(/°/g, "-", str); //Signo de grado.&deg;
  str = str.replace(/±/g, "-", str); //Signo de más-menos.&plusmn;
  str = str.replace(/²/g, "-", str); //Superíndice dos.&sup2;
  str = str.replace(/³/g, "-", str); //Superíndice tres.&sup3;
  str = str.replace(/´/g, "-", str); //Acento agudo.&acute;
  str = str.replace(/µ/g, "-", str); //Signo de micro.&micro;
  str = str.replace(/¶/g, "-", str); //Signo de calderón.&para;
  str = str.replace(/·/g, "-", str); //Punto centrado.&middot;
  str = str.replace(/¸/g, "-", str); //Cedilla.&cedil;
  str = str.replace(/¹/g, "-", str); //Superíndice 1.&sup1;
  str = str.replace(/º/g, "-", str); //Indicador ordinal masculino.&ordm;
  str = str.replace(/»/g, "-", str); //Signo de comillas francesas de cierre.&raquo;
  str = str.replace(/¼/g, "-", str); //Fracción vulgar de un cuarto.&frac14;
  str = str.replace(/½/g, "-", str); //Fracción vulgar de un medio.&frac12;
  str = str.replace(/¾/g, "-", str); //Fracción vulgar de tres cuartos.&frac34;
  str = str.replace(/¿/g, "-", str); //Signo de interrogación abierta.&iquest;
  str = str.replace(/×/g, "-", str); //Signo de multiplicación.&times;
  str = str.replace(/÷/g, "-", str); //Signo de división.&divide;
  str = str.replace(/À/g, "a", str); //A mayúscula con acento grave.&Agrave;
  str = str.replace(/Á/g, "a", str); //A mayúscula con acento agudo.&Aacute;
  str = str.replace(/Â/g, "a", str); //A mayúscula con circunflejo.&Acirc;
  str = str.replace(/Ã/g, "a", str); //A mayúscula con tilde.&Atilde;
  str = str.replace(/Ä/g, "a", str); //A mayúscula con diéresis.&Auml;
  str = str.replace(/Å/g, "a", str); //A mayúscula con círculo encima.&Aring;
  str = str.replace(/Æ/g, "a", str); //AE mayúscula.&AElig;
  str = str.replace(/Ç/g, "c", str); //C mayúscula con cedilla.&Ccedil;
  str = str.replace(/È/g, "e", str); //E mayúscula con acento grave.&Egrave;
  str = str.replace(/É/g, "e", str); //E mayúscula con acento agudo.&Eacute;
  str = str.replace(/Ê/g, "e", str); //E mayúscula con circunflejo.&Ecirc;
  str = str.replace(/Ë/g, "e", str); //E mayúscula con diéresis.&Euml;
  str = str.replace(/Ì/g, "i", str); //I mayúscula con acento grave.&Igrave;
  str = str.replace(/Í/g, "i", str); //I mayúscula con acento agudo.&Iacute;
  str = str.replace(/Î/g, "i", str); //I mayúscula con circunflejo.&Icirc;
  str = str.replace(/Ï/g, "i", str); //I mayúscula con diéresis.&Iuml;
  str = str.replace(/Ð/g, "d", str); //ETH mayúscula.&ETH;
  str = str.replace(/Ñ/g, "n", str); //N mayúscula con tilde.&Ntilde;
  str = str.replace(/Ò/g, "o", str); //O mayúscula con acento grave.&Ograve;
  str = str.replace(/Ó/g, "o", str); //O mayúscula con acento agudo.&Oacute;
  str = str.replace(/Ô/g, "o", str); //O mayúscula con circunflejo.&Ocirc;
  str = str.replace(/Õ/g, "o", str); //O mayúscula con tilde.&Otilde;
  str = str.replace(/Ö/g, "o", str); //O mayúscula con diéresis.&Ouml;
  str = str.replace(/Ø/g, "o", str); //O mayúscula con barra inclinada.&Oslash;
  str = str.replace(/Ù/g, "u", str); //U mayúscula con acento grave.&Ugrave;
  str = str.replace(/Ú/g, "u", str); //U mayúscula con acento agudo.&Uacute;
  str = str.replace(/Û/g, "u", str); //U mayúscula con circunflejo.&Ucirc;
  str = str.replace(/Ü/g, "u", str); //U mayúscula con diéresis.&Uuml;
  str = str.replace(/Ý/g, "y", str); //Y mayúscula con acento agudo.&Yacute;
  str = str.replace(/Þ/g, "b", str); //Thorn mayúscula.&THORN;
  str = str.replace(/ß/g, "b", str); //S aguda alemana.&szlig;
  str = str.replace(/à/g, "a", str); //a minúscula con acento grave.&agrave;
  str = str.replace(/á/g, "a", str); //a minúscula con acento agudo.&aacute;
  str = str.replace(/â/g, "a", str); //a minúscula con circunflejo.&acirc;
  str = str.replace(/ã/g, "a", str); //a minúscula con tilde.&atilde;
  str = str.replace(/ä/g, "a", str); //a minúscula con diéresis.&auml;
  str = str.replace(/å/g, "a", str); //a minúscula con círculo encima.&aring;
  str = str.replace(/æ/g, "a", str); //ae minúscula.&aelig;
  str = str.replace(/ç/g, "a", str); //c minúscula con cedilla.&ccedil;
  str = str.replace(/è/g, "e", str); //e minúscula con acento grave.&egrave;
  str = str.replace(/é/g, "e", str); //e minúscula con acento agudo.&eacute;
  str = str.replace(/ê/g, "e", str); //e minúscula con circunflejo.&ecirc;
  str = str.replace(/ë/g, "e", str); //e minúscula con diéresis.&euml;
  str = str.replace(/ì/g, "i", str); //i minúscula con acento grave.&igrave;
  str = str.replace(/í/g, "i", str); //i minúscula con acento agudo.&iacute;
  str = str.replace(/î/g, "i", str); //i minúscula con circunflejo.&icirc;
  str = str.replace(/ï/g, "i", str); //i minúscula con diéresis.&iuml;
  str = str.replace(/ð/g, "i", str); //eth minúscula.&eth;
  str = str.replace(/ñ/g, "n", str); //n minúscula con tilde.&ntilde;
  str = str.replace(/ò/g, "o", str); //o minúscula con acento grave.&ograve;
  str = str.replace(/ó/g, "o", str); //o minúscula con acento agudo.&oacute;
  str = str.replace(/ô/g, "o", str); //o minúscula con circunflejo.&ocirc;
  str = str.replace(/õ/g, "o", str); //o minúscula con tilde.&otilde;
  str = str.replace(/ö/g, "o", str); //o minúscula con diéresis.&ouml;
  str = str.replace(/ø/g, "o", str); //o minúscula con barra inclinada.&oslash;
  str = str.replace(/ù/g, "o", str); //u minúscula con acento grave.&ugrave;
  str = str.replace(/ú/g, "u", str); //u minúscula con acento agudo.&uacute;
  str = str.replace(/û/g, "u", str); //u minúscula con circunflejo.&ucirc;
  str = str.replace(/ü/g, "u", str); //u minúscula con diéresis.&uuml;
  str = str.replace(/ý/g, "y", str); //y minúscula con acento agudo.&yacute;
  str = str.replace(/þ/g, "b", str); //thorn minúscula.&thorn;
  str = str.replace(/ÿ/g, "y", str); //y minúscula con diéresis.&yuml;
  str = str.replace(/Œ/g, "d", str); //OE Mayúscula.&OElig;
  str = str.replace(/œ/g, "-", str); //oe minúscula.&oelig;
  str = str.replace(/Ÿ/g, "-", str); //Y mayúscula con diéresis.&Yuml;
  str = str.replace(/ˆ/g, "", str); //Acento circunflejo.&circ;
  str = str.replace(/˜/g, "", str); //Tilde.&tilde;
  str = str.replace(/–/g, "", str); //Guiún corto.&ndash;
  str = str.replace(/—/g, "", str); //Guiún largo.&mdash;
  str = str.replace(/'/g, "", str); //Comilla simple izquierda.&lsquo;
  str = str.replace(/'/g, "", str); //Comilla simple derecha.&rsquo;
  str = str.replace(/,/g, "", str); //Comilla simple inferior.&sbquo;
  str = str.replace(/"/g, "", str); //Comillas doble derecha.&rdquo;
  str = str.replace(/"/g, "", str); //Comillas doble inferior.&bdquo;
  str = str.replace(/†/g, "-", str); //Daga.&dagger;
  str = str.replace(/‡/g, "-", str); //Daga doble.&Dagger;
  str = str.replace(/…/g, "-", str); //Elipsis horizontal.&hellip;
  str = str.replace(/‰/g, "-", str); //Signo de por mil.&permil;
  str = str.replace(/‹/g, "-", str); //Signo izquierdo de una cita.&lsaquo;
  str = str.replace(/›/g, "-", str); //Signo derecho de una cita.&rsaquo;
  str = str.replace(/€/g, "-", str); //Euro.&euro;
  str = str.replace(/™/g, "-", str); //Marca registrada.&trade;
  str = str.replace(/ & /g, "-", str); //Marca registrada.&trade;
  str = str.replace(/\(/g, "-", str);
  str = str.replace(/\)/g, "-", str);
  str = str.replace(/�/g, "-", str);
  str = str.replace(/\//g, "-", str);
  str = str.replace(":", "", str);
  str = str.replace(/ de /g, "-", str); //Espacios
  str = str.replace(/ y /g, "-", str); //Espacios
  str = str.replace(/ a /g, "-", str); //Espacios
  str = str.replace(/ DE /g, "-", str); //Espacios
  str = str.replace(/ A /g, "-", str); //Espacios
  str = str.replace(/ Y /g, "-", str); //Espacios
  str = str.replace(/ /g, "-", str); //Espacios
  str = str.replace(/  /g, "-", str); //Espacios
  str = str.replace(/\./g, "", str); //Punto
  str = str.replace("’", "", str);
  str = str.replace("‘", "", str);
  str = str.replace("“", "", str);
  str = str.replace("”", "", str);
  str = str.replace("+", "", str);
  str = str.replace("&", "", str);
  str = str.replace("amp;", "", str);
  str = str.replace("?", "", str);
  str = str.replace("¿", "", str);
  str = str.replace("'", "", str);
  str = str.replace("`", "", str);
  str = str.replace("`", "", str);
  str = str.replace("`", "", str);

  // Crear un objeto para mapeo de caracteres con tildes a sin tildes
  const accentsMap = {
    á: "a",
    é: "e",
    í: "i",
    ó: "o",
    ú: "u",
    Á: "A",
    É: "E",
    Í: "I",
    Ó: "O",
    Ú: "U",
    ñ: "n",
    Ñ: "N",
    ü: "u",
    Ü: "U",
  };

  // Normalizar la cadena para combinar caracteres base y tildes
  str = str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

  // Reemplazar caracteres con tildes por sus equivalentes sin tildes
  str = str
    .split("")
    .map((char) => accentsMap[char] || char)
    .join("");

  //Mayusculas
  str = str.toLowerCase();

  return str;
}

$("#btnSearchMobile").click(function () {
  $(".searchMobile").addClass("active");
  $(".searchMobile #search").focus();
});
$(".searchMobile").click(function () {
  $(".searchMobile").removeClass("active");
});
function groupBy(arr, property) {
  return arr.reduce(function (memo, x) {
    if (!memo[x[property]]) {
      memo[x[property]] = [];
    }
    memo[x[property]].push(x);
    return memo;
  }, {});
}

async function createZonesHome(zoneData, zonesTax) {
  var zonesTaxContainer = document.querySelector(".home .zoneTax_cards");
  var zonesContainer = document.querySelector(".home .zone_cards_container");
  if (zonesTaxContainer) {
    var zoneGroup = groupBy(zoneData, "field_zona_localidad_1");
    for (let indexTax = 0; indexTax < zonesTax.length; indexTax++) {
      const zoneTax = zonesTax[indexTax];

      let imageZona = await getImageFromCacheOrFetch(
        `${
          zoneTax.field_imagen_zona
            ? `${urlGlobal}${zoneTax.field_imagen_zona}`
            : `img/noimg.png`
        }`
      );

      var template = `<button class="zone_cards_item" data-tax="${zoneTax.tid}"><img loading="lazy" data-src="${imageZona}"  alt="Sitio web oficial de turismo de Bogotá" class="zone_img lazyload" src="https://picsum.photos/20/20"><h3 class="zone_cards_name"> ${zoneTax.name} </h3></button>`;
      if (zoneTax.tid != 136) {
        zonesTaxContainer.innerHTML += template;
      }
      var containerZoneGroup = `<div class="zone_cards" id="zoneTax-${zoneTax.tid}"></div>`;
      zonesContainer.innerHTML += containerZoneGroup;
      if (zoneGroup[zoneTax.tid]) {
        zoneGroup[zoneTax.tid].map(async (zoneGroupItem) => {
          let imageLocalidad = await getImageFromCacheOrFetch(
            `${
              zoneGroupItem.field_home_img
                ? `${urlGlobal}${zoneGroupItem.field_home_img}`
                : `img/noimg.png`
            }`
          );
          var templateCardLocalidad = `<a href="${actualLang}/zona/${get_alias(
            zoneGroupItem.title
          )}/${
            zoneGroupItem.nid
          }" class="zone_cards_item wait"><img loading="lazy" data-src="${imageLocalidad}"  alt="bogota" class="zone_img lazyload" src="https://picsum.photos/20/20"><h3 class="zone_cards_name"> ${
            zoneGroupItem.title
          } </h3></a>`;
          document.querySelector(`#zoneTax-${zoneTax.tid}`).innerHTML +=
            templateCardLocalidad;
        });
      }
    }
    document.querySelectorAll(`.zone_cards_item`).forEach((element) => {
      element.addEventListener("click", () => {
        if (document.querySelector(`.zone_cards.active`)) {
          document
            .querySelector(`.zone_cards.active`)
            .classList.remove("active");
        }
        if (document.querySelector(`.zone_cards_item.noOpac`)) {
          document
            .querySelector(`.zone_cards_item.noOpac`)
            .classList.remove("noOpac");
        }
        element.classList.add("noOpac");
        document
          .querySelector(`#zoneTax-${element.dataset.tax}`)
          .classList.toggle("active");
        document.querySelector(`.zoneTax_cards`).classList.add("selected");
      });
    });
    lazyImages();
  }
}

function createNearbyHome(nearbyData) {
  var nearbyPlacesContainer = document.querySelector(
    ".home #mas_alla_bogota_slider"
  );
  if (nearbyPlacesContainer) {
    nearbyPlacesContainer.innerHTML = "";
    for (let index = 0; index < nearbyData.length; index++) {
      const nearbyPlace = nearbyData[index];
      const nearbyTitle = nearbyPlace.title;
      var template =
        '<div class="mas_alla_bogota_slider_item"><a href="' +
        actualLang +
        "/alrededor/" +
        get_alias(nearbyTitle) +
        "/" +
        nearbyPlace.nid +
        '" class="content wait"><h3 class="">' +
        nearbyTitle +
        "</h3></a></div>";
      nearbyPlacesContainer.innerHTML += template;
    }
  }
}

function createFeaturedHome(featuredData) {
  var campaignDots = document.querySelector(".campaign .dots_campaign");
  if (campaignDots) {
    campaignDots.innerHTML = "";
    for (let index = 0; index < featuredData.length; index++) {
      const featuredSlide = featuredData[index];
      var img = featuredSlide.field_imagen;
      var title = featuredSlide.title;
      var desc = featuredSlide.body;
      var btnTxt = featuredSlide.field_texto_del_boton;
      var video = featuredSlide.field_link_ ? featuredSlide.field_link_ : "";
      var videoArray = video.split("/");
      video = videoArray[videoArray.length - 1];
      var shortTxt = featuredSlide.field_t;
      var linkCampaign = featuredSlide.url;
      var template = `<li><button data-img="${img}" data-title="${title}" data-desc="${desc}" data-txtbtn="${btnTxt}" data-video="https://www.youtube.com/embed/${video}" data-shorttxt="${shortTxt}" data-contentid="${linkCampaign}">${title}</button></li>`;
      campaignDots.innerHTML += template;
    }
  }
}

if (document.querySelector("body.home")) {
  const fetchHomeData = () => {
    const urls = [
      "/" + actualLang + "/g/zonas/",
      "/" + actualLang + "/g/nearbyPlaces/",
      "/" + actualLang + "/g/zonasTax/",
    ];
    const allRequests = urls.map(async (url) => {
      let homeResponse = await fetch(url);
      return homeResponse.json();
    });
    return Promise.all(allRequests);
  };
  fetchHomeData()
    .then((arrayOfResponses) => {
      //   ZONE ELEMENTS HOME
      const zones = arrayOfResponses[0];
      const zonesTax = arrayOfResponses[2];
      createZonesHome(zones, zonesTax);
      // + ALLÁ DE BOGOTÁ HOME
      const nearbyPlacesObj = arrayOfResponses[1];
      createNearbyHome(nearbyPlacesObj);
    })
    .then(function () {
      lazyImages();
      // if (window.innerWidth < 1023) {
      //   sliderZonasMobile();
      // }
      fetch("/" + actualLang + "/g/featuredSlider/")
        .then((response) => response.json())
        .then((data) => {
          createFeaturedHome(data);
        })
        .then(function () {
          $(".dots_campaign li button").click(function (e) {
            e.preventDefault();
            $(".dots_campaign li.active").removeClass("active");
            $(e.target).parents("li").addClass("active");
            var title = $(e.target).data("title");
            var desc = $(e.target).data("desc");
            var txtBtn = $(e.target).data("txtbtn");
            var video = $(e.target).data("video");
            var img = $(e.target).data("img");
            // var shortTxtBtn = $(e.target).data("shorttxt");
            var link = $(e.target).data("contentid");
            $("#campaign-title").html(title);
            $(".message_campaign_container p").html(desc);
            $(".campaign_btn").html(txtBtn);
            $(".campaign .campaign_btn").attr("href", link);
            if (link == "" || link == null) {
              $(".campaign .campaign_btn").hide();
            }
            if (video == "https://www.youtube.com/embed/") {
              $(".campaign iframe").fadeOut();
              $(".campaign .video_campaign img").attr("src", img);
              setTimeout(() => {
                $(".campaign .video_campaign img").fadeIn();
              }, 600);
            } else {
              $(".campaign iframe").attr("src", video + "?controls=0");
              $(".campaign iframe").attr("title", title);
              $(".campaign .video_campaign img").fadeOut();
              setTimeout(() => {
                $(".campaign iframe").fadeIn();
              }, 600);
            }
            document.querySelector("html, body").scrollTop =
              document.querySelector(".campaign").offsetTop;
          });
        })
        .then(() => {
          $(".dots_campaign li").first().addClass("active");
          var title = $(".dots_campaign li button").first().data("title");
          var desc = $(".dots_campaign li button").first().data("desc");
          var txtBtn = $(".dots_campaign li button").first().data("txtbtn");
          var video = $(".dots_campaign li button").first().data("video");
          var img = $(".dots_campaign li button").first().data("img");
          // var shortTxtBtn = $(".dots_campaign li button").first().data("shorttxt");
          var link = $(".dots_campaign li button").first().data("contentid");
          $(".campaign iframe").attr("src", video + "?controls=0");
          $(".campaign .video_campaign img").attr("src", img);
          $(".campaign iframe").attr("title", title);
          $("#campaign-title").html(title);
          $(".message_campaign_container p").html(desc);
          $(".campaign_btn").html(txtBtn);
          $(".campaign .campaign_btn").attr("href", link);
          if (link == "" || link == null) {
            $(".campaign .campaign_btn").hide();
          }
          if (document.querySelector(".covid")) {
            var heightCovid = document.querySelector(".covid").offsetHeight;
            document.querySelector(".home header").style.top =
              heightCovid + "px";
          }
        });
    });
}
var latitude;
var longitude;
// Ubicación
function geoFindMe() {
  if (!navigator.geolocation) {
    return;
  }
  function success(position) {
    if ($(".portal .container-switch .switch").hasClass("active")) {
      $(".portal .container-switch .switch").toggleClass("active");
    }
    latitude = position.coords.latitude;
    longitude = position.coords.longitude;
    if (
      latitude > 40.755624 &&
      latitude < 40.761639 &&
      longitude > -73.989255 &&
      longitude < -73.981086
    ) {
      gtag("event", "timesquare", {
        event_category: "campaigns",
        event_label: "bogota",
        value: 0,
      });
    }
    //   output.appendChild(img);
    // if (
    //   document.querySelector("body.interna_atractivo") ||
    //   document.querySelector("body.alrededor")
    // ) {
    //   fetch(
    //     `${actualLang}/g/distance/?currentLocation=${latitude},${longitude}&placeLocation=${placecoords}`
    //   ).then((response) =>
    //     response.text().then(function (text) {
    //       if (window.innerWidth > 1023) {
    //         $(".details li .me").fadeIn();
    //         if (document.querySelector(".me span")) {
    //           document.querySelector(".me span").innerText =
    //             "A " + text + "Km de tu ubicación";
    //         }
    //       } else {
    //         if (document.querySelector(".banner .banner_img h2 small")) {
    //           $(".banner .banner_img h2 small").fadeIn();
    //           document.querySelector(
    //             ".banner .banner_img h2 small span"
    //           ).innerText = "A " + text + "Km de tu ubicación";
    //         }
    //       }
    //     })
    //   );
    // }
    $(".portal .container-switch .switch").click(function (e) {
      e.preventDefault();
      if (data_product) {
        if (!$(".portal .container-switch .switch").hasClass("active")) {
          filterPortal(filters_plan, filters_especificos, filters_zonas, [
            latitude,
            longitude,
          ]);
          $(".portal .container-switch .switch").toggleClass("active");
        } else {
          filterPortal(filters_plan, filters_especificos, filters_zonas, false);
          $(".portal .container-switch .switch").toggleClass("active");
        }
      } else if (data_plan) {
        if (!$(".portal .container-switch .switch").hasClass("active")) {
          filterPortal(filters_plan, filters_especificos, filters_zonas, [
            latitude,
            longitude,
          ]);
          $(".portal .container-switch .switch").toggleClass("active");
        } else {
          filterPortal(filters_plan, filters_especificos, filters_zonas, false);
          $(".portal .container-switch .switch").toggleClass("active");
        }
      } else if (data_zone) {
        if (!$(".portal .container-switch .switch").hasClass("active")) {
          filterPortal(filters_plan, filters_especificos, filters_zonas, [
            latitude,
            longitude,
          ]);
          $(".portal .container-switch .switch").toggleClass("active");
        } else {
          filterPortal(filters_plan, filters_especificos, filters_zonas, false);
          $(".portal .container-switch .switch").toggleClass("active");
        }
      }
    });
    if (document.querySelector(".closetome")) {
      var url = actualLang + "/g/closetome/?filter=1";
      url += "&closeto=" + [latitude, longitude];
      // Fetch final URL
      fetch(url)
        .then((response) => response.json())
        .then((places) => {
          let newPLaces = [];
          shuffle(places);
          for (let index = 0; index < places.length; index++) {
            const place = places[index];
            if (place.field_inmaterial != "1" && newPLaces.length < 2) {
              newPLaces.push(place);
            }
          }
          return newPLaces;
        })
        .then((places) => {
          let placesContainer = document.querySelector(".closetome .places");
          placesContainer.innerHTML = "";
          places.forEach((place) => {
            let template = `<div class="place-item">

            <img loading="lazy" src="https://picsum.photos/20/20" data-src="${urlGlobal}${
              place.field_cover_image
                ? place.field_cover_image
                : "/img/noimg.png"
            }" alt="${place.title}" class="lazyload">
            <div class="place-name">${place.title}</div>
            </div>`;
            placesContainer.innerHTML += template;
            let zonesrel = [];
            if (place.field_zone_rel != "") {
              zonesrel.push(place.field_zone_rel);
            }
            lazyImages();
          });
        });
    }
  }
  function error() {
    if ($(".portal").length) {
      $(".portal .container-switch").hide();
    }
  }
  navigator.geolocation.getCurrentPosition(success, error);
}
// Blogs relacionados
function getBlogsRel(prodId, prodName) {
  if (prodId) {
    var url = "/" + actualLang + "/g/blogs/?productID=" + prodId;
  } else {
    var url = "/" + actualLang + "/g/blogs/?productID=all";
  }
  fetch(url)
    .then((response) => response.json())
    .then((blogs) => {
      if (blogs) {
        shuffle(blogs);
        var containerBlogs;
        var sliderBlogs = document.querySelector("#slider_posts");
        var articlesRelGrid = document.querySelector(
          ".articles_rel_grid.container"
        );
        if (sliderBlogs) {
          if (blogs.length < 1) {
            $(".top-articles").hide();
            $(".portal_list").addClass("noevents");
            $(".rel").addClass("noevents");
          }
          for (let i = 0; i < blogs.length; i++) {
            if (i % 2 == 0) {
              containerBlogs = document.createElement("div");
              containerBlogs.classList.add("slider_posts_item");
              sliderBlogs.appendChild(containerBlogs);
            }
            var templateBlog = `
                  <a href="${actualLang}/blog/${
              prodName ? get_alias(prodName) : "all"
            }/${get_alias(blogs[i].title)}-${prodId ? prodId : "all"}-${
              blogs[i].nid
            }" class="single_post wait">
                      <div class="single_post_img"><img loading="lazy" src="https://picsum.photos/20/20" data-src="${
                        blogs[i].field_image
                          ? urlGlobal + blogs[i].field_image
                          : "/img/noimg.png"
                      }" alt="${blogs[i].title}" class="lazyload"></div>
                      <h3 class="single_post_title">${blogs[i].title}</h3>
                  </a>
                  `;
            containerBlogs.innerHTML += templateBlog;
          }
        } else if (articlesRelGrid) {
          if (blogs.length < 1) {
            $(".interna_atractivo .articles_rel").hide();
          }
          var blogURL;
          articlesRelGrid.innerHTML = "";
          for (let i = 0; i < blogs.length; i++) {
            if (prodName) {
              blogURL = `${actualLang}/blog/${get_alias(prodName)}/${get_alias(
                blogs[i].title
              )}-${prodId}-${blogs[i].nid}`;
            } else {
              blogURL = `blog/all/${get_alias(blogs[i].title)}-all-${
                blogs[i].nid
              }`;
            }
            if (i < 4) {
              var templateBlog = `
                      <a href="${blogURL}" class="single_article wait">
                          <img loading="lazy" src="https://picsum.photos/20/20" data-src="${urlGlobal}${
                blogs[i].field_image ? blogs[i].field_image : "/img/noimg.png"
              }" class="lazyload" alt="BogotaDC.travel">
                          <h3>${blogs[i].title}</h3>
                      </a>
                      `;
              articlesRelGrid.innerHTML += templateBlog;
            }
          }
        }
      }
    })
    .then(function () {
      sliderPosts();
      lazyImages();
    });
}
// Te puede interesar
function interestYou(prodId) {
  if (prodId) {
    var url = actualLang + "/g/otherProducts/?productID=" + prodId;
  } else {
    var url = actualLang + "/g/otherProducts/?productID=all";
  }
  if (window.innerWidth > 1023) {
    var interestYouContainer = document.querySelector(".interest_you ul");
    if (interestYouContainer) {
      fetch(url)
        .then((response) => response.json())
        .then((interest) => {
          interest.forEach((single, i) => {
            if (i < 5) {
              var templateInterest = `
                      <li>
                          <a href="${actualLang}/explora/${get_alias(
                single.title
              )}/${single.nid}" class="wait">
                              <div class="number number_${i + 1}">
                                  0${i + 1}
                              </div>
                              <h3>${single.title}</h3>
                              <div class="img_container">
                                  <img loading="lazy" src="https://picsum.photos/20/20" data-src="${urlGlobal}${
                single.field_cover_image
                  ? single.field_cover_image
                  : "/img/noimg.png"
              }" alt="${single.title}" class="lazyload">
                              </div>
                          </a>
                      </li>
                      `;
              interestYouContainer.innerHTML += templateInterest;
            }
          });
        })
        .then(function () {
          lazyImages();
        });
    }
  } else {
    var interestYouContainer = document.querySelector("#slider_interest_you");
    if (interestYouContainer) {
      fetch(url)
        .then((response) => response.json())
        .then((interest) => {
          interest.forEach((single, i) => {
            var templateInterest = `
                  <a href="${actualLang}/explora/${get_alias(single.title)}/${
              single.nid
            }" class="slider_interest_you_item wait">
                      <img loading=""lazy src="https://picsum.photos/20/20" data-src="${urlGlobal}${
              single.field_cover_image
                ? single.field_cover_image
                : "/img/noimg.png"
            }" alt="${single.title}" class="lazyload">
                      <h3>${single.title}</h3>
                  </a>
                  `;
            interestYouContainer.innerHTML += templateInterest;
          });
        })
        .then(function () {
          lazyImages();
          sliderInteres();
          if ($(window).width() < 768) {
            circInterest();
          }
        });
    }
  }
}

if (document.querySelector("body.interna_atractivo")) {
  var data_product =
    document.querySelector("#mainInternPlace").dataset.productid;
  var productName =
    document.querySelector("#mainInternPlace").dataset.productname;
  var placeID = document.querySelector("#mainInternPlace").dataset.placeid;
  var placecoords =
    document.querySelector("#mainInternPlace").dataset.placecoords;
  var placezonerel =
    document.querySelector("#mainInternPlace").dataset.placezone;
  var counter = 0;
  var itemsProcessed = 0;
  function callback() {
    if (counter < 1200) {
      document.querySelector(
        ".interna_atractivo .descripton .map"
      ).style.columnSpan = "all";
      document.querySelector(
        ".interna_atractivo .descripton .txt .readMore"
      ).style.display = "none";
    }
  }
  // // Get IMages GAllery
  // const galleryImages = fetch(
  //   actualLang + "/g/gallery/?placeID=" + placeID
  // ).then((res) => res.json());
  // galleryImages
  //   .then(async (data) => {
  //     const galleryUlContainer = document.querySelector(
  //       ".gallery .gallery_dot"
  //     );
  //     const principalImage = document.querySelector("img#principal_img");
  //     let image = await getImageFromCacheOrFetch(
  //       `${urlGlobal}${data[0].replace(" ", "")}`
  //     );
  //     principalImage.setAttribute("data-src", image);
  //     galleryUlContainer.innerHTML = "";
  //     const promises = data.map(async (image, i) => {
  //       let miniImage = await getImageFromCacheOrFetch(
  //         `${urlGlobal}${image.replace(" ", "")}`
  //       );
  //       let templateImages = `<li class="${
  //         i == 0 && "active"
  //       }"><img loading="lazy" src="https://picsum.photos/20/20" data-src="${miniImage}" alt="Sitio web oficial de turismo de Bogotá" class="lazyload"></li>`;
  //       galleryUlContainer.innerHTML += templateImages;
  //     });

  //     return Promise.all(promises);
  //   })
  //   .then(() => {
  //     // Galeria Imagenes Internas atractivo
  //     if ($(".gallery_dot").length) {
  //       $(".gallery_dot li").hover(function (e) {
  //         $(".gallery_dot li.active").removeClass("active");
  //         $(e.target).addClass("active");
  //         var src = $($(e.target).children("img")).data("src");
  //         $(".gallery #principal_img").attr("src", src);
  //       });
  //     }
  //   })
  //   .then(() => {
  //     lazyImages();
  //   });
  document.querySelectorAll(".txt p").forEach((item, index, array) => {
    counter += counter + item.innerText.length;
    itemsProcessed++;
    if (itemsProcessed === array.length) {
      callback();
    }
  });
  interestYou(data_product);
  getBlogsRel(data_product, productName);
  // var url = "/" + actualLang + "/g/filterPortal/?filter=1&zone=" + placezonerel;
  // var closePlaces = [];
  // fetch(url)
  //   .then((response) => response.json())
  //   .then((places) => {
  //     shuffle(places);
  //     places.filter(function (place) {
  //       if (place.nid != placeID) {
  //         closePlaces.push(place);
  //       }
  //     });
  //   })
  //   .then(async () => {
  //     var containerPlaceZone = document.querySelector("#slidermobileArea");
  //     if (closePlaces.length <= 4) {
  //       if (document.querySelector(".do-area a.view_more")) {
  //         document.querySelector(".do-area a.view_more").style.display = "none";
  //       }
  //     }
  //     for (
  //       let counterPlaces = 0;
  //       counterPlaces < closePlaces.length;
  //       counterPlaces++
  //     ) {
  //       const place = closePlaces[counterPlaces];
  //       let subproductRelInfo = subproductsArray.filter(
  //         (sub) => sub.nid == place.field_subp.split(",")[0]
  //       );
  //       var productName = subproductRelInfo[0]
  //         ? subproductRelInfo[0].field_prod_rel_1
  //         : "all";
  //       var productID = subproductRelInfo[0]
  //         ? subproductRelInfo[0].field_prod_rel
  //         : "all";
  //       var urlPlace = `${actualLang}/atractivo/${get_alias(
  //         productName
  //       )}/${get_alias(place.title)}-${productID}-${place.nid}`;
  //       let image = await getImageFromCacheOrFetch(
  //         `${urlGlobal}${
  //           place.field_cover_image ? place.field_cover_image : "img/noimg.png"
  //         }`
  //       );
  //       var templatePlace = `
  //               <li class="do-area_list_item">
  //                   <a href="${urlPlace}" class="wait"><img loading="lazy" src="https://picsum.photos/20/20" data-src="${image}" alt="${place.title}" class="lazyload"></a>
  //                   <h4 class="name">${place.title}</h4>
  //               </li>`;
  //       if (counterPlaces < 4) {
  //         if (containerPlaceZone) {
  //           containerPlaceZone.innerHTML += templatePlace;
  //         }
  //       }
  //     }
  //   })
  //   .then(function () {
  //     // Que hacer en la zona
  //     if ($(window).width() > 768) {
  //       circQueHacerZona();
  //     }
  //     if ($(window).width() > 768) {
  //       circQueHacerZona();
  //     }
  //     lazyImages();
  //   });
}
if (document.querySelector("body.mas_alla")) {
  fetch(`/${actualLang}/g/nearbyPlaces/`)
    .then((res) => res.json())
    .then((nearby) => {
      var nearbyPlacesContainer = document.querySelector(
        ".alrededores_list_grid"
      );
      nearbyPlacesContainer.innerHTML = "";
      for (let index = 0; index < nearby.length; index++) {
        const nearbyPlace = nearby[index];
        const nearbyTitle = nearbyPlace.title;
        var template = `<li class="alrededores_list_grid_item"><a href="/${actualLang}/alrededor/${get_alias(
          nearbyTitle
        )}/${
          nearbyPlace.nid
        }" class="wait"><div class="img"><img loading="lazy" class="lazyload" data-src="${urlGlobal}${
          nearbyPlace.field_cover_image
            ? nearbyPlace.field_cover_image
            : "/img/noimg.png"
        }" src="https://picsum.photos/20/20" alt="Bogotá"></div><h2 class="name ">${nearbyTitle}</h2></a></li>`;
        nearbyPlacesContainer.innerHTML += template;
      }
    })
    .then(function () {
      lazyImages();
    });
  getBlogsRel();
}
if (document.querySelector("body.blog")) {
  interestYou();
}
if (document.querySelector("body.intern_blog")) {
  getBlogsRel();
}
if (document.querySelector("body.informacion_util")) {
  var classColor = ["green", "red", "blue"];
  const faqPromise = fetch(`/${actualLang}/g/faqs_categories/`);
  faqPromise
    .then((response) => response.json())
    .then((faqcats) => {
      var colorNumb = 0;
      faqcats.forEach((cat, i) => {
        if (i % 3 == 0) {
          colorNumb = 0;
        }
        fetch(`/${actualLang}/g/getFaqs/?faqCatID=${cat.tid}`)
          .then((res) => res.json())
          .then((singleFaq) => {
            if (singleFaq.length > 0) {
              if (document.querySelector(".faqs-container .faq")) {
                document.querySelector(
                  ".faqs-container .faq"
                ).innerHTML += `<h3 class=" cat-${cat.tid}">${cat.name}</h3>`;
                var accorddion = document.createElement("div");
                accorddion.classList.add("accordion");
                accorddion.classList.add(classColor[i]);
                singleFaq.forEach((qa) => {
                  document
                    .querySelector(".faqs-container .faq")
                    .appendChild(accorddion);
                  var templateCat = `<h4 class="">${qa.title}</h4><div>${qa.body}</div>`;
                  accorddion.innerHTML += templateCat;
                });
              }
            }
            colorNumb++;
          })
          .then(function () {
            $(".faq .accordion").accordion({
              header: "h4",
              active: false,
              heightStyle: "content",
              collapsible: true,
            });
          });
      });
    });

  slidersUtil();
}
if (document.querySelector("body.alrededor")) {
  var counter = 0;
  var itemsProcessed = 0;
  var data_product =
    document.querySelector("#mainInternPlace").dataset.productid;
  var productName =
    document.querySelector("#mainInternPlace").dataset.productname;
  var placeID = document.querySelector("#mainInternPlace").dataset.placeid;
  var placecoords =
    document.querySelector("#mainInternPlace").dataset.placecoords;
  getBlogsRel(data_product, productName);
  function callback() {
    if (counter < 1200) {
      document.querySelector(".alrededor .desc .map").style.columnSpan = "all";
      document.querySelector(".alrededor .desc .txt .readMore").style.display =
        "none";
    }
  }
  document.querySelectorAll(".txt p").forEach((item, index, array) => {
    counter += counter + item.innerText.length;
    itemsProcessed++;
    if (itemsProcessed === array.length) {
      callback();
    }
  });
}
function shuffle(array) {
  array.sort(() => Math.random() - 0.5);
}
function onlyUnique(value, index, self) {
  return self.indexOf(value) === index;
}

function filterSearch(type) {
  document.querySelectorAll(`#search_results .result`).forEach((result) => {
    $(result).fadeOut();
  });
  document
    .querySelectorAll(`#search_results .result[data-category=${type}]`)
    .forEach((result) => {
      $(result).fadeIn();
    });
  if (
    document.querySelectorAll(`#search_results .result[data-category=${type}]`)
      .length == 0
  ) {
    document.querySelectorAll(`#search_results`).innerHTML =
      "No se encontraron resultados para esta búsqueda";
  }
}
if (document.querySelector(".btn.phone-btn")) {
  document
    .querySelector(".btn.phone-btn")
    .addEventListener("click", function () {
      document.querySelector(".link_apps").style.transform = "scale(1.1)";
      setTimeout(() => {
        document.querySelector(".link_apps").style.transform = "scale(1)";
      }, 300);
    });
}

function setBackLinks(link) {
  if (link) {
    $(".isabacklink").attr("href", link);
  } else {
    $(".isabacklink").attr("href", "/");
  }
}

function getMoreReadBlogs() {
  fetch(`masleidos_${actualLang}.json`)
    .then((res) => res.json())
    .then((list) => {
      return list.sort((a, b) => (a.readings > b.readings ? -1 : 1));
    })
    .then((list) => {
      if (window.innerWidth > 1023) {
        document.querySelector(".lomasleido ol").innerHTML = "";
        list.forEach((el, i) => {
          if (i <= 4) {
            var title;
            if (el.title.length > 43) {
              title = el.title.substring(0, 43) + " ...";
            } else {
              title = el.title;
            }
            var template = `<li class=""><a href="${el.url}">${title}</a></li>`;
            document.querySelector(".lomasleido ol").innerHTML += template;
          }
        });
      } else {
        document.querySelector(".lomasleidomobile").innerHTML = "";
        list.forEach((el, i) => {
          if (i <= 4) {
            var title;
            if (el.title.length > 43) {
              title = el.title.substring(0, 43) + " ...";
            } else {
              title = el.title;
            }
            var template = `<li><a href="${el.url}"><span>${title}</span></a></li>`;
            document.querySelector(".lomasleidomobile").innerHTML += template;
          }
        });
      }
    });
}

function filterBlog(nid, title) {
  if (window.innerWidth > 1023) {
    return;
  } else if (nid == 0 && title == "Todos") {
    $(`.blog_list_mobile a`).fadeIn();
    document.querySelector(".fixed_filter span").innerHTML = title;
  } else {
    $(`.blog_list_mobile a`).fadeOut();
    $(`.blog_list_mobile a[data-productid="${nid}"]`).fadeIn();
    document.querySelector(".fixed_filter span").innerHTML = title;
  }
  document.querySelector("html, body").scrollTop =
    document.querySelector(".blog_list_mobile").offsetTop - 50;
}

function filterPortalMobile() {
  filters_plan = [];
  filters_especificos = [];
  filters_zonas = [];
  document
    .querySelectorAll(".filterMobile .filters_plan input:checked")
    .forEach((plan) => {
      filters_plan.push(plan.id);
    });
  document
    .querySelectorAll(".filterMobile .filters_especificos input:checked")
    .forEach((espec) => {
      filters_especificos.push(espec.id);
    });
  document
    .querySelectorAll(".filterMobile .filters_zonas input:checked")
    .forEach((zone) => {
      filters_zonas.push(zone.id);
    });
  if (data_product) {
    if (
      document.querySelectorAll(
        ".filterMobile .list_filters ul.filters_especificos li input:checked"
      ).length > 0
    ) {
      if (!$(".portal .container-switch .switch").hasClass("active")) {
        filterPortal(filters_plan, filters_especificos, filters_zonas, false);
      } else {
        filterPortal(filters_plan, filters_especificos, filters_zonas, [
          latitude,
          longitude,
        ]);
      }
    } else {
      if (!$(".portal .container-switch .switch").hasClass("active")) {
        filterPortal(
          filters_plan,
          initial_filters_especificos,
          filters_zonas,
          false
        );
      } else {
        filterPortal(filters_plan, initial_filters_especificos, filters_zonas, [
          latitude,
          longitude,
        ]);
      }
    }
  } else if (data_plan) {
    filters_plan = [];
    filters_plan.push(data_plan);
    initial_filters_plan.push(data_plan);
    if (
      document.querySelectorAll(
        ".filterMobile .list_filters ul.filters_especificos li input:checked"
      ).length > 0
    ) {
      if (!$(".portal .container-switch .switch").hasClass("active")) {
        filterPortal(data_plan, filters_especificos, filters_zonas, false);
      } else {
        filterPortal(data_plan, filters_especificos, filters_zonas, [
          latitude,
          longitude,
        ]);
      }
    } else {
      if (!$(".portal .container-switch .switch").hasClass("active")) {
        filterPortal(
          data_plan,
          initial_filters_especificos,
          filters_zonas,
          false
        );
      } else {
        filterPortal(data_plan, initial_filters_especificos, filters_zonas, [
          latitude,
          longitude,
        ]);
      }
    }
  } else if (data_zone) {
    filters_zonas = [];
    filters_zonas.push(data_zone);
    initial_filters_zonas.push(data_zone);
    if (
      document.querySelectorAll(
        ".filterMobile .list_filters ul.filters_especificos li input:checked"
      ).length > 0
    ) {
      if (!$(".portal .container-switch .switch").hasClass("active")) {
        filterPortal(filters_plan, filters_especificos, data_zone, false);
      } else {
        filterPortal(filters_plan, filters_especificos, data_zone, [
          latitude,
          longitude,
        ]);
      }
    } else {
      if (!$(".portal .container-switch .switch").hasClass("active")) {
        filterPortal(
          filters_plan,
          initial_filters_especificos,
          data_zone,
          false
        );
      } else {
        filterPortal(filters_plan, initial_filters_especificos, data_zone, [
          latitude,
          longitude,
        ]);
      }
    }
  }
  document.querySelector(".list_filters").classList.toggle("active");
  document.querySelector("html, body").scrollTop =
    document.querySelector(".portal_list").offsetTop + 150;
}

var sufijos = new Array();
sufijos = { es: "", fr: "fr", en: "en" };
var largo_sufijo = 2;
var separador = "/";

function changeLang(langCode) {
  var url = new URL(document.location);
  var pathArray = url.pathname.split("/");
  var currentLang = pathArray[1];

  if (currentLang === langCode) {
    return;
  }

  if (currentLang) {
    pathArray[1] = langCode;
  } else {
    pathArray.splice(1, 0, langCode);
  }

  url.pathname = pathArray.join("/");
  location.href = url.href;
}

function count_duplicate(a) {
  let counts = {};

  for (let i = 0; i < a.length; i++) {
    if (counts[a[i]]) {
      counts[a[i]] += 1;
    } else {
      counts[a[i]] = 1;
    }
  }
  var keys = Object.keys(counts);
  var min = counts[keys[0]]; // ignoring case of empty counts for conciseness
  var max = counts[keys[0]];
  var i;

  for (i = 1; i < keys.length; i++) {
    var value = counts[keys[i]];
    if (value < min) min = keys[i];
    if (value > max) max = keys[i];
  }
  return max;
}

async function getSingleSign(id) {
  const sign = await fetch("https://files.visitbogota.co/g/signlang/?id=" + id)
    .then((res) => res.json())
    .then((data) => ({
      title: data.title,
      img: `${urlGlobal}${data.field_langfile}`,
    }))
    .catch((err) => err);
  return sign;
}

document.querySelectorAll(".tooltip.fade").forEach((el) => {
  el.addEventListener("mouseover", async () => {
    let sign = await getSingleSign(el.dataset.signid);
    var styleElem = document.head.appendChild(document.createElement("style"));
    styleElem.innerHTML = `.tooltip.fade:before {background-image: url(${sign.img});}`;
  });
});

if (document.querySelector(".intern_event")) {
  var eventID = document.querySelector(".intern_event main").dataset.eventid;
  // // Get IMages GAllery
  // const galleryImages = fetch(
  //   actualLang + "/g/galleryEvents/?eventID=" + eventID
  // ).then((res) => res.json());
  // galleryImages
  //   .then((data) => {
  //     if (data.length > 0 && data[0] != "") {
  //       const galleryUlContainer = document.querySelector(
  //         ".gallery .gallery_dot"
  //       );
  //       const principalImage = document.querySelector("img#principal_img");
  //       principalImage.setAttribute(
  //         "data-src",
  //         urlGlobal + data[0].replace(" ", "")
  //       );
  //       galleryUlContainer.innerHTML = "";
  //       data.forEach((image, i) => {
  //         let templateImages = `<li class="${
  //           i == 0 && "active"
  //         }"><img loading="lazy" src="https://picsum.photos/20/20" data-src="${urlGlobal}${image.replace(
  //           " ",
  //           ""
  //         )}" alt="Sitio web oficial de turismo de Bogotá" class="lazyload"></li>`;
  //         galleryUlContainer.innerHTML += templateImages;
  //       });
  //     } else {
  //       document.querySelector(".gallery").style.display = "none";
  //     }
  //   })
  //   .then(() => {
  //     // Galeria Imagenes Internas atractivo
  //     if ($(".gallery_dot").length) {
  //       $(".gallery_dot li").hover(function (e) {
  //         $(".gallery_dot li.active").removeClass("active");
  //         $(e.target).addClass("active");
  //         var src = $($(e.target).children("img")).data("src");
  //         $(".gallery #principal_img").attr("src", src);
  //       });
  //     }
  //   })
  //   .then(() => {
  //     lazyImages();
  //   });
}

var filtersoptions = [];
var sliderobjects = [];

function setCategory(cattype) {
  if ($(window).width() <= 768) {
    $(".filtergroup").removeClass("open");
    $(".filtergroup").addClass("mobile");
    $(".mobilefilterbutton").click(function () {
      $(".filters").toggleClass("open");
    });
  }
  $(".filtergroup h4").click(function () {
    $(this).parent().toggleClass("open");
  });

  var counter = 0;
  $(".filtergroup.checkboxes").each(function () {
    $(this).addClass("loading");
    var group = $(this);
    var itscontent = $(this).find(".content");
    var filterid = $(this).data("filterid");

    $.post(
      "/hoteles/g/filter/?lang=" + actualLang,
      { filter: filterid },
      function (data) {
        data = JSON.parse(data);
        if (!filtersoptions[filterid]) {
          filtersoptions[filterid] = data;
        }
        for (var i = 0; i < data.length; i++) {
          var complement = "";
          if (group.hasClass("color")) {
            complement =
              '<b style="background:#' + data[i].field_color + ';"></b>';
          }
          let strtemplate;
          if (filterid == "rangos_de_precio") {
            strtemplate = `<p class="filtercheck fw500" data-filter="${
              data[i].tid
            }">${(function price() {
              let text = "";
              for (let index = 0; index < parseInt(data[i].name, 10); index++) {
                text += "$";
              }
              return text;
            })()}<input type="checkbox" value="${
              data[i].tid
            }" name="${filterid}" /></p>`;
          } else {
            strtemplate = `<p class="filtercheck fw500" data-filter="${data[i].tid}">${data[i].name} ${complement}<input type="checkbox" value="${data[i].tid}" name="${filterid}" /></p>`;
          }

          itscontent.append(strtemplate);
        }

        //useFilters(cattype);
        if (counter == $(".filtergroup.checkboxes").length - 1) {
          useFilters(cattype);
        }
        counter++;
        //
        group.removeClass("loading");

        $("#resetfilters").click(function () {
          for (var i = 0; i < sliderobjects.length; i++) {
            sliderobjects[i].slider("option", "value", minfilters);
          }

          $(".filtercheck").removeClass("active");
          for (var i = 0; i < $(".filtercheck").find("input").length; i++) {
            $(".filtercheck").find("input")[i].checked = false;
          }
          useFilters(cattype);
        });

        group.find(".filtercheck").click(function () {
          $(this).toggleClass("active");
          var input = $(this).find("input");
          if (input[0].checked == true) {
            input[0].checked = false;
          } else {
            input[0].checked = true;
          }
          useFilters(cattype);
        });
      }
    );
  });
}
function setMidnight(dateString) {
  const date = new Date(dateString);
  date.setHours(0, 0, 0, 0);
  return date;
}
function compararFechas(a, b) {
  // Si el evento no tiene fecha de finalización, usar la fecha de inicio
  const endDateA = a.field_end_date
    ? a.field_end_date.length === 10
      ? setMidnight(a.field_end_date)
      : new Date(a.field_end_date)
    : setMidnight(a.field_date);
  const endDateB = b.field_end_date
    ? b.field_end_date.length === 10
      ? setMidnight(b.field_end_date)
      : new Date(b.field_end_date)
    : setMidnight(b.field_date);

  return endDateA - endDateB;
}
function useFilters(cattype) {
  $(".filters").removeClass("open");
  var firstterm = true;
  var completefilters = { checkboxes: [] };

  $(".filtergroup.checkboxes").each(function () {
    var filterid = $(this).data("filterid");
    var values = new Array();

    if ($(this).find(".filtercheck.active").length == 0) {
      $(this)
        .find("input")
        .each(function () {
          values.push($(this).val());
        });
    } else {
      $(this)
        .find("input")
        .each(function () {
          if ($(this)[0].checked == true) {
            values.push($(this).val());
          }
        });
    }

    var group = {
      filter: filterid,
      value: values,
    };

    completefilters.checkboxes.push(group);

    for (var i = 0; i < completefilters.checkboxes.length; i++) {
      if (
        completefilters.checkboxes[i].value.length ==
          filtersoptions[completefilters.checkboxes[i].filter].length ||
        completefilters.checkboxes[i].value.length == 0
      ) {
        completefilters.checkboxes[i].value = [];
        completefilters.checkboxes[i].value.push("all");
      }
    }
  });
  $("#disabler").show();
  $(".events_list_grid").addClass("loading");
  var itscontent = $(".events_list_grid");
  itscontent.html("");
  let urlPost = `/g/${cattype}/?lang=${actualLang}`;

  $.post(urlPost, { filters: completefilters }, function (data) {
    // Ordenar el arreglo por fecha de finalización
    data.sort(compararFechas);
    if (data.length > 0) {
      for (var i = 0; i < data.length; i++) {
        let event = data[i];
        var thumbnail = data[i].field_cover_image;
        if (thumbnail == "") {
          thumbnail =
            "https://via.placeholder.com/400x400.jpg?text=Bogotadc.travel";
        }

        // Asegurarse de que las fechas se interpretan correctamente
        const dateStart = setMidnight(event.field_date);

        // Manejar la fecha de fin de manera diferente si no incluye una hora
        let dateEnd;
        if (event.field_end_date.length === 10) {
          // Verificar si el formato es solo de fecha (YYYY-MM-DD)
          dateEnd = setMidnight(event.field_end_date);
          dateEnd.setDate(dateEnd.getDate() + 1); // Mover la fecha de fin al día siguiente
        } else {
          dateEnd = setMidnight(event.field_end_date);
        }

        const options = {
          month: "long",
          day: "numeric",
          year: "numeric",
        };

        // Obtener la fecha actual
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        let dateText = "";

        if (actualLang === "es") {
          const dateFormattedStart = dateStart.toLocaleDateString(
            "es-ES",
            options
          );
          const dateFormattedEnd = dateEnd.toLocaleDateString("es-ES", options);
          console.log("🚀 ~ dateFormattedEnd:", dateFormattedEnd);
          const alText = "al";
          const hastaElText = "Hasta el";

          // Condicionales para construir el texto de fecha en español
          if (!event.field_end_date) {
            // 1. No tiene fecha final -> Tomar la fecha de inicio.
            dateText = dateFormattedStart;
          } else if (dateStart.getTime() === dateEnd.getTime()) {
            // 2. Fecha de inicio es igual a la fecha final, solo mostrar la fecha final.
            dateText = dateFormattedEnd;
          } else if (dateStart < today) {
            // 3. Si la fecha de inicio es menor a la fecha actual, quitar la fecha de inicio y colocar al principio "Hasta el".
            dateText = `${hastaElText} ${dateFormattedEnd}`;
          } else {
            // 4. Si la fecha de inicio es superior a la fecha actual, colocar así Fecha 1 al Fecha 2
            dateText = `${dateFormattedStart} ${alText} ${dateFormattedEnd}`;
          }
        } else if (actualLang === "en") {
          const dateFormattedStart = dateStart.toLocaleDateString(
            "en-US",
            options
          );
          const dateFormattedEnd = dateEnd.toLocaleDateString("en-US", options);
          console.log(dateEnd);

          // Condicionales para construir el texto de fecha en inglés
          if (!event.field_end_date) {
            // 1. No tiene fecha final -> Tomar la fecha de inicio.
            dateText = dateFormattedStart;
          } else if (dateStart.getTime() === dateEnd.getTime()) {
            // 2. Fecha de inicio es igual a la fecha final, solo mostrar la fecha final.
            dateText = dateFormattedEnd;
          } else if (dateStart < today) {
            // 3. Si la fecha de inicio es menor a la fecha actual, quitar la fecha de inicio y colocar al principio "Until".
            dateText = `Until ${dateFormattedEnd}`;
          } else if (dateStart.toDateString() === dateEnd.toDateString()) {
            // 4. Si las fechas son el mismo día, mostrar solo una fecha.
            dateText = dateFormattedStart;
          } else if (dateStart.getFullYear() === dateEnd.getFullYear()) {
            // 5. Si las fechas están en el mismo año
            if (dateStart.getMonth() === dateEnd.getMonth()) {
              // 5.1 Si están en el mismo mes
              dateText = `${dateFormattedStart.split(" ")[1]}-${
                dateFormattedEnd.split(" ")[1]
              } ${dateFormattedStart.split(" ")[0]} ${dateStart.getFullYear()}`;
            } else {
              // 5.2 Si están en meses diferentes
              dateText = `${dateFormattedStart.split(" ")[0]} ${
                dateFormattedStart.split(" ")[1]
              } to ${dateFormattedEnd.split(" ")[0]} ${
                dateFormattedEnd.split(" ")[1]
              } ${dateStart.getFullYear()}`;
            }
          } else {
            // 6. Fechas en años diferentes
            dateText = `${dateFormattedStart} to ${dateFormattedEnd}`;
          }
        }

        var strtemplate = `
          <li class="events_list_grid_item">
                <a href="/${actualLang}/evento/${get_alias(event.title)}-${
          event.nid
        }" class="single_event">
                    <div class="single_event_img">
                        <img loading="lazy" data-src="https://files.visitbogota.co${thumbnail}" src="https://picsum.photos/20/20"
                            alt="evento" class="lazyload">
                            <h5 class="single_event_title ms700 ">${
                              event.title
                            }</h5>
                    </div>
                    <div class="info">
                        <div class="single_event_date">
                        ${dateText}
                        </div>
                        <div class="txt">
                                <h6 class="single_event_place ms700"><svg width="23" height="33" viewBox="0 0 23 33" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_35_2)"><path d="M22.61 8.62C20.94 2.29 14.48 -1.36 8.19999 0.48C3.45999 1.87 0.0799887 6.3 -1.13287e-05 11.24C-0.0300113 13 0.339989 14.68 0.919989 16.32C1.84999 18.95 3.19999 21.37 4.75999 23.67C6.63999 26.45 8.57999 29.19 10.5 31.94C10.69 32.22 10.98 32.42 11.23 32.66H11.74C11.99 32.42 12.26 32.21 12.47 31.94C12.82 31.5 13.12 31.02 13.44 30.55C15.2 28 17 25.47 18.71 22.88C20.18 20.65 21.42 18.29 22.24 15.73C22.99 13.39 23.24 11.02 22.6 8.61L22.61 8.62ZM20.39 15.26C19.57 17.76 18.32 20.06 16.86 22.23C15.14 24.8 13.35 27.32 11.58 29.86C11.56 29.89 11.53 29.92 11.47 29.99C10.38 28.45 9.30999 26.95 8.23999 25.43C6.55999 23.03 4.92999 20.59 3.65999 17.93C2.88999 16.32 2.28999 14.67 2.00999 12.89C1.35999 8.75 3.63999 4.5 7.44999 2.79C13.09 0.25 19.45 3.41 20.83 9.44C21.28 11.42 21.01 13.35 20.38 15.25L20.39 15.26Z" fill="#35498F"/><path d="M11.51 5.74C8.34002 5.73 5.75002 8.3 5.74002 11.45C5.73002 14.62 8.30002 17.21 11.45 17.22C14.62 17.23 17.21 14.66 17.22 11.51C17.23 8.34 14.67 5.75 11.51 5.74ZM11.47 15.31C9.38002 15.31 7.66002 13.58 7.66002 11.49C7.66002 9.38 9.38002 7.65 11.49 7.66C13.6 7.66 15.32 9.39 15.32 11.5C15.32 13.61 13.59 15.33 11.48 15.32L11.47 15.31Z" fill="#35498F"/></g><defs><clipPath id="clip0_35_2"><rect width="22.97" height="32.66" fill="white"/></clipPath></defs></svg>${
                                  event.field_place
                                }</h6>
                                    <div class="btn event-view  ms900">${
                                      actualLang == "es"
                                        ? "Ver evento"
                                        : "View EVENT"
                                    }</div>
                        </div>
                    </div>
                </a>
            </li>`;
        itscontent.append(strtemplate);
      }
    } else {
      itscontent.append(
        `<p class="noresults">No hemos encontrado resultados</p>`
      );
    }

    $("#disabler").fadeOut("fast");
    $(".events_list_grid").removeClass("loading");
    var elements = document.getElementsByClassName("totalclick");
    for (var i = 0; i < elements.length; i++) {
      elements[i].addEventListener("click", function () {
        var link = this.querySelector("a");
        if (link) {
          link.click();
        }
      });
    }
    lazyImages();
  });
}
if (document.querySelector(".intern_event main .desc a")) {
  document.querySelector(".intern_event main .desc a").innerHTML =
    actualLang == "es"
      ? "Más información sobre el evento aquí"
      : "View more about this event";
  document
    .querySelector(".intern_event main .desc a")
    .classList.add("linkEvent");
  document
    .querySelector(".intern_event main .desc a")
    .setAttribute("target", "_blank");
}
let ofertasRelgrid = document.querySelector(".ofertasRel-grid");
if (ofertasRelgrid) {
  // Obtener el elemento <main>
  const mainElement = document.querySelector("main");
  // Validar si tiene el atributo data-zoneid definido
  if (mainElement.hasAttribute("data-zoneid")) {
    // Verificar si el valor del atributo es null, undefined o una cadena vacía
    const zoneIdValue = mainElement.getAttribute("data-zoneid");
  }
  if (document.querySelector(".interna_atractivo")) {
    getOfertasRel(
      document.querySelector("main").dataset.placeid,
      null,
      null,
      null
    );
  }
}

async function getOfertasRel(atractivo, localidad, zona, alojamiento) {
  const ofertasRelgrid = document.querySelector(".ofertasRel-grid");
  ofertasRelgrid.classList.add("loading");
  ofertasRelgrid.innerHTML = "";

  const queryParams = new URLSearchParams();
  if (Array.isArray(atractivo))
    queryParams.append("atractivo", atractivo.join("+"));
  else if (atractivo) queryParams.append("atractivo", atractivo);

  if (Array.isArray(localidad))
    queryParams.append("localidad", localidad.join("+"));
  else if (localidad) queryParams.append("localidad", localidad);

  if (Array.isArray(zona)) queryParams.append("zona", zona.join("+"));
  else if (zona) queryParams.append("zona", zona);

  if (Array.isArray(alojamiento))
    queryParams.append("alojamiento", alojamiento.join("+"));
  else if (alojamiento) queryParams.append("alojamiento", alojamiento);

  const url = `/${actualLang}/s/ofertasRel/?${queryParams.toString()}`;

  await fetch(url)
    .then((res) => res.json())
    .then((data) => {
      if (data) {
        const limite = data.length < 3 ? data.length : 3;
        data = shuffleArray(data);
        for (let index = 0; index < limite; index++) {
          const plan = data[index];
          const template = `
            <a href="/${actualLang}/experiencias-turisticas/plan/${get_alias(
            plan.title
          )}-${plan.nid}" class="ofertasRel-grid__item" 
               data-persons="${plan.field_maxpeople}" data-cat="${
            plan.field_categoria_comercial
          }" data-zone="${plan.field_pb_oferta_zona}">
              <div class="image">
                <img loading="lazy" class="lazyload" data-src="${
                  plan.field_pb_oferta_img_listado
                }" src="https://via.placeholder.com/330x240" alt="${
            plan.title
          }"/>
              </div>
              <div class="info">
                <div class="lines">
                  <div class="line1"></div>
                  <div class="line2"></div>
                </div>
                ${
                  plan.field_percent === 0
                    ? ""
                    : `<div class="discount ms900">
                        ${plan.field_percent}% <small class="ms500">DCTO</small>
                      </div>`
                }
                <div class="prices">
                  ${
                    plan.field_pa
                      ? `<p class="prices-discount ms500">$${number_format(
                          plan.field_pa,
                          0,
                          ".",
                          "."
                        )}</p>`
                      : ""
                  }
                  <p class="prices-total ms900">$${number_format(
                    plan.field_pd,
                    0,
                    ".",
                    "."
                  )}</p>
                </div>
                <strong class="ms900">${plan.title}</strong>
                <p class="ms100">${plan.field_pb_oferta_desc_corta}</p>
                <small class="link ms900 ">Ver oferta</small>
              </div>
            </a>`;
          ofertasRelgrid.innerHTML += template;
        }
        lazyImages();
      } else {
        document.querySelector(".ofertasRel").style.display = "none";
      }
    })
    .then(() => {
      ofertasRelgrid.classList.remove("loading");
    })
    .catch((error) => {
      console.error("Error fetching data:", error);
      ofertasRelgrid.classList.remove("loading");
    });
  lazyImages();
}

function shuffleArray(array) {
  // Creamos una copia del array para no modificar el original
  const shuffledArray = array.slice();

  // Algoritmo de Fisher-Yates para hacer el shuffle
  for (let i = shuffledArray.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [shuffledArray[i], shuffledArray[j]] = [shuffledArray[j], shuffledArray[i]];
  }

  return shuffledArray;
}

function addExternalLinkIcon() {
  let externalLinks = document.querySelectorAll('a[target="_blank"]');

  externalLinks.forEach((link) => {
    let svgContent = `
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="13px" height="13px">
        <path fill="currentColor" d="M 19.980469 2.9902344 A 1.0001 1.0001 0 0 0 19.869141 3 L 15 3 A 1.0001 1.0001 0 1 0 15 5 L 17.585938 5 L 8.2929688 14.292969 A 1.0001 1.0001 0 1 0 9.7070312 15.707031 L 19 6.4140625 L 19 9 A 1.0001 1.0001 0 1 0 21 9 L 21 4.1269531 A 1.0001 1.0001 0 0 0 19.980469 2.9902344 z M 5 3 C 3.9069372 3 3 3.9069372 3 5 L 3 19 C 3 20.093063 3.9069372 21 5 21 L 19 21 C 20.093063 21 21 20.093063 21 19 L 21 13 A 1.0001 1.0001 0 1 0 19 13 L 19 19 L 5 19 L 5 5 L 11 5 A 1.0001 1.0001 0 1 0 11 3 L 5 3 z"/>
      </svg>
      `;

    let svgWrapper = document.createElement("span");
    svgWrapper.innerHTML = svgContent;

    link.appendChild(svgWrapper);
  });
}

document.addEventListener("DOMContentLoaded", addExternalLinkIcon);

document.querySelector("#formBtn").addEventListener("click", () => {
  document.querySelectorAll(".search_form").forEach((el) => {
    el.classList.toggle("active");
  });
});

function formatDates(event, dateStart, dateEnd, actualLang, options) {
  const today = new Date();
  today.setHours(0, 0, 0, 0); // Establecemos la hora de la fecha actual a medianoche para comparaciones

  let dateText = "";

  if (actualLang === "es") {
    const dateFormattedStart = dateStart.toLocaleDateString("es-ES", options);
    const dateFormattedEnd = dateEnd.toLocaleDateString("es-ES", options);
    const alText = "al";
    const hastaElText = "Hasta el";

    // Condicionales para construir el texto de fecha en español
    if (!event.field_end_date) {
      // 1. No tiene fecha final -> Tomar la fecha de inicio.
      dateText = dateFormattedStart;
    } else if (dateStart.getTime() === dateEnd.getTime()) {
      // 2. Fecha de inicio es igual a la fecha final, solo mostrar la fecha final.
      dateText = dateFormattedEnd;
    } else if (dateStart < today) {
      // 3. Si la fecha de inicio es menor a la fecha actual, quitar la fecha de inicio y colocar al principio "Hasta el".
      dateText = `${hastaElText} ${dateFormattedEnd}`;
    } else {
      // 4. Si la fecha de inicio es superior a la fecha actual, colocar así Fecha 1 al Fecha 2
      dateText = `${dateFormattedStart} ${alText} ${dateFormattedEnd}`;
    }
  } else if (actualLang === "en") {
    const dateFormattedStart = dateStart.toLocaleDateString("en-US", options);
    const dateFormattedEnd = dateEnd.toLocaleDateString("en-US", options);

    // Condicionales para construir el texto de fecha en inglés
    if (!event.field_end_date) {
      // 1. No tiene fecha final -> Tomar la fecha de inicio.
      dateText = dateFormattedStart;
    } else if (dateStart.getTime() === dateEnd.getTime()) {
      // 2. Fecha de inicio es igual a la fecha final, solo mostrar la fecha final.
      dateText = dateFormattedEnd;
    } else if (dateStart < today) {
      // 3. Si la fecha de inicio es menor a la fecha actual, quitar la fecha de inicio y colocar al principio "Until".
      dateText = `Until ${dateFormattedEnd}`;
    } else if (dateStart.toDateString() === dateEnd.toDateString()) {
      // 4. Si las fechas son el mismo día, mostrar solo una fecha.
      dateText = dateFormattedStart;
    } else if (dateStart.getFullYear() === dateEnd.getFullYear()) {
      // 5. Si las fechas están en el mismo año
      if (dateStart.getMonth() === dateEnd.getMonth()) {
        // 5.1 Si están en el mismo mes
        dateText = `${dateFormattedStart.split(" ")[1]}-${
          dateFormattedEnd.split(" ")[1]
        } ${dateFormattedStart.split(" ")[0]} ${dateStart.getFullYear()}`;
      } else {
        // 5.2 Si están en meses diferentes
        dateText = `${dateFormattedStart.split(" ")[0]} ${
          dateFormattedStart.split(" ")[1]
        } to ${dateFormattedEnd.split(" ")[0]} ${
          dateFormattedEnd.split(" ")[1]
        } ${dateStart.getFullYear()}`;
      }
    } else {
      // 6. Fechas en años diferentes
      dateText = `${dateFormattedStart} to ${dateFormattedEnd}`;
    }
  }

  return dateText;
}

function useFiltersNew(cattype) {
  const completefilters = { selects: [] };

  // Recorremos cada grupo de filtros con selects
  document.querySelectorAll(".filtergroup.selects").forEach((group) => {
    const filterid = group.dataset.filterid;
    const values = [];
    const select = group.querySelector("select");

    // Si el valor seleccionado es diferente de "all", lo añadimos a los valores
    if (select && select.value !== "all") {
      values.push(select.value);
    }

    const filterGroup = {
      filter: filterid,
      value: values.length > 0 ? values : ["all"], // Si no hay valores, añadimos "all"
    };

    completefilters.selects.push(filterGroup);
  });

  const eventsListGrid = document.querySelector(".events_list_grid");
  eventsListGrid.classList.add("loading");
  eventsListGrid.innerHTML = "";

  // Construcción del URL para la consulta
  let urlPost = `/g/${cattype}/?agenda=${
    document.querySelector("main").dataset.agenda
  }&lang=${actualLang}`;

  // Hacer la consulta con Fetch, enviando los filtros como JSON
  fetch(urlPost, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ filters: completefilters }),
  })
    .then((response) => response.json())
    .then((data) => {
      // Ordenar los resultados por la fecha de finalización
      data.sort(compararFechas);

      if (data.length > 0) {
        data.forEach((event) => {
          const thumbnail =
            event.field_cover_image ||
            "https://via.placeholder.com/400x400.jpg?text=Bogotadc.travel";
          const dateStart = setMidnight(event.field_date);

          const dateEnd = event.field_end_date
            ? setMidnight(`${event.field_end_date}T20:00:02`)
            : dateStart;
          console.log(`${event.field_end_date}T20:00:02`);
          // Formatear las fechas según el idioma
          const options = { month: "long", day: "numeric", year: "numeric" };
          const dateText = formatDates(
            event,
            dateStart,
            dateEnd,
            actualLang,
            options
          );

          // Crear un objeto Date
          const date = new Date(dateStart);

          // Obtener una fecha en formato legible (DD/MM/YYYY o como prefieras)
          const day = date.getDate();
          const month = date.getMonth() + 1; // Los meses empiezan en 0, así que sumamos 1
          const year = date.getFullYear();

          // Formatear la fecha a "DD/MM/YYYY"
          const formattedDate = `${year}-${month}-${day}`;

          // Crear un objeto Date
          const dateEndN = new Date(dateEnd);
          // Obtener una fecha en formato legible (DD/MM/YYYY o como prefieras)
          const dayEnd = dateEndN.getDate();
          const monthEnd = dateEndN.getMonth() + 1; // Los meses empiezan en 0, así que sumamos 1
          const yearEnd = dateEndN.getFullYear();

          // Formatear la fecha a "DD/MM/YYYY"
          const formattedDateEnd = `${yearEnd}-${monthEnd}-${dayEnd}`;

          const strtemplate = `
            <li class="events_list_grid_item" data-date="${formattedDate}" data-dateEnd="${formattedDateEnd}" data-category="${
            event.field_categoria_evento
          }" data-zone="${event.field_zona_relacionada}">
              <a href="/${actualLang}/evento/${get_alias(event.title)}-${
            event.nid
          }" class="single_event">
                <div class="single_event_img">
                  <img loading="lazy" data-src="https://files.visitbogota.co${thumbnail}" src="https://picsum.photos/20/20"
                    alt="evento" class="lazyload">
                  <h5 class="single_event_title ms700">${event.title}</h5>
                </div>
                <div class="info">
                  <div class="single_event_date">${dateText}</div>
                  <div class="txt">
                    <h6 class="single_event_place ms700">
                      <svg width="23" height="33" viewBox="0 0 23 33" fill="none">
                        <g clip-path="url(#clip0_35_2)">
                          <path d="M22.61 8.62C20.94 2.29 14.48 -1.36 8.19999 0.48C3.45999 1.87 0.0799887 6.3 -1.13287e-05 11.24C-0.0300113 13 0.339989 14.68 0.919989 16.32C1.84999 18.95 3.19999 21.37 4.75999 23.67C6.63999 26.45 8.57999 29.19 10.5 31.94C10.69 32.22 10.98 32.42 11.23 32.66H11.74C11.99 32.42 12.26 32.21 12.47 31.94C12.82 31.5 13.12 31.02 13.44 30.55C15.2 28 17 25.47 18.71 22.88C20.18 20.65 21.42 18.29 22.24 15.73C22.99 13.39 23.24 11.02 22.6 8.61L22.61 8.62ZM20.39 15.26C19.57 17.76 18.32 20.06 16.86 22.23C15.14 24.8 13.35 27.32 11.58 29.86C11.56 29.89 11.53 29.92 11.47 29.99C10.38 28.45 9.30999 26.95 8.23999 25.43C6.55999 23.03 4.92999 20.59 3.65999 17.93C2.88999 16.32 2.28999 14.67 2.00999 12.89C1.35999 8.75 3.63999 4.5 7.44999 2.79C13.09 0.25 19.45 3.41 20.83 9.44C21.28 11.42 21.01 13.35 20.38 15.25L20.39 15.26Z" fill="#35498F"/>
                          <path d="M11.51 5.74C8.34002 5.73 5.75002 8.3 5.74002 11.45C5.73002 14.62 8.30002 17.21 11.45 17.22C14.62 17.23 17.21 14.66 17.22 11.51C17.23 8.34 14.67 5.75 11.51 5.74ZM11.47 15.31C9.38002 15.31 7.66002 13.58 7.66002 11.49C7.66002 9.38 9.38002 7.65 11.49 7.66C13.6 7.66 15.32 9.39 15.32 11.5C15.32 13.61 13.59 15.33 11.48 15.32L11.47 15.31Z" fill="#35498F"/>
                        </g>
                      </svg>${event.field_place}
                    </h6>
                    <div class="btn event-view ms900">${
                      actualLang == "es" ? "Ver evento" : "View EVENT"
                    }</div>
                  </div>
                </div>
              </a>
            </li>`;
          eventsListGrid.insertAdjacentHTML("beforeend", strtemplate);
        });
      } else {
        eventsListGrid.innerHTML =
          '<p class="noresults">No hemos encontrado resultados</p>';
      }

      eventsListGrid.classList.remove("loading");

      // Asigna eventos para lazy loading de imágenes, si es necesario
      lazyImages();
    });
}

function normalizeDate(dateString) {
  let dateParts = dateString.split("-");
  let year = dateParts[0];
  let month = dateParts[1].padStart(2, "0");
  let day = dateParts[2].padStart(2, "0");

  return `${year}-${month}-${day}`;
}

function updateSelectOptions(selectElement, validValues) {
  let options = selectElement.querySelectorAll("option");
  options.forEach((option) => {
    if (option.value === "" || validValues.includes(option.value)) {
      option.disabled = false; // Mostrar opción si es válida o es la opción por defecto
    } else {
      option.disabled = true; // Ocultar opción si no hay eventos visibles que coincidan
    }
  });
}

function filterEvents() {
  let searchQuery = document.getElementById("searchEvents").value.toLowerCase();
  let selectedDateStart = document.getElementById("dateStart").value;
  let selectedDateEnd = document.getElementById("dateEnd").value; // Nueva fecha de finalización
  let selectedCategory = document.querySelector(
    'select[name="categorias_eventos"]'
  ).value;
  let selectedZone = document.querySelector('select[name="test_zona"]').value;

  let events = document.querySelectorAll(".events_list_grid_item");
  let visibleCategories = new Set();
  let visibleZones = new Set();

  events.forEach(function (blogItem) {
    let eventTitle = blogItem
      .querySelector(".single_event_title")
      .textContent.toLowerCase();
    let eventDate = normalizeDate(
      blogItem.getAttribute("data-date").replace(/\//g, "-")
    );
    let eventDateEnd = normalizeDate(
      blogItem.getAttribute("data-dateend").replace(/\//g, "-")
    );

    let eventCategory = blogItem.getAttribute("data-category");
    let eventZone = blogItem.getAttribute("data-zone");

    // Condición de visibilidad: título, fechas (rango), categoría y zona
    let matchesTitle = eventTitle.includes(searchQuery);

    let matchesDate =
      (!selectedDateStart ||
        new Date(eventDate) >= new Date(selectedDateStart)) &&
      (!selectedDateEnd || new Date(eventDateEnd) <= new Date(selectedDateEnd));

    let matchesCategory =
      !selectedCategory || eventCategory === selectedCategory;
    let matchesZone = !selectedZone || eventZone === selectedZone;

    if (matchesTitle && matchesDate && matchesCategory && matchesZone) {
      console.log(blogItem);

      blogItem.style.display = ""; // Mostrar si cumple las condiciones
      visibleCategories.add(eventCategory); // Añadir categoría visible
      visibleZones.add(eventZone); // Añadir zona visible
    } else {
      blogItem.style.display = "none"; // Ocultar si no cumple las condiciones
    }
  });

  // Actualizar opciones en los selects de categorías y zonas
  updateSelectOptions(
    document.querySelector('select[name="categorias_eventos"]'),
    Array.from(visibleCategories)
  );
  updateSelectOptions(
    document.querySelector('select[name="test_zona"]'),
    Array.from(visibleZones)
  );
}

if (document.querySelector(".eventsnew")) {
  document.querySelectorAll(".filtergroup").forEach((group) => {
    const itscontent = group.querySelector(".content");
    const filterid = group.dataset.filterid;

    console.log(filterid);

    // Hacer la consulta para obtener los valores del filtro
    fetch(`/hoteles/g/filter/?lang=${actualLang}`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ filter: filterid }),
    })
      .then((response) => response.json())
      .then((filterData) => {
        // Si no hay datos para este filtro, no continuar
        if (!filterData || filterData.length === 0) {
          console.log(
            `El filtro con ID ${filterid} no tiene datos, no se mostrará.`
          );
          return; // Salir de la ejecución si no hay valores
        }

        // Hacer la consulta de eventos
        fetch(`/g/events/?lang=${actualLang}`, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            filters: {
              selects: [
                { filter: filterid, value: filterData.map((item) => item.tid) },
              ],
            },
          }),
        })
          .then((response) => response.json())
          .then((eventsData) => {
            // Crear los dos arreglos separados
            const categorias = eventsData.map(
              (event) => event.field_categoria_evento
            );
            const zonas = eventsData.map(
              (event) => event.field_zona_relacionada
            );

            // Si quieres obtener los valores únicos en cada uno de los arreglos
            const categoriasUnicas = [...new Set(categorias)];
            const zonasUnicas = [...new Set(zonas)];

            const selectElement = document.createElement("select");
            selectElement.name = filterid;
            selectElement.classList.add("filterselect", "fw500");

            // Agregar opción vacía al principio
            const emptyOption = document.createElement("option");
            emptyOption.value = ""; // Valor vacío
            emptyOption.innerHTML =
              actualLang === "es"
                ? "Selecciona una opción"
                : "Select an option";
            selectElement.appendChild(emptyOption);

            filterData.forEach((item) => {
              if (
                categoriasUnicas.some((el) => el == item.tid) ||
                zonasUnicas.some((el) => el == item.tid)
              ) {
                const optionElement = document.createElement("option");
                optionElement.value = item.tid;
                optionElement.innerHTML = item.name;
                if (group.classList.contains("color")) {
                  optionElement.style.backgroundColor = `#${item.field_color}`;
                }

                selectElement.appendChild(optionElement);
              }
            });

            itscontent.appendChild(selectElement);
            selectElement.addEventListener("change", filterEvents);
            // Asignar los eventos de entrada y cambio a los filtros
            document
              .getElementById("searchEvents")
              .addEventListener("input", filterEvents);
            document
              .getElementById("dateStart")
              .addEventListener("change", filterEvents);
            document
              .getElementById("dateEnd")
              .addEventListener("change", filterEvents);
          })
          .catch((error) =>
            console.error("Error fetching events data:", error)
          );
      })
      .catch((error) => console.error("Error fetching filter data:", error))
      .finally(() => {
        group.classList.remove("loading");
      });
  });
  useFiltersNew("events");
}
function filterBlogs() {
  let searchQuery = document.getElementById("searchEvents").value.toLowerCase();
  let selectedDateStart = document.getElementById("dateStart").value;
  let selectedDateEnd = document.getElementById("dateEnd").value; // Nueva fecha de finalización
  let selectedCategory = document.querySelector("select").value;

  let blogs = document.querySelectorAll(".blog_list .repeater .blog_item");
  let visibleCategories = new Set();

  blogs.forEach(function (eventItem) {
    let blogtitle = eventItem
      .querySelector(".desc h2")
      .textContent.toLowerCase();
    let blogDate = normalizeDate(
      eventItem.getAttribute("data-date").replace(/\//g, "-")
    );
    let blogDateEnd = normalizeDate(
      eventItem.getAttribute("data-date").replace(/\//g, "-")
    );
    const soloFecha = blogDate.split("T")[0];

    let blogCategory = eventItem.getAttribute("data-productid");

    // Condición de visibilidad: título, fechas (rango), categoría y zona
    let matchesTitle = blogtitle.includes(searchQuery);

    let matchesDate =
      (!selectedDateStart && !selectedDateEnd) || // Sin rango de fechas
      (selectedDateStart &&
        !selectedDateEnd &&
        new Date(soloFecha) >= new Date(selectedDateStart)) || // Solo fecha inicial
      (!selectedDateStart &&
        selectedDateEnd &&
        new Date(soloFecha) <= new Date(selectedDateEnd)) || // Solo fecha final
      (selectedDateStart &&
        selectedDateEnd && // Ambas fechas
        new Date(soloFecha) >= new Date(selectedDateStart) &&
        new Date(soloFecha) <= new Date(selectedDateEnd));

    let matchesCategory =
      !selectedCategory || blogCategory === selectedCategory;

    if (matchesTitle && matchesDate && matchesCategory) {
      eventItem.style.display = ""; // Mostrar si cumple las condiciones
      visibleCategories.add(blogCategory); // Añadir categoría visible
    } else {
      eventItem.style.display = "none"; // Ocultar si no cumple las condiciones
    }
  });

  // // Actualizar opciones en los selects de categorías y zonas
  updateSelectOptions(
    document.querySelector('select[name="categorias_blog"]'),
    Array.from(visibleCategories)
  );
}

if (document.querySelector(".blog")) {
  // Asignar los eventos de entrada y cambio a los filtros
  document
    .getElementById("searchEvents")
    .addEventListener("input", filterBlogs);
  document.getElementById("dateStart").addEventListener("change", filterBlogs);
  document.getElementById("dateEnd").addEventListener("change", filterBlogs);
  document
    .querySelector(`select[name="categorias_blog"]`)
    .addEventListener("change", filterBlogs);
}
