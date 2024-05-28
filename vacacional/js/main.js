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
let eventosContainer = document.querySelector(".grid-eventos");

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
  if (blogContainer) {
    getRecentBlogs();
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
        <small class="tag">
        <img src="images/mdi_tag.svg" alt="tag"/>
        ${blog.field_prod_rel_1}
        </small>
          <h2>${blog.title}</h2>
        </div>
      </a>`;
    blogContainer.innerHTML += template;
  });

  await Promise.all(promises);

  lazyImages();
}
async function getRecentEventos() {
  eventosContainer.innerHTML = "";

  const response = await fetch(`/vacacional/g/lastEvents/?lang=${actualLang}`);
  const data = await response.json();
  // Función para comparar fechas
  function compareDates(a, b) {
    const dateA = new Date(a.field_date);
    const dateB = new Date(b.field_date);
    return dateA - dateB;
  }

  // Ordenar el arreglo por la fecha inicial
  data.sort(compareDates);

  const promises = data.map(async (evento) => {
    const dateStart = new Date(evento.field_date);
    const optionsdateStart = {
      month: "short",
      day: "numeric",
      year: "numeric",
    };
    const dateFormatteddateStart = dateStart.toLocaleDateString(
      "es-ES",
      optionsdateStart
    );
    const dateEnd = new Date(evento.field_end_date);
    const optionsdateEnd = {
      month: "short",
      day: "numeric",
      year: "numeric",
    };
    const dateFormatteddateEnd = dateEnd.toLocaleDateString(
      "es-ES",
      optionsdateEnd
    );
    let urlImg = await getImageFromCacheOrFetch(
      "https://files.visitbogota.co" + evento.field_cover_image
    );
    let template = `<a href="/${actualLang}/evento/${get_alias(evento.title)}-${
      evento.nid
    }" data-aos="flip-left blog_item" data-productid="88">
        <div class="img">
          <img loading="lazy" data-src="${urlImg}" alt="Diversidad, cultura y música en Colombia al Parque" class="zone_img lazyload" src="https://placehold.co/400x400.jpg?text=visitbogota" />
        </div>
        <div class="desc">
        <h2>${evento.title}</h2>
        <small class="tag">
        <img src="images/eventosIcono.svg" alt="tag"/>
        ${dateFormatteddateStart} -  ${dateFormatteddateEnd}
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
              <h1 class="uppercase ms900">${zona.name}</h1>
              <a href="/${actualLang}/alrededores-de-bogota" class="uppercase ms900 btn wait">VISITAR</a>
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
              <h2 class="uppercase ms900">${zona.name}</h2>
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
        let template = `<a href="${banner.field_link}" target="_blank" class="city-card"><img src="${urlImg}" alt="${banner.title}" /><span class="uppercase ms700">${banner.title}</span></a>`;
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
  if (document.querySelector(".grid-rutas")) {
    const resp = await fetch(`${actualLang}/g/getRT/`);
    const rutas = await resp.json();
    rutas.forEach((ruta) => {
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
    });
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
if (document.querySelector("body.portal")) {
  var containerGrid = document.querySelector(".grid-atractivos");
  var dataCatId = document.querySelector("#mainPortal").dataset.productid;
  var catName = document.querySelector("#mainPortal").dataset.productname;
  if (dataCatId) {
    filterPortal(dataCatId, catName);
  }
}

if (
  document.querySelectorAll(".interna_atractivo .gallery-grid li img").length >
  0
) {
  // Get all images
  const images = document.querySelectorAll(
    ".interna_atractivo .gallery-grid li img"
  );
  // Loop through each image
  images.forEach((image) => {
    // Create a new element for displaying alt text
    const altElement = document.createElement("span");
    altElement.classList.add("alt-text");
    // Set the text content of the alt element to the alt attribute of the image
    altElement.textContent = image.alt;
    // Insert the new element after the image
    image.parentNode.insertBefore(altElement, image.nextSibling);
  });
}

if (document.querySelectorAll(".ruta_intern .gallery-grid li img").length > 0) {
  // Get all images
  const images = document.querySelectorAll(".ruta_intern .gallery-grid li img");
  // Loop through each image
  images.forEach((image) => {
    // Create a new element for displaying alt text
    const altElement = document.createElement("span");
    altElement.classList.add("alt-text");
    // Set the text content of the alt element to the alt attribute of the image
    altElement.textContent = image.alt;
    // Insert the new element after the image
    image.parentNode.insertBefore(altElement, image.nextSibling);
  });
}
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
