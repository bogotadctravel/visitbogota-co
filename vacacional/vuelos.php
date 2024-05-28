<?php
$bodyClass = 'vuelos';
include 'includes/head.php';
?>
<main class="backLinkN">
    <div class="container">
        <div class="tabs">
            <ul class="tabs-nav">
                <li><a href="#tab-1"><img src="images/vuelos/llegadas.svg" alt="llegadas">Llegadas</a></li>
                <li><a href="#tab-2"><img src="images/vuelos/salidas.svg" alt="salidas">Salidas</a></li>
            </ul>
            <div class="tabs-stage">
                <video src="images/vuelos/preloader.webm" loop autoplay muted></video>
                <div id="tab-1">
                    <ul>

                    </ul>

                </div>
                <div id="tab-2">
                    <ul>

                    </ul>

                </div>
            </div>
        </div>
</main>

<?php include 'includes/imports.php'; ?>
<script>
    // Show the first tab by default
    $('.tabs-stage div').hide();
    $('.tabs-stage div:first').show();
    $('.tabs-nav li:first').addClass('tab-active');

    // Change tab class and display content
    $('.tabs-nav a').on('click', function (event) {
        event.preventDefault();
        $('.tabs-nav li').removeClass('tab-active');
        $(this).parent().addClass('tab-active');
        $('.tabs-stage > div').hide();
        $($(this).attr('href')).show();
    });
    const request = async () => {
        const response = await fetch('https://api.eldorado.aero/api/flights');
        const data = await response.json();
        const { arrivals, departures } = data.data;

        // Helper function to fetch and cache images
        const fetchAndCacheImage = async (imageUrl) => {
            // Implement your image caching logic here
            return fetch(imageUrl).then(response => response.blob());
        };

        // Helper function to generate the HTML template
        const generateTemplate = (flight, tabId) => {
            const { city, scheduleDate, airline, number, status } = flight;
            const inputDate = new Date(scheduleDate);
            const options = {
                hour: "2-digit",
                minute: "2-digit"
            };
            const formattedDate = new Intl.DateTimeFormat("es-ES", options).format(inputDate);

            return `
      <li>
        <div class="cities">
        <p>${city.cityName}</p>
        </div>
        <div class="time">
          ${formattedDate}
        </div>
        <div class="header">
          <a href="${airline.website}">
            <img src="https://content.airhex.com/content/logos/airlines_${airline.code}_80_40_r.png?proportions=keep" alt="">
          </a>
          <small>${number}</small>
        </div>
        <div class="status ${status.statusCode}">
          <h3>${status.es}</h3>
        </div>
      </li>
    `;
        };

        // Fetch and cache images for both arrivals and departures in parallel
        const arrivalImagePromises = arrivals.map((arrival) => fetchAndCacheImage(arrival.city.image));
        const departureImagePromises = departures.map((departure) => fetchAndCacheImage(departure.city.image));
        const [arrivalImages, departureImages] = await Promise.all([Promise.all(arrivalImagePromises), Promise.all(departureImagePromises)]);

        arrivals.forEach((arrival, index) => {
            const template = generateTemplate(arrival, "tab-1");
            document.querySelector("#tab-1 ul").insertAdjacentHTML("beforeend", template);
        });

        departures.forEach((departure, index) => {
            const template = generateTemplate(departure, "tab-2");
            document.querySelector("#tab-2 ul").insertAdjacentHTML("beforeend", template);
        });
        $('.tabs-stage video').fadeOut();
    };

    request()
</script>