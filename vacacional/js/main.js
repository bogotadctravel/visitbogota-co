// script.js
if (document.querySelector(".parallax-layer")) {
  gsap.registerPlugin(ScrollTrigger);

  // Seleccionamos todas las capas del parallax
  const layers = document.querySelectorAll(".parallax-layer");

  // Aplicamos diferentes movimientos a cada capa
  layers.forEach((layer, index) => {
    let direction = index % 4; // Alternar entre diferentes direcciones

    switch (direction) {
      case 0: // Movimiento vertical (arriba a abajo)
        gsap.to(layer, {
          y: (index + 1) * 30,
          ease: "none",
          scrollTrigger: {
            trigger: "#parallax-container",
            start: "top top",
            end: "bottom top",
            scrub: true,
          },
        });
        break;

      case 1: // Movimiento de izquierda a derecha
        gsap.to(layer, {
          x: (index + 1) * 30,
          ease: "none",
          scrollTrigger: {
            trigger: "#parallax-container",
            start: "top top",
            end: "bottom top",
            scrub: true,
          },
        });
        break;

      case 2: // Movimiento de derecha a izquierda
        gsap.to(layer, {
          x: -(index + 1) * 30,
          ease: "none",
          scrollTrigger: {
            trigger: "#parallax-container",
            start: "top top",
            end: "bottom top",
            scrub: true,
          },
        });
        break;

      case 3: // Movimiento de abajo hacia arriba
        gsap.to(layer, {
          y: -(index + 1) * 30,
          ease: "none",
          scrollTrigger: {
            trigger: "#parallax-container",
            start: "top top",
            end: "bottom top",
            scrub: true,
          },
        });
        break;
    }
  });
}

function runOnScroll() {
  if (window.scrollY >= 80) {
    document.querySelector("header").classList.add("scroll");
  } else {
    document.querySelector("header").classList.remove("scroll");
  }
}
window.addEventListener("scroll", runOnScroll);

// Arreglos de imágenes
let imagenes1 = [
  "images/pauta/c_0.jpg",
  "images/pauta/c_1.jpg",
  "images/pauta/c_2.jpg",
];
let imagenes2 = [
  "images/pauta/h_0.jpg",
  "images/pauta/h_1.jpg",
  "images/pauta/h_2.jpg",
];

let imagenes3 = [
  "images/pauta/xl_0.jpg",
  "images/pauta/xl_1.jpg",
  "images/pauta/xl_2.jpg",
];
// Función para seleccionar una imagen al azar de un arreglo
async function seleccionarImagenAlAzar(imagenes, element) {
  if (element) {
    var indice = Math.floor(Math.random() * imagenes.length);
    var imagenSeleccionada = imagenes[indice];
    await getImageFromCacheOrFetch(imagenSeleccionada);
    element.src = imagenSeleccionada;
  }
}
let blogContainer = document.querySelector(".grid-blogs");
let restaContainer = document.querySelector(".grid-restaurants");
let eventosContainer = document.querySelector(".home .grid-eventos");

// Llamar a la función para cada arreglo de imágenes
window.addEventListener("load", function () {
  if (this.document.querySelector(".home")) {
    seleccionarImagenAlAzar(
      imagenes1,
      document.querySelectorAll(".home .more-card img")[2]
    );
    seleccionarImagenAlAzar(
      imagenes2,
      document.querySelector(".home section.add.container img")
    );
    seleccionarImagenAlAzar(
      imagenes3,
      document.querySelector(".banner-add img")
    );
  }
  if (blogContainer && !document.querySelector(".portal")) {
    getRecentBlogs();
  }
  if (restaContainer) {
    getRelRestaurants(document.querySelector("main").dataset.catid);
  }
  if (eventosContainer) {
    getRecentEventos();
  }
});

async function getRecentBlogs() {
  blogContainer.innerHTML = "";

  const response = await fetch(`/vacacional/g/lastBlogs/?lang=${actualLang}`);
  const data = await response.json();

  const promises = data.map(async (blog) => {
    let urlImg = await getImageFromCacheOrFetch(
      "https://files.visitbogota.co" + blog.field_image
    );
    let template = `<a href="/${actualLang}/blog/all/${get_alias(
      blog.title
    )}-all-${blog.nid}" data-aos="flip-left blog_item" data-productid="88">
        <div class="img">
          <img loading="lazy" data-src="${urlImg}" alt="Diversidad, cultura y música en Colombia al Parque" class="zone_img lazyload" src="https://placehold.co/400x400.jpg?text=visitbogota" />
        </div>
        <div class="desc">
       
       
          <h2>${blog.title}</h2>
        </div>
      </a>`;
    blogContainer.innerHTML += template;
  });

  await Promise.all(promises);

  lazyImages();
}
async function getCatBlogs(cat) {
  let blogCont = document.querySelector(".grid-blogs");
  blogCont.innerHTML = "";

  const response = await fetch(
    `/vacacional/g/blogsCat/?cat=${cat}&lang=${actualLang}`
  );
  const data = await response.json();
  if (data.length > 0) {
    const promises = data.map(async (blog) => {
      let urlImg = await getImageFromCacheOrFetch(
        "https://files.visitbogota.co" + blog.field_image
      );
      let template = `<a href="/${actualLang}/blog/all/${get_alias(
        blog.title
      )}-all-${blog.nid}" data-aos="flip-left blog_item" data-productid="88">
          <div class="img">
            <img loading="lazy" data-src="${urlImg}" alt="Diversidad, cultura y música en Colombia al Parque" class="zone_img lazyload" src="https://placehold.co/400x400.jpg?text=visitbogota" />
          </div>
          <div class="desc">
         
            <h2>${blog.title}</h2>
          </div>
        </a>`;
      blogCont.innerHTML += template;
    });
    await Promise.all(promises);
    lazyImages();
  } else {
    document.querySelector(".portal .blog").style.display = "none";
  }
}
async function getRelRestaurants(catID = "all") {
  restaContainer.innerHTML = "";
  const response = await fetch(
    `${actualLang}/g/getRestaurants/?termID=${catID}`
  );
  const data = await response.json();
  // Función para obtener un número aleatorio dentro de un rango
  function getRandomInt(max) {
    return Math.floor(Math.random() * max);
  }

  // Función para obtener n elementos aleatorios de un arreglo
  function getRandomElements(arr, n) {
    let result = new Array(n);
    let len = arr.length;
    let taken = new Array(len);

    if (n > len) {
      throw new RangeError(
        "getRandomElements: más elementos de los que hay en el arreglo"
      );
    }

    while (n--) {
      let x = getRandomInt(len);
      result[n] = arr[x in taken ? taken[x] : x];
      taken[x] = --len in taken ? taken[len] : len;
    }

    return result;
  }
  if (data.length >= 6) {
    // Obtiene 5 restaurantes aleatorios
    const randomRestaurants = getRandomElements(data, 6);

    const promises = randomRestaurants.map(async (blog) => {
      let urlImg = await getImageFromCacheOrFetch(
        "https://files.visitbogota.co" + blog.field_img
      );
      let template = `<a href="/${actualLang}/restaurante/${get_alias(
        blog.title
      )}-${catID}-${
        blog.nid
      }" data-aos="flip-left blog_item" data-productid="88">
            <div class="img">
              <img loading="lazy" data-src="${urlImg}" alt="Diversidad, cultura y música en Colombia al Parque" class="zone_img lazyload" src="https://placehold.co/400x400.jpg?text=visitbogota" />
            </div>
            <div class="desc">
              <h2>${blog.title}</h2>
            </div>
          </a>`;
      restaContainer.innerHTML += template;
    });

    await Promise.all(promises);

    lazyImages();
  } else {
    document.querySelector(".rel_rest").style.display = "none";
  }
}
async function getRecentEventos() {
  eventosContainer.innerHTML = "";

  const response = await fetch(`/vacacional/g/lastEvents/?lang=${actualLang}`);
  const data = await response.json();
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
  // Ordenar el arreglo por fecha de finalización
  data.sort(compararFechas);

  const promises = data.map(async (evento) => {
    let urlImg = await getImageFromCacheOrFetch(
      "https://files.visitbogota.co" + evento.field_cover_image
    ); // Asegurarse de que las fechas se interpretan correctamente
    const dateStart = setMidnight(evento.field_date);

    // Manejar la fecha de fin de manera diferente si no incluye una hora
    let dateEnd;
    if (evento.field_end_date.length === 10) {
      // Verificar si el formato es solo de fecha (YYYY-MM-DD)
      dateEnd = setMidnight(evento.field_end_date);
      dateEnd.setDate(dateEnd.getDate() + 1); // Mover la fecha de fin al día siguiente
    } else {
      dateEnd = setMidnight(evento.field_end_date);
    }

    const options = {
      month: "long",
      day: "numeric",
      year: "numeric",
    };

    const dateFormattedStart = dateStart.toLocaleDateString("es-ES", options);
    const dateFormattedEnd = dateEnd.toLocaleDateString("es-ES", options);
    const alText = actualLang === "es" ? "al" : "to";
    const hastaElText = actualLang === "es" ? "Hasta el" : "Until";

    // Obtener la fecha actual
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    let dateText = "";

    // Condicionales
    if (!evento.field_end_date) {
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
    let template = `<a href="/${actualLang}/evento/${get_alias(evento.title)}-${
      evento.nid
    }" data-aos="flip-left blog_item" data-productid="88">
        <div class="img">
          <img loading="lazy" data-src="${urlImg}" alt="Diversidad, cultura y música en Colombia al Parque" class="zone_img lazyload" src="https://placehold.co/400x400.jpg?text=visitbogota" />
        </div>
        <div class="desc">
        <h2>${evento.title}</h2>
        <small class="tag">
        ${dateText}
        </small>
        </div>
      </a>`;
    eventosContainer.innerHTML += template;
  });

  await Promise.all(promises);

  lazyImages();
}
async function getZonesHome() {
  await fetch("g/zonas/")
    .then((res) => res.json())
    .then(async (data) => {
      for (const [index, zona] of data.entries()) {
        let template;
        if (zona.tid == 136) {
          template = `
          <li class="splide__slide" data-index="${index}" data-zone="${zona.tid}">
          <div class="zone-card">
            <img src="https://files.visitbogota.co${zona.field_imagen_zona}" alt="zona"${zona.name} />
            <div class="info">
              <h1 class=" ms900">${zona.name}</h1>
              <a href="/${actualLang}/alrededores-de-bogota" class=" ms900 btn wait">VISITAR</a>
            </div>
          </div>
        </li>`;
        } else {
          const localidadesText = await localidades(zona.tid);

          template = `
          <li class="splide__slide" data-index="${index}" data-zone="${zona.tid}">
          <div class="zone-card">
            <img src="https://files.visitbogota.co${zona.field_imagen_zona}" alt="zona"${zona.name} />
            <div class="info">
              <h2 class=" ms900">${zona.name}</h2>
              <ul class="localidades">
                ${localidadesText}
              </ul>
            </div>
          </div>
        </li>`;
        }

        document.querySelector(".splide2 .splide__list").innerHTML += template;
      }
    })
    .then(() => {
      const splide = new Splide(".splide2", {
        perPage: 1,
        gap: 10,
        width: 400,
        focus: "center",
        type: "loop",
        pagination: false,
        lazyLoad: "nearby",
        classes: {
          arrows: "splide__arrows your-class-arrows",
          arrow: "splide__arrow your-class-arrow",
          prev: "splide__arrow--prev your-class-prev",
          next: "splide__arrow--next your-class-next",
        },
      }).mount();
      splide.on("active", function (e) {
        if (document.querySelector(`.zoneSvg.active`)) {
          document.querySelector(`.zoneSvg.active`).classList.remove("active");
        }
        if (document.querySelector(`#zone-${e.slide.dataset.zone}`)) {
          document
            .querySelector(`#zone-${e.slide.dataset.zone}`)
            .classList.add("active");
        }
      });
      document.querySelectorAll(".zoneSvg").forEach((svg) => {
        svg.addEventListener("click", () => {
          document.querySelector(".zoneSvg.active").classList.remove("active");
          svg.classList.add("active");
          document
            .querySelector(`[data-zone="${svg.id.split("-")[1]}"]`)
            .classList.add("active");
          const { Move } = splide.Components;

          splide.go(
            parseInt(
              document.querySelector(`[data-zone="${svg.id.split("-")[1]}"]`)
                .dataset.index
            ),
            { animation: true }
          );
        });
      });
    });
  document.querySelector(".zones .zones-container").classList.remove("loading");
}

async function localidades(zonaId) {
  let text = "";
  const localidadesData = await fetch(
    `https://files.visitbogota.co/drpl/es/api/v1/es/zones/all/${zonaId}`
  ).then((res) => res.json());

  localidadesData.forEach((localidad) => {
    text += `<li><a href="/${actualLang}/zona/${get_alias(localidad.title)}/${
      localidad.nid
    }" class="zone_cards_item wait">${localidad.title} </a></li>`;
  });

  return text;
}
async function getBannersCuadrados() {
  document.querySelector(".cards").classList.add("loading");
  await fetch("g/banners_cuadrados/")
    .then((res) => res.json())
    .then(async (data) => {
      for (const [index, banner] of data.entries()) {
        let urlImg = await getImageFromCacheOrFetch(
          `https://files.visitbogota.co${banner.field_image}`
        );
        let template = `<a href="${banner.field_link}" target="_blank" class="city-card"><img src="${urlImg}" alt="${banner.title}" /><span class=" ms700">${banner.title}</span></a>`;
        document.querySelector(".cards").innerHTML += template;
      }
    });
  document.querySelector(".cards").classList.remove("loading");
}

function shorter(text, chars_limit = 35) {
  // Cambia al número de caracteres que deseas mostrar
  var chars_text = text.length;
  text = text + " ";
  text = text.substring(0, chars_limit);
  text = text.substring(0, text.lastIndexOf(" "));
  if (chars_text > chars_limit) {
    text = text + "...";
  }
  return text;
}
function fixbiurl(prefix, url, author = "") {
  const urlParts = url.split("/upload/");
  let modifiedUrl;

  if (author !== "") {
    modifiedUrl = `${urlParts[0]}/upload/l_text:Arial_50_bold:Archivo%20fotogr%C3%A1fico%20IDT.${author},co_rgb:FFFFFF,g_south_east/${prefix}/${urlParts[1]}`;
  } else {
    modifiedUrl = `${urlParts[0]}/upload/${prefix}/${urlParts[1]}`;
  }

  return modifiedUrl;
}

const getBogotaBIImagesVideos = async () => {
  const bogotaContainer = document.querySelector(`#bi-images ul`);
  bogotaContainer.innerHTML = "";

  const response = await fetch(`${actualLang}/g/bi_imagesVideos/`);
  const data = await response.json();

  const promises = data.map(async (images) => {
    let urlImg = await getImageFromCacheOrFetch(
      fixbiurl(
        "w_640",
        images.field_is_video === "1"
          ? images.field_bi_imagen.toLowerCase().replace(".mp4", ".jpg")
          : images.field_bi_imagen
      )
    );
    const template = `
    <li class="splide__slide">
      <a href="/${actualLang}/banco-imagenes/interna-${images.nid}">
        <img src="${urlImg}"
          alt="${images.title}" />
        ${
          images.field_is_video === "1"
            ? '<img src="/banco-imagenes/img/film.png" alt="video icon" class="video-icon" />'
            : ""
        }
      </a>
    </li>`;

    bogotaContainer.innerHTML += template;
  });

  await Promise.all(promises);

  new Splide(`#bi-images`, {
    focus: "center",
    gap: 30,
    padding: "10%",
    autoplay: true,
    pagination: false,
    perMove: 1,
    perPage: 3,
    type: "loop",
    breakpoints: {
      768: {
        padding: "20%",
        perPage: 1,
      },
    },
  }).mount();

  lazyImages();
};

const getFiltersExperienciasTuristicas = async (container, category) => {
  const containerInfo = document.querySelector(`#${container} ul`);
  containerInfo.innerHTML = "";

  const response = await fetch(
    `/experiencias-turisticas/g/tax/?taxName=${category}`
  );
  const data = await response.json();

  const promises = data.map(async (images) => {
    let urlImg = await getImageFromCacheOrFetch(
      images.field_imagen_zona != ""
        ? "https://files.visitbogota.co" + images.field_imagen_zona
        : "https://placehold.co/755x755.jpg?text=visitbogota"
    );
    console.log(category);
    let linkUrl = `/${actualLang}/experiencias-turisticas/encuentra-tu-plan?${
      category == "categorias_comerciales_pb"
        ? `categories=${images.tid}`
        : `zones=${images.tid}`
    }`;
    const template = `
    <li class="splide__slide">
      <a href="${linkUrl}">
        <img loading="lazy" data-src="${urlImg}" alt="${images.name}" class="zone_img lazyload" src="https://placehold.co/755x755.jpg?text=visitbogota"
          alt="${images.name}" />
          <span>${images.name}</span>  
      </a>
    </li>`;

    containerInfo.innerHTML += template;
  });

  await Promise.all(promises);

  new Splide(`#${container}`, {
    pagination: true,
    perMove: 1,
    perPage: 1,
    type: "loop",
  }).mount();

  lazyImages();
};
function absoluteURL(str) {
  if (str.indexOf("https") == -1) {
    return "https://files.visitbogota.co" + str.replace(/\s/g, "");
  } else {
    return str;
  }
}
async function getRT() {
  if (document.querySelector(".listRT")) {
    const resp = await fetch(`${actualLang}/g/getRT/`);
    const rutas = await resp.json();
    const rutasAgrupadas = rutas.reduce((agrupado, ruta) => {
      // Extraer el campo por el que se va a agrupar
      const campo = ruta.field_categor;

      // Si no existe la clave para este campo, crearla con un array vacío
      if (!agrupado[campo]) {
        agrupado[campo] = [];
      }

      // Agregar la ruta al array correspondiente
      agrupado[campo].push(ruta);

      return agrupado;
    }, {});
    // Iterar sobre las claves (nombres de categoría) del objeto rutasAgrupadas
    Object.keys(rutasAgrupadas).forEach((categoria) => {
      // Iterar sobre las rutas dentro de esta categoría
      // Mostrar el template
      document.querySelector(".listRT").innerHTML += `<h3>${categoria}</h3>`;
      rutasAgrupadas[categoria].forEach((ruta) => {
        let {
          nid,
          title,
          field_descripcion_corta,
          field_thumbnail,
          field_categor,
          field_categor_1,
        } = ruta;

        let urlRuta = `/${actualLang}/rutas-turisticas/${get_alias(
          title
        )}-${nid}`;

        // Crear el template para la ruta
        let template = `<article title="${title}">
          <a href="${urlRuta}">
              <div class="image">
                  <img src="${absoluteURL(field_thumbnail)}" alt="${title}">
              </div>
              <div class="desc">
                  <h3>${title}</h3>
                  <div class="shortdesc">${field_descripcion_corta}</div>
                  <span class="btn">${pi_bogota[44]}</span>
              </div>
          </a>
      </article>`;

        // Mostrar el template
        document.querySelector(".listRT").innerHTML += template;
      });
    });
  }
}
async function getRTRel(field_category) {
  if (field_category) {
    const resp = await fetch(`${actualLang}/g/getRT/`);
    const rutas = await resp.json();
    const rutasAgrupadas = rutas.reduce((agrupado, ruta) => {
      // Extraer el campo por el que se va a agrupar
      const campo = ruta.field_categor;

      // Si no existe la clave para este campo, crearla con un array vacío
      if (!agrupado[campo]) {
        agrupado[campo] = [];
      }

      // Agregar la ruta al array correspondiente
      agrupado[campo].push(ruta);

      return agrupado;
    }, {});
    // Iterar sobre las claves (nombres de categoría) del objeto rutasAgrupadas
    Object.keys(rutasAgrupadas).forEach((categoria) => {
      // Iterar sobre las rutas dentro de esta categoría
      // Mostrar el template
      if (field_category == categoria) {
        rutasAgrupadas[categoria].forEach((ruta) => {
          if (document.querySelector("main").dataset.rutaid != ruta.nid) {
            let {
              nid,
              title,
              field_descripcion_corta,
              field_thumbnail,
              field_categor,
              field_categor_1,
            } = ruta;

            let urlRuta = `/${actualLang}/rutas-turisticas/${get_alias(
              title
            )}-${nid}`;

            // Crear el template para la ruta
            let template = `<article title="${title}">
              <a href="${urlRuta}">
                  <div class="image">
                      <img src="${absoluteURL(field_thumbnail)}" alt="${title}">
                  </div>
                  <div class="desc">
                      <h3>${title}</h3>
                      <div class="shortdesc">${field_descripcion_corta}</div>
                      <span class="btn">${pi_bogota[44]}</span>
                  </div>
              </a>
          </article>`;

            // Mostrar el template
            document.querySelector(".listRTRel").innerHTML += template;
          }
        });
      }
    });
  }
}

async function getHomeRT() {
  if (document.querySelector(".home .grid-rutas")) {
    const resp = await fetch(`${actualLang}/g/getRT/`);
    const rutas = await resp.json();
    for (let index = 0; index < 3; index++) {
      const ruta = rutas[index];
      let {
        nid,
        title,
        field_descripcion_corta,
        field_thumbnail,
        field_categor,
        field_categor_1,
      } = ruta;
      let urlRuta = `/${actualLang}/rutas-turisticas/${get_alias(
        title
      )}-${nid}`;
      let template = `<article title="${title}"><a href="${urlRuta}">
      <div class="image">
      <img src="${absoluteURL(field_thumbnail)}" alt="${title}">
      </div>
      <div class="desc"><h3>${title}</h3><div class="shortdesc">${field_descripcion_corta}</div><span class="btn">${
        pi_bogota[44]
      }</span></div></a></article>`;
      document.querySelector(".grid-rutas").innerHTML += template;
    }
  }
}
document.addEventListener("DOMContentLoaded", async () => {
  // Llamadas a la función unificada con los valores específicos
  if (document.querySelector("#porcategoria")) {
    await getFiltersExperienciasTuristicas(
      "porcategoria",
      "categorias_comerciales_pb"
    );
    await getFiltersExperienciasTuristicas("porzona", "test_zona");
  }
  getRT();
  getHomeRT();
  getRTRel(document.querySelector("main").dataset.cat);
});

// GET ATRACTIVOS PORTAL
async function filterPortal(termID = "all", termName = "") {
  const response = await fetch(
    `${actualLang}/g/getAtractivos/?termID=${termID}`
  );
  const atractivos = await response.json();
  for (let index = 0; index < atractivos.length; index++) {
    const place = atractivos[index];
    var placeUrl = `/${actualLang}/atractivo/${get_alias(termName)}/${get_alias(
      place.title
    )}-all-${place.nid}`;
    let image = await getImageFromCacheOrFetch(
      `${urlGlobal}${
        place.field_cover_image ? place.field_cover_image : "/img/noimg.png"
      }`
    );
    var template = `
            <a href="${placeUrl}" class="grid-atractivos-item wait" data-id="${place.nid}">
                <div class="site_img">
                    <img loading="lazy" src="https://picsum.photos/20/20" data-src="${image}" alt="${place.title}" class="lazyload">
                </div>
                <span>${place.title}</span>
            </a>
            `;
    containerGrid.innerHTML += template;
  }
  lazyImages();
}
async function getPortalRT(cat) {
  if (document.querySelector(".portal .grid-rutas")) {
    const resp = await fetch(
      `${actualLang}/g/getRutasTuristicasByCategory/?cat=${cat}`
    );
    const rutas = await resp.json();
    if (rutas.length > 0) {
      for (let index = 0; index < rutas.length; index++) {
        const ruta = rutas[index];
        let {
          nid,
          title,
          field_descripcion_corta,
          field_thumbnail,
          field_categor,
          field_categor_1,
        } = ruta;
        let urlRuta = `/${actualLang}/rutas-turisticas/${get_alias(
          title
        )}-${nid}`;
        let template = `<article title="${title}"><a href="${urlRuta}">
        <div class="image">
        <img src="${absoluteURL(field_thumbnail)}" alt="${title}">
        </div>
        <div class="desc"><h3>${title}</h3><div class="shortdesc">${field_descripcion_corta}</div><span class="btn">${
          pi_bogota[44]
        }</span></div></a></article>`;
        document.querySelector(".portal .grid-rutas").innerHTML += template;
      }
    } else {
      document.querySelector(`.portal-rutas`).style.display = "none";
    }
  }
}
async function getEventosPortal(cat) {
  let eventosPortal = document.querySelector(".portal .grid-eventos");
  eventosPortal.innerHTML = "";

  const response = await fetch(
    `${actualLang}/g/eventsCat/?cat=${cat}&lang=${actualLang}`
  );
  const data = await response.json();
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
  if (data.length > 0) {
    // Ordenar el arreglo por fecha de finalización
    data.sort(compararFechas);

    const promises = data.map(async (evento) => {
      let urlImg = await getImageFromCacheOrFetch(
        "https://files.visitbogota.co" + evento.field_cover_image
      ); // Asegurarse de que las fechas se interpretan correctamente
      const dateStart = setMidnight(evento.field_date);

      // Manejar la fecha de fin de manera diferente si no incluye una hora
      let dateEnd;
      if (evento.field_end_date.length === 10) {
        // Verificar si el formato es solo de fecha (YYYY-MM-DD)
        dateEnd = setMidnight(evento.field_end_date);
        dateEnd.setDate(dateEnd.getDate() + 1); // Mover la fecha de fin al día siguiente
      } else {
        dateEnd = setMidnight(evento.field_end_date);
      }

      const options = {
        month: "long",
        day: "numeric",
        year: "numeric",
      };

      const dateFormattedStart = dateStart.toLocaleDateString("es-ES", options);
      const dateFormattedEnd = dateEnd.toLocaleDateString("es-ES", options);
      const alText = actualLang === "es" ? "al" : "to";
      const hastaElText = actualLang === "es" ? "Hasta el" : "Until";

      // Obtener la fecha actual
      const today = new Date();
      today.setHours(0, 0, 0, 0);

      let dateText = "";

      // Condicionales
      if (!evento.field_end_date) {
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
      let template = `<a href="/${actualLang}/evento/${get_alias(
        evento.title
      )}-${evento.nid}" data-aos="flip-left blog_item" data-productid="88">
        <div class="img">
          <img loading="lazy" data-src="${urlImg}" alt="Diversidad, cultura y música en Colombia al Parque" class="zone_img lazyload" src="https://placehold.co/400x400.jpg?text=visitbogota" />
        </div>
        <div class="desc">
        <h2>${evento.title}</h2>
        <small class="tag">
        ${dateText}
        </small>
        </div>
      </a>`;
      eventosPortal.innerHTML += template;
    });

    await Promise.all(promises);

    lazyImages();
  } else {
    document.querySelector(`.portal-eventos`).style.display = "none";
  }
}
async function getExpPortal(cat) {
  const grid = document.querySelector(".grid-experiencias");
  grid.innerHTML = ``;
  fetch(`${actualLang}/g/expCat/?cat=${cat}&lang=${actualLang}`)
    .then((res) => res.json())
    .then((data) => {
      let template;
      if (data.length > 0) {
        data.forEach((plan) => {
          let link = `/${actualLang}/experiencias-turisticas/plan/${get_alias(
            plan.title
          )}-${plan.nid}`;
          template = `
              <a href="${link}" class="grid-experiencias__item" 
               data-persons="${plan.field_maxpeople}" data-cat="${plan.field_nueva_categorizacion}" data-zone="${plan.field_pb_oferta_zona}" data-field_destacar_en_categoria="${plan.field_destacar_en_categoria}">
               <div class="image">
               <img loading="lazy" class="lazyload" data-src="https://files.visitbogota.co${plan.field_pb_oferta_img_listado}" src="https://via.placeholder.com/330x240" alt="${plan.title}"/>
              
               </div>
              <div class="info">
                <strong class="ms900">${plan.title}</strong>
                <p class="ms100">${plan.field_pb_oferta_desc_corta}</p>
                <small class="link ms900 "> Ver experiencia </small>
              </div>
            </a>`;
          grid.innerHTML += template;
        });
      } else {
        document.querySelector(`.portal-experiencias`).style.display = "none";
      }
    })
    .then(() => {
      lazyImages();
    });
}
if (document.querySelector("body.portal")) {
  var containerGrid = document.querySelector(".grid-atractivos");
  var dataCatId = document.querySelector("#mainPortal").dataset.productid;
  var catName = document.querySelector("#mainPortal").dataset.productname;
  if (dataCatId) {
    filterPortal(dataCatId, catName);
    getPortalRT(dataCatId);
    getEventosPortal(dataCatId);
    getExpPortal(dataCatId);
    getCatBlogs(dataCatId);
  }
}
// GET RESTAURANTES PORTALGASTRONOMICOS
async function filterPortalGastronomico(zonaID = "all") {
  const response = await fetch(
    `${actualLang}/g/getRestaurants/?termID=${zonaID}`
  );
  const atractivos = await response.json();
  console.log(atractivos);

  for (let index = 0; index < atractivos.length; index++) {
    const place = atractivos[index];
    var placeUrl = `/${actualLang}/restaurante/${get_alias(
      place.title
    )}-${zonaID}-${place.nid}`;
    let image = await getImageFromCacheOrFetch(
      `${urlGlobal}${place.field_img ? place.field_img : "/img/noimg.png"}`
    );
    var template = `
            <a href="${placeUrl}" class="grid-atractivos-item wait" data-id="${place.nid}">
                <div class="site_img">
                    <img loading="lazy" src="https://picsum.photos/20/20" data-src="${image}" alt="${place.title}" class="lazyload">
                </div>
                <span>${place.title}</span>
            </a>
            `;
    containerGrid.innerHTML += template;
  }
  lazyImages();
}
if (document.querySelector("body.portalgastronomico ")) {
  var containerGrid = document.querySelector(".grid-atractivos");
  var dataCatId = document.querySelector("#mainPortal").dataset.zoneid;
  if (dataCatId) {
    filterPortalGastronomico(dataCatId);
  }
}

// if (
//   document.querySelectorAll(".interna_atractivo .gallery-grid li img").length >
//   0
// ) {
//   // Get all images
//   const images = document.querySelectorAll(
//     ".interna_atractivo .gallery-grid li img"
//   );
//   // Loop through each image
//   images.forEach((image) => {
//     // Create a new element for displaying alt text
//     const altElement = document.createElement("span");
//     altElement.classList.add("alt-text");
//     // Set the text content of the alt element to the alt attribute of the image
//     altElement.textContent = image.alt;
//     // Insert the new element after the image
//     image.parentNode.insertBefore(altElement, image.nextSibling);
//   });
// }

// if (document.querySelectorAll(".ruta_intern .gallery-grid li img").length > 0) {
//   // Get all images
//   const images = document.querySelectorAll(".ruta_intern .gallery-grid li img");
//   // Loop through each image
//   images.forEach((image) => {
//     // Create a new element for displaying alt text
//     const altElement = document.createElement("span");
//     altElement.classList.add("alt-text");
//     // Set the text content of the alt element to the alt attribute of the image
//     altElement.textContent = image.alt;
//     // Insert the new element after the image
//     image.parentNode.insertBefore(altElement, image.nextSibling);
//   });
// }
if (document.querySelector(".blog_content")) {
  // Obtén todas las imágenes dentro del contenedor .blog_content
  var images = document.querySelectorAll(".blog_content img");

  // Itera sobre cada imagen encontrada
  images.forEach(function (img) {
    // Crea un nuevo contenedor <div> con la clase "image"
    var imageContainer = document.createElement("div");
    imageContainer.classList.add("image");

    // Crea un nuevo elemento <span>
    var span = document.createElement("span");

    // Crea una nueva imagen con los atributos alt y src de la imagen original
    var newImg = document.createElement("img");
    newImg.alt = img.alt;
    newImg.src = img.src;
    span.innerText = img.alt;

    // Agrega la nueva imagen y el span al contenedor .image
    imageContainer.appendChild(newImg);
    imageContainer.appendChild(span);

    // Reemplaza la imagen original con el nuevo contenedor .image
    img.parentNode.replaceChild(imageContainer, img);
  });
}
