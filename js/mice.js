$(document).ready(function () {
  $(".galleryVenue .gallery_dot li").hover(function (e) {
    $(".galleryVenue .gallery_dot li.active").removeClass("active");
    $(e.target).addClass("active");
    var src = $($(e.target).children("img")).data("src");
    var txt = $($(e.target).children("img")).data("txt");
    $(".galleryVenue #principal_img").attr("src", src);
    $(".galleryVenue small.imageText").html(txt);
  });
  $(".gallery.others .gallery_dot li").hover(function (e) {
    $(".gallery.others .gallery_dot li.active").removeClass("active");
    $(e.target).addClass("active");
    var src = $($(e.target).children("img")).data("src");
    var txt = $($(e.target).children("img")).data("txt");
    $(".gallery.others #principal_img").attr("src", src);
    $(".gallery.others small.imageText").html(txt);
  });
  $(".internStorie .gallery .gallery_dot li").hover(function (e) {
    $(".internStorie .gallery .gallery_dot li.active").removeClass("active");
    $(e.target).addClass("active");
    var src = $($(e.target).children("img")).data("src");
    var txt = $($(e.target).children("img")).data("txt");
    $(".internStorie .gallery #principal_img").attr("src", src);
    $(".internStorie .gallery small.imageText").html(txt);
  });
  let filterbtn1 = document.querySelector("#filterbtn1");
  if (filterbtn1) {
    filterbtn1.addEventListener("click", () => {
      if (document.querySelector(".container-btns button.active")) {
        document
          .querySelector(".container-btns button.active")
          .classList.toggle("active");
      }
      if (document.querySelector("#filter2.active")) {
        document.querySelector("#filter2.active").classList.toggle("active");
      }
      if (document.querySelector(".filter3.active")) {
        document.querySelector(".filter3.active").classList.toggle("active");
      }
      filterbtn1.classList.toggle("active");
      document.querySelector("#filter1").classList.toggle("active");
    });
  }

  let filterbtn2 = document.querySelector("#filterbtn2");
  if (filterbtn2) {
    filterbtn2.addEventListener("click", () => {
      if (document.querySelector(".container-btns button.active")) {
        document
          .querySelector(".container-btns button.active")
          .classList.toggle("active");
      }
      if (document.querySelector("#filter1.active")) {
        document.querySelector("#filter1.active").classList.toggle("active");
      }
      if (document.querySelector(".filter3.active")) {
        document.querySelector(".filter3.active").classList.toggle("active");
      }
      filterbtn2.classList.toggle("active");
      document.querySelector("#filter2").classList.toggle("active");
    });
  }

  let filterbtn3 = document.querySelector("#filterbtn3");
  if (filterbtn3) {
    filterbtn3.addEventListener("click", () => {
      if (document.querySelector(".container-btns button.active")) {
        document
          .querySelector(".container-btns button.active")
          .classList.toggle("active");
      }
      if (document.querySelector(".filter1.active")) {
        document.querySelector(".filter1.active").classList.toggle("active");
      }
      if (document.querySelector(".filter2.active")) {
        document.querySelector(".filter2.active").classList.toggle("active");
      }
      document.querySelector(".filter3").classList.toggle("active");
    });
  }
  if (
    document.querySelector(".searchMICE") ||
    document.querySelector("#filter1") ||
    document.querySelector("#filter2")
  ) {
    getMICEData();
  }
  if (document.querySelector(".filters_format")) {
    getfiltersMICE();
  }
  if (document.querySelector(".airport main .wrapper")) {
    document.querySelector("main").style.height =
      document.querySelector(".airport main .wrapper").scrollHeight + "px";
  }
});

document
  .querySelectorAll("#filter1 .selects-container .select")
  .forEach((select) => {
    select.addEventListener("click", () => {
      if (
        document.querySelector("#filter1 .selects-container .select.active")
      ) {
        document
          .querySelector("#filter1 .selects-container .select.active")
          .classList.remove("active");
      }
      select.classList.toggle("active");
      if (document.querySelector(`#filter1 .options.active`)) {
        document
          .querySelector(`#filter1 .options.active`)
          .classList.remove("active");
      }
      document
        .querySelector(`#filter1 .options.${select.dataset.options}`)
        .classList.toggle("active");
    });
  });
document
  .querySelectorAll("#filter2 .selects-container .select")
  .forEach((select) => {
    select.addEventListener("click", () => {
      if (
        document.querySelector("#filter2 .selects-container .select.active")
      ) {
        document
          .querySelector("#filter2 .selects-container .select.active")
          .classList.remove("active");
      }
      select.classList.toggle("active");
      if (document.querySelector(`#filter2 .options.active`)) {
        document
          .querySelector(`#filter2 .options.active`)
          .classList.remove("active");
      }
      document
        .querySelector(`#filter2 .options.${select.dataset.options}`)
        .classList.toggle("active");
    });
  });
document
  .querySelectorAll(".steps-home #filter1 .selects-container .select")
  .forEach((select) => {
    select.addEventListener("click", () => {
      if (
        document.querySelector(
          ".steps-home #filter1 .selects-container .select.active"
        )
      ) {
        document
          .querySelector(
            ".steps-home #filter1 .selects-container .select.active"
          )
          .classList.remove("active");
      }
      select.classList.toggle("active");
      if (document.querySelector(`.steps-home #filter1 .options.active`)) {
        document
          .querySelector(`.steps-home #filter1 .options.active`)
          .classList.remove("active");
      }
      document
        .querySelector(
          `.steps-home #filter1 .options.${select.dataset.options}`
        )
        .classList.toggle("active");
    });
  });
document
  .querySelectorAll(".steps-home #filter2 .selects-container .select")
  .forEach((select) => {
    select.addEventListener("click", () => {
      if (
        document.querySelector(
          ".steps-home #filter2 .selects-container .select.active"
        )
      ) {
        document
          .querySelector(
            ".steps-home #filter2 .selects-container .select.active"
          )
          .classList.remove("active");
      }
      select.classList.toggle("active");
      if (document.querySelector(`.steps-home #filter2 .options.active`)) {
        document
          .querySelector(`.steps-home #filter2 .options.active`)
          .classList.remove("active");
      }
      document
        .querySelector(
          `.steps-home #filter2 .options.${select.dataset.options}`
        )
        .classList.toggle("active");
    });
  });

Array.prototype.max = function () {
  return Math.max.apply(null, this);
};

Array.prototype.min = function () {
  return Math.min.apply(null, this);
};

function getVenues() {
  fetch(actualLang + "/g/getVenues/")
    .then((res) => res.json())
    .then((venues) => {});
}

if (document.querySelector(".internprovider-body")) {
  var providerid = document.querySelector(".internprovider-body main").dataset
    .providerid;
  const galleryImages = fetch(
    actualLang + "/g/galleryProvider/?providerid=" + providerid
  ).then((res) => res.json());
  if (window.innerWidth > 768) {
    galleryImages
      .then((data) => {
        const galleryUlContainer = document.querySelector(
          ".internprovider-body .gallery.others .gallery_dot"
        );
        const principalImage = document.querySelector("#principal_img");
        principalImage.innerHTML = data[0];
        $(".imageText").text(
          document.querySelector("#principal_img img").getAttribute("alt")
        );
        galleryUlContainer.innerHTML = "";
        data.forEach((image, i) => {
          let templateImages = `<li class="${
            i == 0 && "active"
          }">${image}</li>`;
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
          let templateImages = `<li>${image}</li>`;
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
if (document.querySelector(".internVenue-body")) {
  let infoSalones = [];
  var venueid = document.querySelector(".internVenue-body main").dataset
    .venueid;
  const salonesImages = fetch(
    actualLang + "/g/getSalones/?venueid=" + venueid
  ).then((res) => res.json());

  const galleryImages = fetch(
    actualLang + "/g/galleryVenues/?venueid=" + venueid
  ).then((res) => res.json());

  salonesImages
    .then((data) => {
      if (data.length > 0) {
        document.querySelector("#salas .left ul").innerHTML = "";
        const salonGalleryUlContainer = document.querySelector(
          ".internVenue-body .galleryVenue.gallery .gallery_dot"
        );
        salonGalleryUlContainer.innerHTML = "";
        let templateImages = `<li class="active">${data[0].field_salon_img}</li>`;
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
          });
          let template = `<li><button type="button" class="btn btn-sala ${
            index === 0 && "active"
          }" data-id="${salon.nid}"><span>${salon.field_title}</span>${
            salon.field_maxcap &&
            `<small>Hasta ${salon.field_maxcap} personas</small>`
          }</button></li>`;
          document.querySelector("#salas .left ul").innerHTML += template;
          document.querySelector(
            ".area .metroscuadrados"
          ).innerHTML = `${salon.field_capacidad_metros} m2`;
        });

        const principalImage = document.querySelector("#salon_principal_img");
        principalImage.innerHTML = data[0].field_salon_img;
        $(".galleryVenue.gallery .imageText").text(
          document.querySelector("#salon_principal_img img").getAttribute("alt")
        );

        salonGalleryUlContainer.innerHTML += templateImages;
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
        fetch(actualLang + "/g/getFormatsSalas/")
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
                      ${formato.field_format_icon}
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
                        ${formato.field_format_icon}
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
                        ${formato.field_format_icon}
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
                        ${formato.field_format_icon}
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
                        ${formato.field_format_icon}
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
              ".internVenue-body .galleryVenue.gallery .gallery_dot li.dotinfo"
            ).hover(function (e) {
              document.querySelector(
                ".internVenue-body .salas .right .gallery #salon_dis_info"
              ).style.opacity = 1;
              $(".internVenue-body .gallery_dot li.active").removeClass(
                "active"
              );
              $(e.target).addClass("active");
              var src = $($(e.target).children("img")).attr("src");
              var alt = $($(e.target).children("img")).attr("alt");
              var nameFormato = $(e.target).data("format");
              var cap = $(e.target).data("cap");
              var capdis = $(e.target).data("capdis");
              document.querySelector(
                ".internVenue-body .salas .right .gallery #salon_dis_info .name_cap ul li h4.cap"
              ).innerHTML = cap;
              document.querySelector(
                ".internVenue-body .salas .right .gallery #salon_dis_info .name_cap ul li h4.capdis"
              ).innerHTML = capdis;
              document.querySelector(
                ".internVenue-body .salas .right .gallery #salon_dis_info .name_dis h3.nameformat"
              ).innerHTML = nameFormato;
              $(
                ".internVenue-body .salas .right .gallery #salon_dis_info .image img"
              ).attr("src", src);
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
                  let templateImages = `<li class="active">${dataSalon.field_salon_img}</li>`;
                  const principalImage = document.querySelector(
                    "#salon_principal_img"
                  );
                  principalImage.classList.add("loading");
                  principalImage.innerHTML = dataSalon.field_salon_img;
                  $(".galleryVenue.gallery .imageText").text(
                    document
                      .querySelector("#salon_principal_img img")
                      .getAttribute("alt")
                  );
                  salonGalleryUlContainer.innerHTML += templateImages;
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
            fetch(actualLang + "/g/getFormatsSalas/")
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
                      ${formato.field_format_icon}
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
                        ${formato.field_format_icon}
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
                        ${formato.field_format_icon}
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
                        ${formato.field_format_icon}
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
                        ${formato.field_format_icon}
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
                  ".internVenue-body .galleryVenue.gallery .gallery_dot li.dotinfo"
                ).hover(function (e) {
                  document.querySelector(
                    ".internVenue-body .salas .right .gallery #salon_dis_info"
                  ).style.opacity = 1;
                  $(".internVenue-body .gallery_dot li.active").removeClass(
                    "active"
                  );
                  $(e.target).addClass("active");
                  var src = $($(e.target).children("img")).attr("src");
                  var alt = $($(e.target).children("img")).attr("alt");
                  var nameFormato = $(e.target).data("format");
                  var cap = $(e.target).data("cap");
                  var capdis = $(e.target).data("capdis");
                  document.querySelector(
                    ".internVenue-body .salas .right .gallery #salon_dis_info .name_cap ul li h4.cap"
                  ).innerHTML = cap;
                  document.querySelector(
                    ".internVenue-body .salas .right .gallery #salon_dis_info .name_cap ul li h4.capdis"
                  ).innerHTML = capdis;
                  document.querySelector(
                    ".internVenue-body .salas .right .gallery #salon_dis_info .name_dis h3.nameformat"
                  ).innerHTML = nameFormato;
                  $(
                    ".internVenue-body .salas .right .gallery #salon_dis_info .image img"
                  ).attr("src", src);
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
    });
  if (window.innerWidth > 768) {
    galleryImages
      .then((data) => {
        const galleryUlContainer = document.querySelector(
          ".internVenue-body .gallery.others .gallery_dot"
        );
        const principalImage = document.querySelector("#principal_img");
        if (principalImage) {
          principalImage.innerHTML = data[0];
          $(".gallery.others .imageText").text(
            document.querySelector("#principal_img img").getAttribute("alt")
          );
          galleryUlContainer.innerHTML = "";
          data.forEach((image, i) => {
            let templateImages = `<li class="${
              i == 0 && "active"
            }">${image}</li>`;
            galleryUlContainer.innerHTML += templateImages;
          });
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
              $(".gallery.others .imageText").text(alt);
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
          let templateImages = `<li>${image}</li>`;
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
if (document.querySelector(".internStorie")) {
  var storieid = document.querySelector(".internStorie main").dataset.storieid;
  const galleryImages = fetch(
    actualLang + "/g/galleryStorie/?storieid=" + storieid
  ).then((res) => res.json());
  galleryImages
    .then((data) => {
      const galleryUlContainer = document.querySelector(
        ".internStorie .gallery .gallery_dot"
      );
      const principalImage = document.querySelector("#principal_img");
      principalImage.innerHTML = data[0];
      galleryUlContainer.innerHTML = "";
      data.forEach((image, i) => {
        let templateImages = `<li class="${i == 0 && "active"}">${image}</li>`;
        galleryUlContainer.innerHTML += templateImages;
      });
    })
    .then(() => {
      if ($(".internStorie .gallery_dot").length) {
        $(".internStorie .gallery_dot li").hover(function (e) {
          $(".internStorie .gallery_dot li.active").removeClass("active");
          $(e.target).addClass("active");
          var src = $($(e.target).children("img")).attr("src");
          var alt = $($(e.target).children("img")).attr("alt");
          $(".internStorie .gallery #principal_img img").attr("src", src);
        });
      }
    })
    .then(() => {
      lazyImages();
    });
}
if (document.querySelector(".gridimperdibles")) {
  const gridImperdibles = document.querySelector(".gridimperdibles");
  gridImperdibles.innerHTML = ``;
  var url = actualLang + "/g/imperdibles/";
  fetch(url)
    .then((response) => response.json())
    .then((places) => {
      places.forEach((place) => {
        let subproductRelInfo = subproductsArray.filter(
          (sub) => sub.nid == place.field_subp.split(",")[0]
        );
        var productName = subproductRelInfo[0].field_prod_rel_1;
        var urlPlace = `${actualLang}/atractivo/${get_alias(
          productName
        )}/${get_alias(place.title)}-${subproductRelInfo[0].field_prod_rel}-${
          place.nid
        }`;
        let gridTemplate = `<a href="${urlPlace}" class="grid-atractivos-item wait" style="display: inline;"><div class="site_img"><img loading="lazy" src="https://picsum.photos/20/20" data-src="${urlGlobal}${
          place.field_cover_image ? place.field_cover_image : "img/noimg.png"
        }" alt="${place.title}" class="lazyload"></div><span>${
          place.title
        }</span></a>`;
        gridImperdibles.innerHTML += gridTemplate;
      });
    })
    .then(() => lazyImages());
}
function getMICEData() {
  const fetchMICEData = () => {
    const urls = [
      actualLang + "/g/getFormatsSalas/",
      actualLang + "/g/criteriosVenues/",
      actualLang + "/g/providerType/",
    ];
    const allRequests = urls.map(async (url) => {
      let MICEResponse = await fetch(url);
      return MICEResponse.json();
    });
    return Promise.all(allRequests);
  };
  fetchMICEData().then((arrayOfResponses) => {
    //   ZONE ELEMENTS MICE
    const formatos = arrayOfResponses[0];
    document.querySelector("#filter1 .options.formatos").innerHTML = "";
    const formatosSteps = document.querySelector(
      ".steps-home #filter1 .options.formatos"
    );
    formatos.forEach((formato) => {
      let localidadTemplate1 = `<span class="customCheck"><input type="checkbox" onchange="$('#filter1 button.btn.btn-submit').fadeIn();" name="venuesZone-${formato.tid}" id="venuesZone-${formato.tid}" value="${formato.tid}" /><label for="venuesZone-${formato.tid}">${formato.name}</label></span>`;
      document.querySelector("#filter1 .options.formatos").innerHTML +=
        localidadTemplate1;
      // if (formatosSteps) {
      //   formatosSteps.innerHTML += localidadTemplate1;
      // }
    });
    // CRITERIOS MICE
    const criterios = arrayOfResponses[1];
    document.querySelector("#filter1 .options.tipoVenues").innerHTML = "";
    const tipoVenuesSteps = document.querySelector(
      ".steps-home #filter1 .options.tipoVenues"
    );
    criterios.forEach((criterio) => {
      let criterioTemplate = `<span class="customCheck"><input type="checkbox" onchange="$('#filter1 button.btn.btn-submit').fadeIn();" name="venuesCriterio-${criterio.tid}" id="venuesCriterio-${criterio.tid}" value="${criterio.tid}" /><label for="venuesCriterio-${criterio.tid}">${criterio.name}</label></span>`;
      document.querySelector("#filter1 .options.tipoVenues").innerHTML +=
        criterioTemplate;
      // if (tipoVenuesSteps) {
      //   tipoVenuesSteps.innerHTML += criterioTemplate;
      // }
    });
    // TIPOS PROVEEDORES
    const proveedores = arrayOfResponses[2];
    document.querySelector("#filter2 .options.tipoProveedor").innerHTML = "";
    const tipoProveedorSteps = document.querySelector(
      ".steps-home #filter2 .options.tipoProveedor"
    );
    proveedores.forEach((criterio) => {
      let criterioTemplate = `<span class="customCheck"><input type="checkbox" onchange="$('#filter2 button.btn.btn-submit').fadeIn();" name="tipoProveedor-${criterio.tid}" id="tipoProveedor-${criterio.tid}" value="${criterio.tid}" /><label for="tipoProveedor-${criterio.tid}">${criterio.name}</label></span>`;
      document.querySelector("#filter2 .options.tipoProveedor").innerHTML +=
        criterioTemplate;
      // if (tipoProveedorSteps) {
      //   tipoProveedorSteps.innerHTML += criterioTemplate;
      // }
    });
  });
}
function getfiltersMICE() {
  console.log("getfiltersMICE");
  let arrayFormatsMICE = document
    .querySelector(".venuesList")
    .dataset.formats.split(",");
  let arrayTypesMICE = document
    .querySelector(".venuesList")
    .dataset.type.split(",");

  const getfiltersMICEData = () => {
    const urls = [
      actualLang + "/g/getFormatsSalas/",
      actualLang + "/g/criteriosVenues/",
    ];
    const allRequests = urls.map(async (url) => {
      let MICEResponse = await fetch(url);
      return MICEResponse.json();
    });
    return Promise.all(allRequests);
  };
  getfiltersMICEData()
    .then((arrayOfResponses) => {
      //   ZONE ELEMENTS MICE
      const formats = arrayOfResponses[0];
      document.querySelector(".filters_format").innerHTML = "";
      formats.forEach((format) => {
        let formatTemplate = `<li style="display: block"><input ${
          arrayFormatsMICE.find((el) => el == format.tid) && "checked"
        } type="checkbox" name="format-${format.tid}" id="format-${
          format.tid
        }" onchange="changeFilterVenues()" value="${
          format.tid
        }" /><label for="format-${format.tid}">${format.name}</label></li>`;
        document.querySelector(".filters_format").innerHTML += formatTemplate;
      });
      // CRITERIOS MICE
      const criterios = arrayOfResponses[1];
      document.querySelector(".filters_typevenue").innerHTML = "";
      criterios.forEach((criterio) => {
        let criterioTemplate = `<li style="display: block"><input ${
          arrayTypesMICE.find((el) => el == criterio.tid) && "checked"
        } type="checkbox" name="type-${criterio.tid}" id="type-${
          criterio.tid
        }" onchange="changeFilterVenues()" value="${
          criterio.tid
        }" /><label for="type-${criterio.tid}">${criterio.name}</label></li>`;
        document.querySelector(".filters_typevenue").innerHTML +=
          criterioTemplate;
      });
    })
    .then(() => {
      changeFilterVenues();
    });
}

function findVenues() {
  let venueTypeArray = [];
  let formatosArray = [];

  let venueType = "";
  let formatos = "";

  document
    .querySelectorAll(".options.tipoVenues input:checked")
    .forEach((tipoVenue) => {
      venueTypeArray.push(tipoVenue.value);
    });
  document
    .querySelectorAll(".options.formatos input:checked")
    .forEach((formato) => {
      formatosArray.push(formato.value);
    });
  venueType = venueTypeArray.toString();
  formatos = formatosArray.toString();
  window.location.href = `https://files.visitbogota.co/${actualLang}/mice/venues?type=${venueType}&format=${formatos}&aforo=${
    document.querySelector(".options.aforo input:checked").value
  }`;
}
function findProviders() {
  let providerTypeArray = [];
  let providerType = "";

  document
    .querySelectorAll(".options.tipoProveedor input:checked")
    .forEach((tipoProveedor) => {
      providerTypeArray.push(tipoProveedor.value);
    });
  providerType = providerTypeArray.toString();
  window.location.href = `https://files.visitbogota.co/${actualLang}/mice/proveedores?type=${providerType}`;
}
var containerGridVenues = document.querySelector(
  ".venuesList-body .grid-venues"
);

if (document.querySelector(".venuesList-body .grid-providers")) {
  let providerTypeArray = [];
  let providerType = "";

  document
    .querySelectorAll(".options.tipoProveedor input:checked")
    .forEach((tipoProveedor) => {
      providerTypeArray.push(tipoProveedor.value);
    });
  providerType = providerTypeArray.toString();
  filterProviders(providerType, "0");
}
let firstTimeVenues = 0;
function filterVenues(type, format, aforo) {
  $(".venuesList .right").toggleClass("loading");
  // Clean Container places
  containerGridVenues.innerHTML = "";
  // Create URL to FETCH
  var url = actualLang + "/g/getVenues/?filter=1";
  if (type) url += "&type=" + type;
  if (format) url += "&format=" + format;
  if (aforo) url += "&aforo=" + aforo;
  // Fetch final URL
  fetch(url)
    .then((response) => response.json())
    .then((venues) => {
      console.log(url);
      console.log(venues);
      if (venues.length > 0) {
        for (let index = 0; index < venues.length; index++) {
          const venue = venues[index];
          var venueUrl = `${actualLang}/mice/venues/${get_alias(venue.title)}/${
            venue.nid
          }`;
          var template = `
          <li>
          <a href="${venueUrl}">
          <img loading="lazy" src="https://picsum.photos/20/20" data-src="${urlGlobal}${
            venue.field_thumbnail ? venue.field_thumbnail : "img/noimg.png"
          }" alt="${venue.title}" class="lazyload">
            <div class="data">
              <div>
                <h4>${venue.title}</h4>
                <h5>${venue.field_venue_type_1}</h5>
              </div>
              <div class="flex">
              ${
                venue.field_micem2 &&
                `<div class="sala">
                <small>Sala más grande</small>
                <p>${venue.field_micem2} m²</p>
              </div>`
              }
                
                <div class="localidad">
                  <small>Localidad</small>
                  <p>${venue.field_zone_rel_1}</p>
                </div>
              </div>
            </div>
          </a>
        </li>`;
          containerGridVenues.innerHTML += template;
        }
      } else {
        let messages = {
          es: `<p class="noResults">No se encontraron resultados para tu búsqueda.</p>`,
          en: `<p class="noResults">No results for your search.</p>`,
          pt: `<p class="noResults">Nenhum resultado para a sua pesquisa.</p>`,
        };
        containerGridVenues.innerHTML = messages[actualLang];
      }
    })
    .then(function () {
      lazyImages();
      $(".venuesList .right").toggleClass("loading");
    });
}
function changeFilterVenues() {
  let valuesType = "";
  let valuesZone = "";
  let arrayvaluesType = [];
  let arrayvaluesZone = [];

  document
    .querySelectorAll(".filters_typevenue input:checked")
    .forEach((typevenue) => {
      arrayvaluesType.push(typevenue.value);
      valuesType = arrayvaluesType.toString();
    });
  document.querySelectorAll(".filters_format input:checked").forEach((zone) => {
    arrayvaluesZone.push(zone.value);
    valuesZone = arrayvaluesZone.toString();
  });
  document.querySelectorAll(".slide-filter .values small")[0].innerHTML =
    document.getElementById("myRange").value;
  filterVenues(
    valuesType,
    valuesZone,
    `${document.querySelector("#myRange").value},${aforoMax}`
  );
}
function changeFilterProviders() {
  let valuesType = "";
  let arrayvaluesType = [];
  document
    .querySelectorAll(".filters_typeProvider input:checked")
    .forEach((typevenue) => {
      arrayvaluesType.push(typevenue.value);
      valuesType = arrayvaluesType.toString();
    });
  filterProviders(valuesType, 0);
}
const inputSlider = document.getElementById("myRange");
if (inputSlider) {
  inputSlider.oninput = () => {
    let value = inputSlider.value;
    document.querySelectorAll(
      ".slide-filter .values small"
    )[0].innerHTML = `${value}`;
  };
}
function relVenues(type, zone, aforo) {
  let idSingleVenue = document.querySelector(".internVenue-body main").dataset
    .venueid;
  var containerGridVenues = document.querySelector(".grid-venues");
  containerGridVenues.innerHTML = "";
  // Create URL to FETCH
  var url = actualLang + "/g/getVenues/?filter=1";
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
            var venueUrl = `${actualLang}/mice/venues/${get_alias(
              venue.title
            )}/${venue.nid}`;
            var template = `
            <li>
            <a href="${venueUrl}">
            <img loading="lazy" src="https://picsum.photos/20/20" data-src="${urlGlobal}${
              venue.field_thumbnail ? venue.field_thumbnail : "img/noimg.png"
            }" alt="${venue.title}" class="lazyload">
              <div class="data">
                <div>
                  <h4>${venue.title}</h4>
                  <h5>${venue.field_venue_type_1}</h5>
                </div>
                <div class="flex">
                ${
                  venue.field_micem2 &&
                  `<div class="sala">
                  <small>Sala más grande</small>
                  <p>${venue.field_micem2} m²</p>
                </div>`
                }
                  
                  <div class="localidad">
                    <small>Localidad</small>
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

let menumice = document.querySelector("span.activelink");
let bluemenu = document.querySelector(".bluemenu");
if (menumice) {
  menumice.addEventListener("click", () => {
    bluemenu.classList.toggle("active");
  });
}

const gridProveedores = document.querySelector(
  ".venuesList-body .grid-providers"
);
let nextPageProviders = 1;
if (gridProveedores) {
  getfiltersProvMICE();
}
function filterProviders(type, page) {
  var url = actualLang + "/g/getProviders/?filter=1";
  if (type) url += "&type=" + type;
  if (page) url += "&page=" + page;
  fetch(url)
    .then((response) => response.json())
    .then((providers) => {
      console.log(providers);
      verifyMorePageProvider(type);
      gridProveedores.innerHTML = "";
      if (providers.length > 0) {
        providers.forEach((provider) => {
          const gridItem = `<li><a href="${actualLang}/mice/proveedores/${get_alias(
            provider.title
          )}/${provider.nid}"><img src="${
            provider.field_thumbnail
          }" alt="${get_alias(provider.title)}" /><div class="data"><h4>${
            provider.title
          }</h4><h5>${
            provider.field_provider_type.split(",")[0]
          }</h5></div></a></li>`;
          gridProveedores.innerHTML += gridItem;
        });
      }
    });
}

function verifyMorePageProvider(type) {
  var url = actualLang + "/g/getProviders/?filter=1";
  if (type) url += "&type=" + type;
  url += "&page=" + nextPageProviders;
  fetch(url)
    .then((response) => response.json())
    .then((providers) => {
      if (providers.length > 0) {
        document.querySelector(
          ".venuesList-body .venuesList .right button.moreItems"
        ).style.display = "block";
        document
          .querySelector(".venuesList-body .venuesList .right button.moreItems")
          .addEventListener("click", () => {
            changePage(undefined);
          });
      } else {
        document.querySelector(
          ".venuesList-body .venuesList .right button.moreItems"
        ).style.display = "none";
      }
    });
}

function changePage(type) {
  nextPageProviders = nextPageProviders + 1;
  verifyMorePageProvider(type);
  var url = actualLang + "/g/getProviders/?filter=1";
  if (type) url += "&type=" + type;
  url += "&page=" + nextPageProviders;
  fetch(url)
    .then((response) => response.json())
    .then((providers) => {
      if (providers.length > 0) {
        providers.forEach((provider, index) => {
          const gridItem = `<li><a href="${actualLang}/mice/proveedores/${get_alias(
            provider.title
          )}/${provider.nid}"><img src="${
            provider.field_thumbnail
          }" alt="${get_alias(provider.title)}" /><div class="data"><h4>${
            provider.title
          }</h4><h5>${provider.field_provider_type_1}</h5></div></a></li>`;
          gridProveedores.innerHTML += gridItem;
        });
      }
    });
}

function getfiltersProvMICE() {
  let arrayTypesMICE = document
    .querySelector(".venuesList")
    .dataset.type.split(",");

  const getfiltersMICEData = () => {
    const urls = [actualLang + "/g/providerType/"];
    const allRequests = urls.map(async (url) => {
      let MICEResponse = await fetch(url);
      return MICEResponse.json();
    });
    return Promise.all(allRequests);
  };
  getfiltersMICEData()
    .then((arrayOfResponses) => {
      //   ZONE ELEMENTS MICE
      const formats = arrayOfResponses[0];
      document.querySelector(".filters_typeProvider").innerHTML = "";
      formats.forEach((format) => {
        let formatTemplate = `<li style="display: block"><input type="checkbox" ${
          arrayTypesMICE.find((el) => el == format.tid) && "checked"
        } name="format-${format.tid}" id="format-${
          format.tid
        }" onchange="changeFilterProviders()" value="${
          format.tid
        }" /><label for="format-${format.tid}">${format.name}</label></li>`;
        document.querySelector(".filters_typeProvider").innerHTML +=
          formatTemplate;
      });
    })
    .then(() => {
      changeFilterProviders();
    });
}

function relproviders(type) {
  var containerGridproviders = document.querySelector(
    ".relProviders .grid-providers"
  );
  containerGridproviders.innerHTML = "";
  // Create URL to FETCH
  var url = actualLang + "/g/getProviders/?filter=1";
  if (type) url += "&type=" + type;

  // Fetch final URL
  fetch(url)
    .then((response) => response.json())
    .then((providers) => {
      if (providers.length > 0) {
        for (let index = 0; index < 4; index++) {
          const provider = providers[index];
          var providerUrl = `${actualLang}/mice/proveedores/${get_alias(
            provider.title
          )}/${provider.nid}`;
          var template = `
          <li>
          <a href="${providerUrl}">
          <img loading="lazy" src="https://picsum.photos/20/20" data-src="${urlGlobal}${
            provider.field_thumbnail
              ? provider.field_thumbnail
              : "img/noimg.png"
          }" alt="${provider.title}" class="lazyload">
          <div class="data">
          <h4>${provider.title}</h4>
          <h5>${provider.field_provider_type_1}</h5>
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

if (document.querySelector(".filterVenuesMobile .content")) {
  document
    .querySelector(".filterVenuesMobile span.title")
    .addEventListener("click", () => {
      document
        .querySelector(".filterVenuesMobile .content")
        .classList.toggle("active");
    });
}

function openForm1() {
  if (document.querySelector(".steps-home #filter1.active")) {
    document
      .querySelector(".steps-home #filter1.active")
      .classList.toggle("active");
  } else {
    document.querySelector(".steps-home #filter1").classList.toggle("active");
  }
  if (document.querySelector(".steps-home #filter2.active")) {
    document
      .querySelector(".steps-home #filter2.active")
      .classList.toggle("active");
  }
}
function openForm2() {
  if (document.querySelector(".steps-home #filter2.active")) {
    document
      .querySelector(".steps-home #filter2.active")
      .classList.toggle("active");
  } else {
    document.querySelector(".steps-home #filter2").classList.toggle("active");
  }
  if (document.querySelector(".steps-home #filter1.active")) {
    document
      .querySelector(".steps-home #filter1.active")
      .classList.toggle("active");
  }
}
