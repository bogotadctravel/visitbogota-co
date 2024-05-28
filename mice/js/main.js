var maxfilters = 0;
var minfilters = 0;
var capacityterms = ["maxaudit", "maxbanq", "maxaul", "maxu", "maxcoc"];
var filtersoptions = [];
var sliderobjects = [];
function getQueryParamsFiltervalue() {
  // Get the URL string
  var urlString = window.location.href;
  // Parse the URL string to create a URL object
  var url = new URL(urlString);
  // Get the value of the "id" parameter from the URL object
  var filtervalue = url.searchParams.get("filtervalue");
  return filtervalue;
}
function getQueryParamsFiltername() {
  // Get the URL string
  var urlString = window.location.href;
  // Parse the URL string to create a URL object
  var url = new URL(urlString);
  // Get the value of the "id" parameter from the URL object
  var filtervalue = url.searchParams.get("filtername");
  return filtervalue;
}
const filtervalue = getQueryParamsFiltername();
const filtername = getQueryParamsFiltervalue();
$(document).ready(function () {
  if ($(".mice-home").length > 0) {
    setHome();
  }
  if ($(".cards").length > 0) {
    setCategory($(".card-list").data("type"));
  }
});
function setHome() {
  $.get("get/links.php?lang=" + actualLang, function (data) {
    var itscontent = $(".known").find(".content");
    if (data.length > 0) {
      for (var i = 0; i < data.length; i++) {
        let link =
          data[i].field_micelink != ""
            ? data[i].field_micelink
            : `/${actualLang}/mice`;
        var strtemplate = `<a href="${link}" target="_blank"><img src="${absoluteURL(
          data[i].field_thumbnail
        )}" alt="imagen" /><h1>${data[i].title}</h1></a>`;
        itscontent.append(strtemplate);
      }
      $(".known").removeClass("loading");
    }
  });
  $.get("get/cases.php?lang=" + actualLang, function (data) {
    var itscontent = $(".success-stories").find(".content");
    if (data.length > 0) {
      for (var i = 0; i < data.length; i++) {
        var strtemplate =
          `<a href="#"
        ><img
          src="` +
          absoluteURL(data[i].field_thumbnail) +
          `"
          alt="` +
          data[i].title +
          `"
        /><b>` +
          data[i].title +
          `:</b>
        <p>` +
          data[i].field_sub_title +
          `</p></a>`;
        itscontent.append(strtemplate);
      }
      $(".success-stories").removeClass("loading");
    }
  });
}
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

  $.get("get/infognrl.php?lang=" + actualLang, function (data) {
    data = JSON.parse(data);
    maxfilters = parseInt(data.field_maxaforo);
    minfilters = parseInt(data.field_minaforo);

    if ($(".capacityfilter").length > 0) {
      $(".capacityfilter").each(function () {
        var theuislider = $(this).slider({
          min: minfilters,
          max: maxfilters,
          value: minfilters,
          create: function () {
            $(this).find(".custom-handle i").html($(this).slider("value"));
            $(this).parent().find(".writtenval").val($(this).slider("value"));
            $(this).find(".previousval").val($(this).slider("value"));

            var thisslider = $(this);
            $(this)
              .parent()
              .find(".writtenval")
              .focus(function () {
                $(this).select();
              });
            $(this)
              .parent()
              .find(".writtenval")
              .change(function () {
                if ($(this).val() > maxfilters) {
                  $(this).val(maxfilters);
                }
                if ($(this).val() < minfilters) {
                  $(this).val(minfilters);
                }
                thisslider.slider("value", $(this).val());
                //thisslider.find(".box").removeClass("open");
                thisslider.find(".custom-handle i").html($(this).val());
                thisslider.parent().find(".writtenval").val($(this).val());
                thisslider.find(".currentvalue").val($(this).val());
                //thisslider.find(".previousval").val($(this).val());

                if ($(this).val() == $(this).find(".previousval").val()) {
                  //Open input box
                  //$(this).find(".box").removeClass("open");
                } else {
                  thisslider.find(".previousval").val($(this).val());
                  useFilters(cattype);
                }
              });

            $(this)
              .parent()
              .find(".writtenval")
              .keypress(function (e) {
                var charCode = e.which ? e.which : event.keyCode;

                if (
                  String.fromCharCode(charCode).match(/[^0-9]/g) &&
                  charCode != 13
                )
                  return false;
              });
          },
          slide: function (event, ui) {
            //$(this).find(".box").removeClass("open");
            $(this).find(".custom-handle i").html(ui.value);
            $(this).parent().find(".writtenval").val(ui.value);
            $(this).find(".currentvalue").val(ui.value);
          },
          stop: function (event, ui) {
            if (ui.value == $(this).find(".previousval").val()) {
              //Open input box
              //$(this).find(".box").addClass("open");
              $(this).parent().find(".writtenval").select();
            } else {
              $(this).find(".previousval").val(ui.value);
              useFilters(cattype);
            }
          },
        });
        sliderobjects.push(theuislider);
      });
    }
    var counter = 0;
    $(".filtergroup.checkboxes").each(function () {
      $(this).addClass("loading");
      var group = $(this);
      var itscontent = $(this).find(".content");
      var filterid = $(this).data("filterid");

      $.post(
        "get/filter.php?lang=" + actualLang,
        { filter: filterid },
        function (data) {
          data = JSON.parse(data);
          //console.log(data);
          if (!filtersoptions[filterid]) {
            filtersoptions[filterid] = data;
          }
          for (var i = 0; i < data.length; i++) {
            var complement = "";
            if (group.hasClass("color")) {
              complement =
                '<b style="background:#' + data[i].field_color + ';"></b>';
            }

            var strtemplate =
              '<p class="filtercheck" data-filter="' +
              data[i].tid +
              '">' +
              data[i].name +
              "" +
              complement +
              '<input type="checkbox" value="' +
              data[i].tid +
              '" aria-label="' +
              filterid +
              '"  name="' +
              filterid +
              '" /></p>';
            itscontent.append(strtemplate);
          }

          if (counter == $(".filtergroup.checkboxes").length - 1) {
            if (filtervalue && filtername) {
              document
                .querySelector(`input[value="${filtername}"]`)
                .parentElement.click();
            } else {
              useFilters(cattype);
            }
          }
          counter++;
          //
          group.removeClass("loading");

          $("#resetfilters").click(function () {
            for (var i = 0; i < sliderobjects.length; i++) {
              sliderobjects[i].slider("option", "value", minfilters);
            }
            $(".capacityfilter")
              .find(".custom-handle")
              .html("<i>" + minfilters + "</i>");
            $(".capacityfilter").find("input").val(minfilters);
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
  });
}

function useFilters(cattype) {
  $(".filters").removeClass("open");
  var firstterm = true;
  var completefilters = { sliders: [], checkboxes: [] };
  if ($(".capacityfilter").length > 0) {
    for (var i = 0; i < capacityterms.length; i++) {
      if ($("#" + capacityterms[i]).val() > minfilters) {
        var element = {
          filter: capacityterms[i],
          value: $("#" + capacityterms[i]).val(),
        };

        completefilters.sliders.push(element);
      }
    }
  }

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

    /*console.log(completefilters.checkboxes);
    console.log(completefilters.checkboxes[0].filter);
    console.log(filtersoptions[completefilters.checkboxes[1].filter]);*/

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
  window.scrollTo(0, 0);

  $("#disabler").show();
  $(".cards").addClass("loading");
  var itscontent = $(".cards").find(".content");
  itscontent.html("");

  $.post(
    "get/" + cattype + ".php?lang=" + actualLang,
    { filters: completefilters },
    function (data) {
      if (data.length > 0) {
        for (var i = 0; i < data.length; i++) {
          if (cattype == "venues") {
            //console.log(data[i].nid);
            var thumbnail = data[i].field_thumbnail;

            if (thumbnail == "") {
              thumbnail =
                "https://via.placeholder.com/400x400.jpg?text=Bogotadc.travel";
            }
            var strtemplate =
              `<article class="card-item graybg totalclick"><a class="fw500 uppercase" href="/${actualLang}/mice/locacion/${get_alias(
                data[i].title
              )}-${data[i].nid}"><div class="flex">
                <figure class="column w_30 basic_bg" style="background-image:url(` +
              absoluteURL(thumbnail) +
              `">
                    <img loading="lazy" class="lazyload" src="https://picsum.photos/20/20" data-src="` +
              absoluteURL(thumbnail) +
              `" alt="` +
              data[i].title +
              `" />
                </figure>
                <div class="card-content column w_70">
                
                    <h1>` +
              data[i].title +
              `</h1>
                    <h2>` +
              data[i].field_venue_type_2 +
              `</h2>
                    <h3>
                        <span class="fw700">${miceinfo.field_mice_ui_8}</span>
                        <strong class="fwnormal">` +
              data[i].field_zone_rel_1 +
              `</strong>
                    </h3>
                </div>
            </div> 
            </a> 
        </article>`;
          }
          /*
          <ul class="colors">
                    <li style="background-color:#00A;"><span>Nombre certificaciÃ³n</span></li>
                    <li style="background-color:#00A;"><span>Nombre certificaciÃ³n</span></li>
                    <li style="background-color:#00A;"><span>Nombre certificaciÃ³n</span></li>
                    <li style="background-color:#00A;"><span>Nombre certificaciÃ³n</span></li>
                </ul>
          */
          if (cattype == "providers") {
            var thumbnail = data[i].field_thumbnail;

            if (thumbnail == "") {
              thumbnail =
                "https://via.placeholder.com/400x400.jpg?text=Bogotadc.travel";
            }

            var strtemplate =
              `<article class="card-item graybg totalclick"><a class="fw500 uppercase" href="/${actualLang}/mice/proveedor/${get_alias(
                data[i].title
              )}-${data[i].nid}"><div class="flex"> 
                                  <figure class="column w_30 basic_bg" style="background-image:url(` +
              absoluteURL(thumbnail) +
              `">
                                      <img loading="lazy" class="lazyload" src="https://picsum.photos/20/20" data-src="` +
              absoluteURL(thumbnail) +
              `" alt="` +
              data[i].title +
              `" />
                                  </figure>
                                  <div class="card-content column w_70">
                                 
                                      <h1>` +
              data[i].title +
              `</h1>
                                      <h2>` +
              data[i].field_miceprovsubcat_1 +
              `</h2>
                                  </div>
                              </div>  
                              </a>
                          </article>`;
          }

          itscontent.append(strtemplate);
        }
      } else {
        itscontent.append(
          `<p class="noresults">No hemos encontrado resultados</p>`
        );
      }
      lazyImages();
      $("#disabler").fadeOut("fast");
      $(".cards").removeClass("loading");
    }
  );
}

function absoluteURL(str) {
  if (str.indexOf("https") == -1) {
    return "https://files.visitbogota.co" + str.replace(/\s/g, "");
  } else {
    return str;
  }
}

if (document.querySelector(".internprovider-body")) {
  var providerid = document.querySelector(".internprovider-body main").dataset
    .providerid;
  const galleryImages = fetch(
    "get/galleryProvider.php?providerid=" + providerid + "&lang=" + actualLang
  ).then((res) => res.json());
  if (window.innerWidth > 768) {
    galleryImages
      .then((data) => {
        const galleryUlContainer = document.querySelector(
          ".internprovider-body .gallery.others .gallery_dot"
        );
        const principalImage = document.querySelector("#principal_img");
        principalImage.innerHTML = `<img src="${
          data[0] != "" ? absoluteURL(data[0]) : "../img/noimg.png"
        }" alt="imagen principal<"/>`;
        $(".imageText").text(
          document.querySelector("#principal_img img").getAttribute("alt")
        );
        galleryUlContainer.innerHTML = "";
        data.forEach((image, i) => {
          let templateImages = `<li class="${i == 0 && "active"}"><img src="${
            image != "" ? absoluteURL(image) : "../img/noimg.png"
          }" alt="imagen galeria"/></li>`;

          galleryUlContainer.innerHTML += templateImages;
        });
      })
      .then(() => {
        // Galeria Imagenes Internas atractivo
        if ($(".internprovider-body .gallery_dot").length) {
          $(".internprovider-body .gallery_dot li").hover(function (e) {
            $(".internprovider-body .gallery_dot li.active").removeClass(
              "active"
            );
            $(e.target).addClass("active");
            var src = $($(e.target).children("img")).attr("src");
            var alt = $($(e.target).children("img")).attr("alt");
            $(".internprovider-body .gallery.others #principal_img img").attr(
              "src",
              src
            );
            $(".imageText").text(alt);
          });
        }
      })
      .then(() => {
        lazyImages();
      });
  } else {
    galleryImages
      .then((data) => {
        const galleryUlContainer = document.querySelector(
          ".internprovider-body .gallery.others"
        );
        galleryUlContainer.innerHTML = "";
        data.forEach((image, i) => {
          let templateImages = `<li><img src="${absoluteURL(
            image
          )}" alt="imagen" /></li>`;
          galleryUlContainer.innerHTML += templateImages;
        });
      })
      .then(() => {
        $(".internprovider-body .gallery.others").slick({
          prevArrow:
            '<button type="button" class="slick-prev"><img src="img/arrow_l_slider.svg" alt="prev"></button>',
          nextArrow:
            '<button type="button" class="slick-next"><img src="img/arrow_r_slider.svg" alt="next"></button>',
          slidesToShow: 1,
          dots: false,
        });
      })
      .then(() => {
        lazyImages();
      });
  }
}

function decodeHtmlCharCodes(str) {
  return str.replace(/(&#(\d+);)/g, function (match, capture, charCode) {
    return String.fromCharCode(charCode);
  });
}

if (document.querySelector(".internVenue-body")) {
  let infoSalones = [];
  var venueid = document.querySelector(".internVenue-body main").dataset
    .venueid;
  const salonesImages = fetch(
    "get/getSalones.php?venueid=" + venueid + "&lang=" + actualLang
  ).then((res) => res.json());

  const galleryImages = fetch(
    "get/galleryVenues.php?venueid=" + venueid + "&lang=" + actualLang
  ).then((res) => res.json());

  salonesImages
    .then((data) => {
      if (data.length > 0) {
        document.querySelector("#salas .left ul").innerHTML = "";
        const salonGalleryUlContainer = document.querySelector(
          ".internVenue-body .galleryVenue.gallery .gallery_dot"
        );
        salonGalleryUlContainer.innerHTML = "";
        let templateImages = `<li class="active"><img src="${absoluteURL(
          data[0].field_salon_img
        )}" alt="galeria"/></li>`;
        let templateImages360 = `<li class="view360" data-room="${data[0].field_room360}"><img src="img/360view.svg" alt="imagen galeria"></li>`;
        data.forEach((salon, index) => {
          infoSalones.push({
            idsalon: salon.nid,
            auditorio: {
              cap: salon.field_au_cap,
              capdis: salon.field_au_capdis,
            },
            aula: {
              cap: salon.field_aula_cap,
              capdis: salon.field_aula_capdis,
            },
            u: {
              cap: salon.field_u_cap,
              capdis: salon.field_u_capdis,
            },
            coctel: {
              cap: salon.field_coctel_cap,
              capdis: salon.field_coctel_capdis,
            },
            banquete: {
              cap: salon.field_ban_cap,
              capdis: salon.field_ban_capdis,
            },
            room360: salon.field_room360,
            field_capacidad_metros: salon.field_capacidad_metros,
          });

          let hasta = decodeHtmlCharCodes(miceinfo.field_mice_ui_43).replace(
            "#",
            salon.field_maxcap
          );
          let template = `<li><button type="button" class="btn btn-sala ${
            index === 0 && "active"
          }" data-id="${salon.nid}"><span>${salon.field_title}</span>${
            salon.field_maxcap && `<small>${hasta}</small>`
          }</button></li>`;
          document.querySelector("#salas .left ul").innerHTML += template;
          document.querySelector(
            ".area .metroscuadrados"
          ).innerHTML = `${salon.field_capacidad_metros} m2`;
        });

        const principalImage = document.querySelector("#salon_principal_img");
        principalImage.innerHTML = `<img src="${absoluteURL(
          data[0].field_salon_img
        )}" alt="salon" />`;
        $(".galleryVenue.gallery .imageText").text("");

        salonGalleryUlContainer.innerHTML += templateImages;
        if (!!data[0].field_room360) {
          salonGalleryUlContainer.innerHTML += templateImages360;
          document.querySelectorAll(".view360").forEach((view) => {
            view.addEventListener("click", () => {
              let room = view.dataset.room.replace(
                "width='640' height='360'",
                "width='100%' height='900px'"
              );
              document.querySelector("#salon_principal_img").innerHTML = "";
              document.querySelector("#salon_principal_img").innerHTML = room;
            });
          });
        }
        return infoSalones;
      } else {
        document.querySelector("#salas").style.display = "none";
      }
    })
    .then((infoSalones) => {
      if (infoSalones) {
        let infoSalon = infoSalones.find(
          (salon) =>
            salon.idsalon ==
            document.querySelector(".btn.btn-sala.active").dataset.id
        );
        fetch("get/getFormatsSalas.php?lang=" + actualLang)
          .then((res) => res.json())
          .then((cats) => {
            const salonGalleryUlContainer = document.querySelector(
              ".internVenue-body .salas .right .gallery .disinfo ul"
            );
            salonGalleryUlContainer.innerHTML = "";
            cats.forEach((formato) => {
              let templateImages = "";
              switch (formato.tid) {
                case "36":
                  if (infoSalon.auditorio.cap || infoSalon.auditorio.capdis) {
                    templateImages = ` <li >
                    <div class="single">
                      <div class="image">
                      ${formato.field_format_icon.replace(
                        'src="/drpl',
                        'src="https://files.visitbogota.co/drpl'
                      )}
                      </div>
                        <span class="namedis">${formato.name}</span>
                    </div>
                    <div class="text">
                      <div class="text-left">
                        <span>${infoSalon.auditorio.cap}</span>
                        <small>Capacidad</small>
                      </div>
                    </div>
                  </li>`;
                  }
                  break;
                case "37":
                  if (infoSalon.aula.cap || infoSalon.aula.capdis) {
                    templateImages = ` <li >
                      <div class="single">
                        <div class="image">
                        ${formato.field_format_icon.replace(
                          'src="/drpl',
                          'src="https://files.visitbogota.co/drpl'
                        )}
                        </div>
                          <span class="namedis">${formato.name}</span>
                      </div>
                      <div class="text">
                        <div class="text-left">
                          <span>${infoSalon.aula.cap}</span>
                          <small>Capacidad</small>
                        </div>
                      </div>
                    </li>`;
                  }
                  break;
                case "38":
                  if (infoSalon.u.cap || infoSalon.u.capdis) {
                    templateImages = ` <li >
                      <div class="single">
                        <div class="image">
                        ${formato.field_format_icon.replace(
                          'src="/drpl',
                          'src="https://files.visitbogota.co/drpl'
                        )}
                        </div>
                          <span class="namedis">${formato.name}</span>
                      </div>
                      <div class="text">
                        <div class="text-left">
                          <span>${infoSalon.u.cap}</span>
                          <small>Capacidad</small>
                        </div>
                      </div>
                    </li>`;
                  }
                  break;
                case "39":
                  if (infoSalon.coctel.cap || infoSalon.coctel.capdis) {
                    templateImages = ` <li >
                      <div class="single">
                        <div class="image">
                        ${formato.field_format_icon.replace(
                          'src="/drpl',
                          'src="https://files.visitbogota.co/drpl'
                        )}
                        </div>
                          <span class="namedis">${formato.name}</span>
                      </div>
                      <div class="text">
                        <div class="text-left">
                          <span>${infoSalon.coctel.cap}</span>
                          <small>Capacidad</small>
                        </div>
                      </div>
                    </li>`;
                  }
                  break;
                case "40":
                  if (infoSalon.banquete.cap || infoSalon.banquete.capdis) {
                    templateImages = ` <li >
                      <div class="single">
                        <div class="image">
                        ${formato.field_format_icon.replace(
                          'src="/drpl',
                          'src="https://files.visitbogota.co/drpl'
                        )}
                        </div>
                          <span class="namedis">${formato.name}</span>
                      </div>
                      <div class="text">
                        <div class="text-left">
                          <span>${infoSalon.banquete.cap}</span>
                          <small>Capacidad</small>
                        </div>
                      </div>
                    </li>`;
                  }
                  break;
              }
              document.querySelector(
                ".area .metroscuadrados"
              ).innerHTML = `${infoSalon.field_capacidad_metros} m2`;
              salonGalleryUlContainer.innerHTML += templateImages;
            });
          })
          .then(() => {
            $(
              ".internVenue-body .galleryVenue.gallery .gallery_dot li.imagesMini"
            ).click(function (e) {
              var src = $($(e.target).children("img")).attr("src");
              document.querySelector(
                "#salon_principal_img"
              ).innerHTML = `<img src="${src}" width="1500" height="1001" alt="Four Seasons Casa Medina" typeof="foaf:Image" class="image-style-web">`;
            });
          });
        document.querySelectorAll(".btn.btn-sala").forEach((el) => {
          el.addEventListener("click", (e) => {
            document.querySelector(
              ".internVenue-body .salas .right .gallery .disinfo ul"
            ).style.opacity = 0;
            document
              .querySelector(".btn.btn-sala.active")
              .classList.remove("active");
            el.classList.add("active");
            salonesImages
              .then((data) => {
                let dataSalon = data.find(
                  (element) => element.nid == el.dataset.id
                );
                if (dataSalon) {
                  const salonGalleryUlContainer = document.querySelector(
                    ".internVenue-body .galleryVenue.gallery .gallery_dot"
                  );
                  salonGalleryUlContainer.innerHTML = "";
                  let templateImages = `<li class="active imagesMini"><img src="${absoluteURL(
                    dataSalon.field_salon_img
                  )}" alt="salon principal"/></li>`;
                  let templateImages360 = `<li class="view360" data-room="${dataSalon.field_room360}"><img src="img/360view.svg"> alt="salon"</li>`;
                  const principalImage = document.querySelector(
                    "#salon_principal_img"
                  );
                  principalImage.classList.add("loading");
                  principalImage.innerHTML = `<img src="${absoluteURL(
                    dataSalon.field_salon_img
                  )}" alt="salon" />`;
                  // $(".galleryVenue.gallery .imageText").text(
                  //   document
                  //     .querySelector("#salon_principal_img img")
                  //     .getAttribute("alt")
                  // );
                  salonGalleryUlContainer.innerHTML += templateImages;
                  if (!!dataSalon.field_room360) {
                    salonGalleryUlContainer.innerHTML += templateImages360;
                    document.querySelectorAll(".view360").forEach((view) => {
                      view.addEventListener("click", () => {
                        let room = view.dataset.room.replace(
                          "width='640' height='360'",
                          "width='100%' height='900px'"
                        );
                        document.querySelector(
                          "#salon_principal_img"
                        ).innerHTML = "";
                        document.querySelector(
                          "#salon_principal_img"
                        ).innerHTML = room;
                      });
                    });
                  }
                  document.querySelector(
                    "span.metroscuadrados"
                  ).innerHTML = `${dataSalon.field_capacidad_metros} m2`;
                }
              })
              .then(() => {
                document
                  .querySelector("#salon_principal_img")
                  .classList.remove("loading");
              });
            infoSalon = infoSalones.find(
              (salon) =>
                salon.idsalon ==
                document.querySelector(".btn.btn-sala.active").dataset.id
            );
            fetch("get/getFormatsSalas.php?lang=" + actualLang)
              .then((res) => res.json())
              .then((cats) => {
                const salonGalleryUlContainer = document.querySelector(
                  ".internVenue-body .salas .right .gallery .disinfo ul"
                );

                salonGalleryUlContainer.innerHTML = "";
                cats.forEach((formato) => {
                  let templateImages = "";
                  switch (formato.tid) {
                    case "36":
                      if (
                        infoSalon.auditorio.cap ||
                        infoSalon.auditorio.capdis
                      ) {
                        templateImages = ` <li >
                    <div class="single">
                      <div class="image">
                      ${formato.field_format_icon.replace(
                        'src="/drpl',
                        'src="https://files.visitbogota.co/drpl'
                      )}
                      </div>
                        <span class="namedis">Auditorio</span>
                    </div>
                    <div class="text">
                      <div class="text-left">
                        <span>${infoSalon.auditorio.cap}</span>
                        <small>Capacidad</small>
                      </div>
                    </div>
                  </li>`;
                      }
                      break;
                    case "37":
                      if (infoSalon.aula.cap || infoSalon.aula.capdis) {
                        templateImages = ` <li >
                      <div class="single">
                        <div class="image">
                        ${formato.field_format_icon.replace(
                          'src="/drpl',
                          'src="https://files.visitbogota.co/drpl'
                        )}
                        </div>
                          <span class="namedis">Aula</span>
                      </div>
                      <div class="text">
                        <div class="text-left">
                          <span>${infoSalon.aula.cap}</span>
                          <small>Capacidad</small>
                        </div>
                      </div>
                    </li>`;
                      }
                      break;
                    case "38":
                      if (infoSalon.u.cap || infoSalon.u.capdis) {
                        templateImages = ` <li >
                      <div class="single">
                        <div class="image">
                        ${formato.field_format_icon.replace(
                          'src="/drpl',
                          'src="https://files.visitbogota.co/drpl'
                        )}
                        </div>
                          <span class="namedis">U</span>
                      </div>
                      <div class="text">
                        <div class="text-left">
                          <span>${infoSalon.u.cap}</span>
                          <small>Capacidad</small>
                        </div>
                      
                      </div>
                    </li>`;
                      }
                      break;
                    case "39":
                      if (infoSalon.coctel.cap || infoSalon.coctel.capdis) {
                        templateImages = ` <li >
                      <div class="single">
                        <div class="image">
                        ${formato.field_format_icon.replace(
                          'src="/drpl',
                          'src="https://files.visitbogota.co/drpl'
                        )}
                        </div>
                          <span class="namedis">Coctel</span>
                      </div>
                      <div class="text">
                        <div class="text-left">
                          <span>${infoSalon.coctel.cap}</span>
                          <small>Capacidad</small>
                        </div>
                      </div>
                    </li>`;
                      }
                      break;
                    case "40":
                      if (infoSalon.banquete.cap || infoSalon.banquete.capdis) {
                        templateImages = ` <li >
                      <div class="single">
                        <div class="image">
                        ${formato.field_format_icon.replace(
                          'src="/drpl',
                          'src="https://files.visitbogota.co/drpl'
                        )}
                        </div>
                          <span class="namedis">Banquete</span>
                      </div>
                      <div class="text">
                        <div class="text-left">
                          <span>${infoSalon.banquete.cap}</span>
                          <small>Capacidad</small>
                        </div>
                      </div>
                    </li>`;
                      }
                      break;
                  }
                  salonGalleryUlContainer.innerHTML += templateImages;
                });
              })
              .then(() => {
                $(
                  ".internVenue-body .galleryVenue.gallery .gallery_dot li.imagesMini"
                ).click(function (e) {
                  var src = $($(e.target).children("img")).attr("src");
                  document.querySelector(
                    "#salon_principal_img"
                  ).innerHTML = `<img src="${src}" width="1500" height="1001" alt="Four Seasons Casa Medina" typeof="foaf:Image" class="image-style-web">`;
                });
                setTimeout(() => {
                  document.querySelector(
                    ".internVenue-body .salas .right .gallery .disinfo ul"
                  ).style.opacity = 1;
                }, 500);
              });
          });
        });
      }
    })
    .then(() => {});
  if (window.innerWidth > 768) {
    galleryImages
      .then((data) => {
        if (data.length > 0) {
          const galleryUlContainer = document.querySelector(
            ".internVenue-body .gallery.others .gallery_dot"
          );
          const principalImage = document.querySelector("#principal_img");
          if (principalImage) {
            principalImage.innerHTML = `<img src="${absoluteURL(
              data[0]
            )}" alt="imagen galeria" />`;
            $(".gallery.others .imageText").text("");
            galleryUlContainer.innerHTML = "";
            data.forEach((image, i) => {
              let templateImages = `<li class="${
                i == 0 && "active"
              }"><img src="${absoluteURL(image)}" alt="galeria" /></li>`;
              galleryUlContainer.innerHTML += templateImages;
            });
          }
        } else {
          document.querySelector(".images").style.display = "none";
        }
      })
      .then(() => {
        if ($(".internVenue-body .gallery.others .gallery_dot").length) {
          $(".internVenue-body .gallery.others .gallery_dot li").hover(
            function (e) {
              $(
                ".internVenue-body .gallery.others .gallery_dot li.active"
              ).removeClass("active");
              $(e.target).addClass("active");
              var src = $($(e.target).children("img")).attr("src");
              var alt = $($(e.target).children("img")).attr("alt");
              $(".internVenue-body .gallery.others #principal_img img").attr(
                "src",
                src
              );
              $(".gallery.others .imageText").text("");
            }
          );
        }
      })
      .then(() => {
        lazyImages();
      });
  } else {
    galleryImages
      .then((data) => {
        const galleryUlContainer = document.querySelector(
          ".internVenue-body .gallery.others"
        );
        galleryUlContainer.innerHTML = "";
        data.forEach((image, i) => {
          let templateImages = `<li><img src="${absoluteURL(
            image
          )}" alt= "imagen galeria"/></li>`;
          galleryUlContainer.innerHTML += templateImages;
        });
      })
      .then(() => {
        $(".internVenue-body .gallery.others").slick({
          prevArrow:
            '<button type="button" class="slick-prev"><img src="img/arrow_l_slider.svg" alt="prev"></button>',
          nextArrow:
            '<button type="button" class="slick-next"><img src="img/arrow_r_slider.svg" alt="next"></button>',
          slidesToShow: 1,
          dots: false,
        });
      })
      .then(() => {
        lazyImages();
      });
  }

  let venuetypeSingleVenue = document.querySelector(".internVenue-body main")
    .dataset.venuetype;
  let venuezoneSingleVenue = document.querySelector(".internVenue-body main")
    .dataset.venuezone;
  let aforoSingleVenue = document.querySelector(".internVenue-body main")
    .dataset.aforo;

  relVenues(
    venuetypeSingleVenue,
    venuezoneSingleVenue,
    `${aforoSingleVenue},${aforoMax}`
  );
}

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

function relVenues(type, zone, aforo) {
  let idSingleVenue = document.querySelector(".internVenue-body main").dataset
    .venueid;
  var containerGridVenues = document.querySelector(".grid-venues");
  containerGridVenues.innerHTML = "";
  // Create URL to FETCH
  var url = "get/getVenues.php?filter=1&lang=" + actualLang;
  if (type) url += "&type=" + type;
  if (zone) url += "&zone=" + zone;
  if (aforo) url += "&aforo=" + aforo;

  // Fetch final URL
  fetch(url)
    .then((response) => response.json())
    .then((venues) => {
      if (venues.length > 1) {
        for (let index = 0; index < 4 && index < venues.length; index++) {
          const venue = venues[index];
          if (venue.nid != idSingleVenue) {
            var venueUrl = `/${actualLang}/mice/locacion/${get_alias(
              venue.title
            )}-${venue.nid}`;
            var template = `
            <li>
            <a href="${venueUrl}">
            <img loading="lazy" src="https://picsum.photos/20/20" data-src="${urlGlobal}${
              venue.field_thumbnail ? venue.field_thumbnail : "img/noimg.png"
            }" alt="${venue.title}" class="lazyload">
              <div class="data">
                <div>
                  <h4>${venue.title}</h4>
                </div>
                <div class="flex">
                ${
                  venue.field_micem2 &&
                  `<div class="sala">
                  <small>${miceinfo.field_mice_ui_7}</small>
                  <p>${venue.field_micem2} m²</p>
                </div>`
                }
                  
                  <div class="localidad">
                    <small>${miceinfo.field_mice_ui_8}</small>
                    <p>${venue.field_zone_rel_1}</p>
                  </div>
                </div>
              </div>
            </a>
          </li>`;
            containerGridVenues.innerHTML += template;
          }
        }
      } else if (venues.length == 1) {
        for (let index = 0; index < 4 && index < venues.length; index++) {
          const venue = venues[index];
          if (venue.nid == idSingleVenue) {
            document.querySelector(".relVenues").style.display = "none";
          }
        }
      } else {
        document.querySelector(".relVenues").style.display = "none";
      }
    })
    .then(function () {
      lazyImages();
      $(".venuesList .right").toggleClass("loading");
    });
}
if (document.querySelector(".internVenue-body")) {
  var venueid = document.querySelector(".internVenue-body main").dataset
    .venueid;
  const galleryImages = fetch(
    "get/galleryVenues.php?venueid=" + venueid + "&lang=" + actualLang
  ).then((res) => res.json());
  galleryImages
    .then((data) => {
      const galleryUlContainer = document.querySelector(
        ".internVenue-body .gallery.others .gallery_dot"
      );
      const principalImage = document.querySelector("#principal_img");
      if (principalImage) {
        principalImage.innerHTML = `<img src="${absoluteURL(
          data[0]
        )}" alt="locacion" />`;
        $(".gallery.others .imageText").text("");
        galleryUlContainer.innerHTML = "";
        data.forEach((image, i) => {
          let templateImages = `<li class="${
            i == 0 && "active"
          }"><img src="${absoluteURL(image)}" alt="imagen" /></li>`;
          galleryUlContainer.innerHTML += templateImages;
        });
      }
    })
    .then(() => {
      if ($(".internVenue-body .gallery.others .gallery_dot").length) {
        $(".internVenue-body .gallery.others .gallery_dot li").hover(function (
          e
        ) {
          $(
            ".internVenue-body .gallery.others .gallery_dot li.active"
          ).removeClass("active");
          $(e.target).addClass("active");
          var src = $($(e.target).children("img")).attr("src");
          var alt = $($(e.target).children("img")).attr("alt");
          $(".internVenue-body .gallery.others #principal_img img").attr(
            "src",
            src
          );
          $(".gallery.others .imageText").text("");
        });
      }
    })
    .then(() => {
      lazyImages();
    });
}

function relproviders(type) {
  var containerGridproviders = document.querySelector(
    ".relProviders .grid-providers"
  );
  containerGridproviders.innerHTML = "";
  // Create URL to FETCH
  var url = "get/getProviders.php?filter=1&lang=" + actualLang;
  if (type) url += "&type=" + type;

  // Fetch final URL
  fetch(url)
    .then((response) => response.json())
    .then((providers) => {
      if (providers.length > 0) {
        for (let index = 0; index < 4; index++) {
          const provider = providers[index];
          var providerUrl = `/${actualLang}/mice/proveedor/${get_alias(
            provider.title
          )}-${provider.nid}`;
          var template = `
          <li>
          <a href="${providerUrl}">
          <img loading="lazy" src="https://picsum.photos/20/20" data-src="${
            provider.field_thumbnail
              ? absoluteURL(provider.field_thumbnail)
              : "../img/noimg.png"
          }" alt="${provider.title}" class="lazyload">
          <div class="data">
          <h4>${provider.title}</h4>
          <h5>${provider.field_miceprovsubcat_1}</h5>
          </div>
          </a></li>`;
          containerGridproviders.innerHTML += template;
        }
      } else {
        document.querySelector(".relproviders").style.display = "none";
      }
    })
    .then(function () {
      lazyImages();
      $(".providersList .right").toggleClass("loading");
    });
}

if (document.querySelector(".internprovider-body main")) {
  relproviders(
    document.querySelector(".internprovider-body main").dataset.providertype
  );
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
  str = str.replace(/ de /g, "-", str); //Espacios
  str = str.replace(/ y /g, "-", str); //Espacios
  str = str.replace(/ a /g, "-", str); //Espacios
  str = str.replace(/ DE /g, "-", str); //Espacios
  str = str.replace(/ A /g, "-", str); //Espacios
  str = str.replace(/ Y /g, "-", str); //Espacios
  str = str.replace(/ /g, "-", str); //Espacios
  str = str.replace(/  /g, "-", str); //Espacios
  str = str.replace(/\./g, "", str); //Punto
  str = str.replace("&", "", str); //
  str = str.replace("amp;", "", str); //

  //Mayusculas
  str = str.toLowerCase();

  return str;
}
