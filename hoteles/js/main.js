var filtersoptions = [];
var sliderobjects = [];
$(document).ready(function () {
  if ($(".mice-home").length > 0) {
    setHome();
  }
  if ($(".cards").length > 0) {
    setCategory("hotels");
  }
});

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

    $.post("get/filter.php", { filter: filterid }, function (data) {
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
          '<p class="filtercheck fw500" data-filter="' +
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
    });
  });
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
  window.scrollTo(0, 0);

  $("#disabler").show();
  $(".cards").addClass("loading");
  var itscontent = $(".cards").find(".content");
  itscontent.html("");
  $.post(
    "get/" + cattype + ".php",
    { filters: completefilters },
    function (data) {
      console.log(data);
      if (data.length > 0) {
        for (var i = 0; i < data.length; i++) {
          venueUrl = `/${actualLang}/donde-dormir/ver/${get_alias(
            data[i].title
          )}-${data[i].nid}`;

          //console.log(data[i].nid);
          var thumbnail = data[i].field_img;
          //Campo calificacion ->  data[i].field_calificacion
          var venueUrl;

          if (thumbnail == "") {
            thumbnail =
              "https://via.placeholder.com/400x400.jpg?text=Bogotadc.travel";
          }
          var strtemplate =
            `<article class="card-item graybg totalclick"><div class="flex"> 
                <figure class="column w_30 basic_bg" style="background-image:url(` +
            absoluteURL(thumbnail) +
            `">
                    <img src="` +
            absoluteURL(thumbnail) +
            `" alt="` +
            data[i].title +
            `" />
                </figure>
                <div class="card-content column w_70">
                
                    <h1><a class="fw700 uppercase" href="${venueUrl}">` +
            data[i].title +
            `</h1></a>  
                    <h2 class="uppercase">
                    ${data[i].field_zonegroup_1}
                    ${
                      data[i].field_zone_rel_1
                        ? `, ${data[i].field_zone_rel_1}`
                        : ``
                    }
                    </h2>
                      <div class="address">
                        <img src="img/ubicacion_icon.svg" alt="address" /><span> ${
                          data[i].field_hadress ? data[i].field_hadress : ""
                        } </span>
                      </div>
                      <div class="phone">
                        <img src="img/tel_icon.svg" alt="address" /><span>Tel: ${
                          data[i].field_htel ? data[i].field_htel : ""
                        } </span>
                      </div>
                      <div class="email">
                       
                          <span> ${
                            data[i].fild_hweb ? data[i].fild_hweb : ""
                          } </span>
                    
                      </div>
                </div>
            </div>
            
        </article>`;
          itscontent.append(strtemplate);
        }
      } else {
        itscontent.append(
          `<p class="noresults">No hemos encontrado resultados</p>`
        );
      }

      $("#disabler").fadeOut("fast");
      $(".cards").removeClass("loading");
      var elements = document.getElementsByClassName("totalclick");
      for (var i = 0; i < elements.length; i++) {
        elements[i].addEventListener("click", function () {
          var link = this.querySelector("a");
          if (link) {
            link.click();
          }
        });
      }
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

  //Mayusculas
  str = str.toLowerCase();

  return str;
}

if (document.querySelector(".grid-hotels")) {
  relHotels();
}

function relHotels(type, zone, aforo) {
  let idSingleVenue = document.querySelector(".internVenue-body main").dataset
    .venueid;
  var containerGridVenues = document.querySelector(".grid-hotels");
  containerGridVenues.innerHTML = "";
  // Create URL to FETCH
  var url = "get/getHotels.php?filter=1";

  // Fetch final URL
  fetch(url)
    .then((response) => response.json())
    .then((venues) => {
      if (venues.length > 1) {
        for (let index = 0; index < 4 && index < venues.length; index++) {
          const venue = venues[index];
          if (venue.nid != idSingleVenue) {
            venueUrl = `/${actualLang}/donde-dormir/ver/${get_alias(
              venue.title
            )}-${venue.nid}`;
            var thumbnail = venue.field_img;

            if (thumbnail == "") {
              thumbnail =
                "https://via.placeholder.com/400x400.jpg?text=Bogotadc.travel";
            }
            var template =
              `
              <li>
              <a href="${venueUrl}">
               <figure class="column w_30 basic_bg" style="background-image:url(` +
              absoluteURL(thumbnail) +
              `">
                      <img src="` +
              absoluteURL(thumbnail) +
              `" alt="` +
              venue.title +
              `" />
                  </figure>
                <div class="data">
                   <h1>
              ${venue.title}
              </h1>
                        <div class="address">
                          <span> ${
                            venue.field_foodzone_1 ? venue.field_foodzone_1 : ""
                          } </span>
                        </div>
                        <div class="address">
                          <img src="img/ubicacion_icon.svg" alt="address" /><span> ${
                            venue.field_hadress ? venue.field_hadress : ""
                          } </span>
                        </div>
                        <div class="phone">
                          <img src="img/tel_icon.svg" alt="telefono" /><span>Tel: ${
                            venue.field_htel ? venue.field_htel : ""
                          } </span>
                        </div>
                        <div class="email">
                            <span> ${
                              venue.fild_hweb ? venue.fild_hweb : ""
                            } </span>
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
            document.querySelector(".relHotels").style.display = "none";
          }
        }
      } else {
        document.querySelector(".relHotels").style.display = "none";
      }
    })
    .then(function () {
      lazyImages();
      $(".venuesList .right").toggleClass("loading");
    });
}
