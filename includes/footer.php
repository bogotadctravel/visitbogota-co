<?php
if($lang === "es"){
  $experiencia_turisticas = "Experiencia turísticas";
  $planifica_tu_viaje = "Planifica tu viaje";
  $agenda_empresarial = "Eventos";
  $restaurantes = "Restaurantes";
  $hospedaje = "Hospedaje";
  $blog = "Blog";
  $exploraciones_visuales = "Banco multimedia";
  $cerros = "Cerros";
  $biciturismo = "Biciturismo";
  $gastronomia = "Gastronomía";
  $museos = "Museos";
  $musica_y_arte = "Música y arte";
  $ruta_colonial = "Ruta colonial";
  $senderismo = "Senderismo";
  $termales = "Termales";
  $cómo_moverse_en_Bogotá = "¿Cómo moverse en Bogotá?";
  $informacion_general = "Información general";
  $descargables = "Descargables";
  $recursos_lengua_de_senas = "Recursos lengua de señas";
  $preguntas_frecuentes = "Preguntas frecuentes";
  // Español
  $all_rights_reserved = "© Todos los derechos reservados por el Instituto Distrital de Turismo de Bogotá";
  $privacy_and_terms = "Políticas de privacidad y términos de uso";
  $resolution_239 = "Resolución 239 del 5 de noviembre de 2021";
  $city_brand = "Marca ciudad";
  // Español
  $bogota = "Bogotá";
  $discover_bogota = "Descubre Bogotá";
  $useful_information = "Información al viajero";
  $contact_us = "Contáctanos";
  $turista = "Atención al turista";
}

else{
  $experiencia_turisticas = "Tourist Experiences";
  $planifica_tu_viaje = "Plan Your Trip";
  $agenda_empresarial = "Events";
  $restaurantes = "Restaurants";
  $hospedaje = "Accommodation";
  $blog = "Blog";
  $exploraciones_visuales = "Multimedia bank";
  $cerros = "Hills";
  $biciturismo = "Bicycle Tourism";
  $gastronomia = "Gastronomy";
  $museos = "Museums";
  $musica_y_arte = "Music and Art";
  $ruta_colonial = "Colonial Route";
  $senderismo = "Hiking";
  $termales = "Hot Springs";
  $cómo_moverse_en_Bogotá = "How to Move in Bogotá?";
  $informacion_general = "General Information";
  $descargables = "Downloads";
  $recursos_lengua_de_senas = "Sign Language Resources";
  $preguntas_frecuentes = "Frequently Asked Questions";
  // Inglés
  $all_rights_reserved = "© All rights reserved by Instituto Distrital de Turismo de Bogotá";
  $privacy_and_terms = "Privacy Policy and Terms of Use";
  $resolution_239 = "Resolution 239 of November 5, 2021";
  $city_brand = "City Brand";
  // Inglés
  $bogota = "Bogotá";
  $discover_bogota = "Discover Bogotá";
  $useful_information = "Traveler information";
  $contact_us = "Contact Us";

$turista = "Tourist Assistance";

}
if (!$banners) {
    $banners = $b->generalInfo->field_field_banners;
    $arrayBanners = explode(",", $banners);
    // Imagen Banner Footer
    $bannerFooter = str_replace(' ', '', $arrayBanners[4]);
}
$productsFooter = $b->productmenu('footer');
if (!$planes) {
    $planes = $b->plans();
}
?>
<div id="preloader">
    <div class="image"><img src="<?=$include_level?>img/preloader.gif" alt="preloader"></div>
</div>
<footer>
<div class="container">
<svg width="224" height="112" viewBox="0 0 147 75" fill="none" xmlns="http://www.w3.org/2000/svg">
<g id="Group 3">
<g id="Group">
<path id="Vector" d="M119.674 35.9705C119.56 36.1815 119.251 36.8956 119.023 37.561C118.535 38.8755 118.568 38.7944 115.282 47.5744C114.875 48.678 114.208 50.4308 113.817 51.4694C113.411 52.5243 112.89 53.9363 112.646 54.6017C112.402 55.2671 112.077 56.1272 111.914 56.5005C111.735 56.8738 111.605 57.247 111.605 57.3282C111.605 57.4256 111.279 58.2857 110.889 59.2595C110.108 61.2232 109.327 63.4142 109.327 63.6738C109.327 63.8037 110.498 63.8524 113.069 63.8524H116.795L117.055 63.3655C117.185 63.1058 117.299 62.8137 117.299 62.7163C117.299 62.6027 117.397 62.2943 117.527 62.0184C117.95 61.1258 118.617 59.4218 118.926 58.4967C119.105 58.0098 119.43 57.1659 119.674 56.6303C119.918 56.0948 120.309 55.1048 120.553 54.4394C120.797 53.774 121.187 52.8165 121.415 52.3296C121.643 51.8427 121.936 51.0637 122.082 50.6255C122.326 49.8952 122.554 49.3272 122.993 48.3534C123.074 48.1749 123.27 47.6556 123.416 47.2174C123.563 46.7629 123.823 46.0813 124.018 45.6756C124.197 45.2699 124.685 44.0689 125.092 42.9978C125.759 41.2775 125.889 41.0502 126.231 41.0502C126.556 41.0502 126.686 41.2775 127.369 43.0789C127.792 44.1987 128.248 45.351 128.394 45.6269C128.541 45.919 128.704 46.3734 128.769 46.6493C128.834 46.909 128.948 47.1687 129.029 47.2174C129.11 47.2823 129.175 47.4283 129.175 47.5582C129.175 47.688 129.305 48.11 129.484 48.4832C129.647 48.8565 129.989 49.7167 130.233 50.3821C130.623 51.4045 131.404 53.4007 131.925 54.6828C132.332 55.6566 133.015 57.4093 133.34 58.3344C133.552 58.9187 133.796 59.5354 133.877 59.7139C134.219 60.428 135.032 62.4729 135.032 62.6027C135.032 62.6838 135.13 62.976 135.26 63.2519C135.781 64.3879 136.139 65.2643 136.415 66.0433C136.578 66.4815 136.806 67.1144 136.936 67.4228C137.066 67.7311 137.229 68.1369 137.294 68.3154C137.375 68.4939 137.554 68.9159 137.7 69.2567C137.847 69.5975 137.961 69.9383 137.961 70.0357C137.961 70.1818 138.709 72.0319 139.376 73.5412L139.604 74.0768H143.248C145.396 74.0768 146.925 74.0119 146.99 73.9145C147.071 73.7684 146.648 72.2104 146.421 71.8858C146.355 71.7885 146.03 70.9608 145.688 70.0195C145.363 69.0782 144.989 68.0882 144.875 67.8285C144.761 67.5526 144.436 66.6762 144.143 65.881C143.85 65.0695 143.557 64.2743 143.492 64.0958C143.411 63.9173 143.199 63.4466 143.037 63.0409C142.858 62.6352 142.597 61.9048 142.451 61.418C142.288 60.9311 142.109 60.3793 142.028 60.2008C141.947 60.0222 141.719 59.4705 141.54 58.9836C141.361 58.4967 141.149 57.9449 141.068 57.7664C140.987 57.5879 140.759 56.9711 140.547 56.3869C140.352 55.8026 140.141 55.2508 140.076 55.1697C140.011 55.0723 139.767 54.4556 139.539 53.7902C139.311 53.1248 138.888 51.9888 138.595 51.2747C138.319 50.5606 138.026 49.7491 137.961 49.4895C137.879 49.2136 137.586 48.4183 137.31 47.7042C137.017 46.9902 136.724 46.2598 136.659 46.0813C136.252 44.9453 135.781 43.7443 135.602 43.3223C135.488 43.0464 135.244 42.3973 135.065 41.8617C134.756 40.9366 134.609 40.5634 134.121 39.3949C133.991 39.119 133.893 38.7944 133.893 38.6645C133.893 38.5347 133.828 38.3724 133.747 38.275C133.666 38.1939 133.519 37.8693 133.438 37.561C133.161 36.6197 132.852 35.8569 132.673 35.7433C132.592 35.6784 129.68 35.6134 126.214 35.6134H119.902L119.674 35.9705Z" fill="#35498e"/>
<path id="Vector_2" d="M27.7402 40.093C25.1534 40.6935 23.2825 41.7159 21.5905 43.4525C19.9148 45.1403 18.9549 46.958 18.3204 49.5384C18.0276 50.6907 17.9787 53.5633 18.2228 54.3423C18.3041 54.6182 18.4831 55.2511 18.6295 55.738C19.1989 57.7342 20.1751 59.4058 21.5905 60.8177C25.5276 64.7939 31.4983 65.4593 36.1187 62.4569C38.1198 61.1586 39.4376 59.6492 40.4788 57.4908C42.3172 53.6444 41.9919 48.9542 39.6328 45.2864C38.5591 43.6147 36.1675 41.5212 34.7359 41.0018C34.4756 40.9045 33.8411 40.6773 33.353 40.4825C32.6209 40.1904 32.0515 40.1092 30.2619 40.0768C29.058 40.0443 27.9191 40.0443 27.7402 40.093ZM30.8313 46.179C34.1176 46.7795 36.314 50.6745 35.2239 53.9528C34.0851 57.3771 30.7174 59.0812 27.7727 57.7017C25.5764 56.6793 24.2423 54.5695 24.2423 52.0864C24.2423 49.3437 26.1946 46.7795 28.7489 46.179C29.6111 45.9842 29.7413 45.9842 30.8313 46.179Z" fill="#35498e"/>
<path id="Vector_3" d="M53.605 40.0607C53.5236 40.0932 53.1169 40.2068 52.7102 40.3204C49.375 41.2454 47.0974 42.8035 45.3891 45.2865C43.7785 47.656 43.3555 49.0355 43.3555 52.0866C43.3555 54.3911 43.4368 54.8942 44.1201 56.7119C44.8522 58.627 46.6418 60.8179 48.5616 62.1C49.7004 62.879 50.3024 63.1712 51.9781 63.7067C53.7839 64.3072 56.3056 64.502 57.8349 64.1611C58.3718 64.0475 60.3404 63.9015 62.2276 63.8528L65.6441 63.7716L65.6929 56.9067C65.7092 52.8494 65.6603 49.9281 65.579 49.7658C65.4488 49.5224 64.977 49.4899 61.2514 49.4899C58.3067 49.4899 57.0377 49.5386 56.9239 49.6684C56.8425 49.782 56.7937 51.0479 56.81 52.6708L56.8588 55.4947L57.9976 55.5434C59.2015 55.5921 59.5432 55.7868 59.5432 56.4685C59.5432 56.9554 58.9738 57.4422 57.9163 57.848C56.6473 58.3511 54.516 58.2537 53.1169 57.6208C51.8316 57.0365 50.5301 55.7706 49.9282 54.4885C49.3099 53.1739 49.2611 51.3563 49.8306 49.9606C50.8555 47.3639 54.1744 45.5787 56.8913 46.1629C57.4119 46.2603 58.0952 46.4875 58.4043 46.6498C58.7135 46.8121 59.2015 47.0555 59.4618 47.1853C59.7384 47.3152 60.0963 47.5749 60.259 47.7696C60.438 47.9481 60.6495 48.1104 60.7634 48.1104C61.0887 48.1104 64.7493 44.118 64.7493 43.761C64.7493 43.4689 64.5215 43.2254 63.4478 42.3815C62.7319 41.8135 61.4304 41.1318 60.4217 40.8073C59.8035 40.6125 59.1202 40.3691 58.8924 40.2717C58.5182 40.1094 53.9792 39.9309 53.605 40.0607Z" fill="#35498e"/>
<path id="Vector_4" d="M77.0317 40.0925C75.8115 40.4171 73.6477 41.261 72.9644 41.6992C70.8332 43.0462 68.9622 45.4643 68.0349 48.0286C67.4167 49.7976 67.254 52.2644 67.6282 54.5203C67.8885 56.1107 69.0436 58.8048 69.8733 59.7136C70.1173 59.9733 70.4265 60.3466 70.5891 60.5251C70.9633 60.9795 72.5089 62.2454 73.2898 62.7323C75.0631 63.8359 77.3896 64.4039 79.6347 64.2903C86.0448 63.9819 90.9417 58.7236 90.9417 52.167C90.9417 48.7589 89.5263 45.3507 87.1673 43.1436C86.484 42.5106 84.5643 41.1311 84.3528 41.1311C84.2877 41.1311 84.0111 41.0175 83.7345 40.8877C82.3354 40.2548 81.7009 40.1249 79.5534 40.0762C78.3495 40.0438 77.2107 40.0438 77.0317 40.0925ZM81.2942 46.5517C82.5469 47.136 83.458 48.061 84.1901 49.5054C84.7432 50.6415 84.8246 50.9011 84.8246 51.9885C84.8408 55.283 82.2378 58.1719 79.2768 58.1719C77.9916 58.1719 77.3083 57.9609 76.1694 57.1981C72.8668 54.9909 72.6228 49.8787 75.7302 47.3794C77.471 45.9837 79.3907 45.6916 81.2942 46.5517Z" fill="#35498e"/>
<path id="Vector_5" d="M91.87 40.109C91.805 40.1577 91.7562 41.7319 91.7562 43.5983V46.974H95.1401C96.9948 46.974 98.6054 47.0389 98.7031 47.1038C98.8657 47.2012 98.9146 49.1325 98.9471 55.5106L98.9959 63.7713L102.624 63.82L106.236 63.8524V55.5917C106.236 49.1487 106.284 47.2823 106.447 47.185C106.545 47.1201 108.139 47.0227 109.978 46.974L113.313 46.8928V43.4847V40.0766L102.64 40.0279C96.7833 40.0116 91.9189 40.0441 91.87 40.109Z" fill="#35498e"/>
<path id="Vector_6" d="M0.0325381 52.0374L0.0813453 63.6089H5.53148C11.6649 63.6089 11.8439 63.5764 13.6497 62.3755C14.8699 61.564 16.1226 59.9086 16.4968 58.6265C16.8385 57.4255 16.8385 55.3157 16.4806 54.2284C16.3341 53.7577 15.9274 52.9463 15.602 52.4269L15.0001 51.4694L15.3743 50.6092C16.5944 47.8503 15.9925 44.6044 13.8775 42.5758C12.7387 41.4884 12.2831 41.1963 11.0955 40.7905C10.282 40.5146 9.69636 40.4822 5.09222 40.4822H0L0.0325381 52.0374ZM10.0543 45.6431C10.7538 46.1462 11.063 46.7954 11.063 47.7204C11.063 48.6942 10.3959 49.5868 9.46859 49.8627C8.75275 50.0737 6.21478 50.1224 5.90567 49.9276C5.72671 49.814 5.62909 48.1262 5.6779 45.8865C5.69417 45.2374 5.84059 45.2049 7.89049 45.2374C9.3059 45.2698 9.59874 45.3185 10.0543 45.6431ZM9.81024 54.0499C10.705 54.2121 11.6975 55.1534 11.8927 56.0298C12.0228 56.6465 11.9903 56.8251 11.6812 57.4093C10.9979 58.6103 10.6725 58.7401 8.24841 58.7888C7.06077 58.805 6.01955 58.7726 5.90567 58.6914C5.77552 58.6103 5.69417 57.9936 5.6779 56.8737C5.62909 54.3582 5.66163 54.1472 5.98701 54.0661C6.42628 53.9525 9.12694 53.9362 9.81024 54.0499Z" fill="#35498e"/>
</g>
<g id="Group 1">
<path id="Vector 1" d="M112.442 31.2571L116.723 20.0213L107.984 10.569L120.289 13.0658L126.532 1.47339L132.595 16.8111L141.513 20.5563L134.735 23.2315L139.194 35.359L127.78 26.085L112.442 31.2571Z" fill="#FAC533"/>
<path id="Vector 2" d="M134.024 10.3908L135.272 6.64557L131.348 2.54365L136.163 3.43537L137.946 0.403409L139.256 4.23911L142.763 4.68378L140.088 6.64557L140.801 10.3908L137.591 8.25068L134.024 10.3908Z" fill="#FAC533"/>
<path id="Vector 3" d="M103.311 27.5589L104.559 23.8137L100.634 19.7117L105.45 20.6035L107.233 17.5715L108.543 21.4072L112.049 21.8519L109.374 23.8137L110.088 27.5589L106.877 25.4188L103.311 27.5589Z" fill="#FAC533"/>
</g>
</g>
</svg>


  <div class="socials">
    <a target="_blank" href="https://www.facebook.com/visitbogota.co/"><svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="0.193314" y="0.249695" width="49.125" height="49" rx="24.5" fill="currentColor"/><path d="M26.9433 26.6247H30.0683L31.3183 21.6247H26.9433V19.1247C26.9433 17.8372 26.9433 16.6247 29.4433 16.6247H31.3183V12.4247C30.9108 12.3709 29.3721 12.2497 27.7471 12.2497C24.3533 12.2497 21.9433 14.3209 21.9433 18.1247V21.6247H18.1933V26.6247H21.9433V37.2497H26.9433V26.6247Z" fill="#35498e"/></svg></a>
    <a target="_blank" href="https://www.instagram.com/visitbogota.co"><svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="0.318314" y="0.0055542" width="49.4883" height="49.4883" rx="24.7442" fill="currentColor"/><path d="M30.3856 12.0056H19.3174C15.7461 12.0056 12.8515 15.0213 12.8515 18.7415V30.2697C12.8515 33.9899 15.7466 37.0056 19.3179 37.0056H30.3851C33.9565 37.0056 36.8515 33.9899 36.8515 30.2697V18.7415C36.8515 15.0213 33.957 12.0056 30.3856 12.0056Z" stroke="#35498e" stroke-width="2" stroke-miterlimit="10"/><path d="M24.8515 31.0056C28.1652 31.0056 30.8515 28.3193 30.8515 25.0056C30.8515 21.6919 28.1652 19.0056 24.8515 19.0056C21.5378 19.0056 18.8515 21.6919 18.8515 25.0056C18.8515 28.3193 21.5378 31.0056 24.8515 31.0056Z" stroke="#35498e" stroke-width="2" stroke-miterlimit="10"/><path d="M32.3515 19.0056C33.1799 19.0056 33.8515 18.334 33.8515 17.5056C33.8515 16.6772 33.1799 16.0056 32.3515 16.0056C31.5231 16.0056 30.8515 16.6772 30.8515 17.5056C30.8515 18.334 31.5231 19.0056 32.3515 19.0056Z" fill="#35498e"/></svg></a>
    <a target="_blank" href="https://www.threads.net/@visitbogota.co"><svg width="51" height="50" viewBox="0 0 51 50" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="0.806641" y="-0.000488281" width="50" height="50" rx="25" fill="white"/><path d="M23.1366 19.66C26.2679 17.1425 30.7741 18.485 31.3066 22.625C31.8716 27.0175 30.7441 30.5 26.3691 30.5C22.3066 30.5 22.4316 27 22.4316 27C22.4316 23.25 28.8691 22.75 32.6191 24.625C39.4941 29 34.4941 37 26.9941 37C20.7816 37 15.7441 33.875 15.7441 24.5C15.7441 15.125 20.7816 12 26.9941 12C31.3791 12 35.3341 14.2588 36.7879 18.775" stroke="#35498e" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
    <a target="_blank" href="https://twitter.com/visitbogotaco"><svg width="51" height="50" viewBox="0 0 51 50" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="0.806641" y="-0.000488281" width="50" height="50" rx="25" fill="white"/><path d="M28.0712 23.1235L36.9315 12.7495H34.8315L27.1402 21.7568L20.9942 12.7495H13.9067L23.1992 26.3715L13.9067 37.2495H16.0067L24.1302 27.7365L30.621 37.2495H37.7085L28.0712 23.1235ZM25.196 26.4905L24.2545 25.1343L16.7627 14.342H19.988L26.0325 23.0518L26.974 24.408L34.8332 35.7305H31.608L25.196 26.4905Z" fill="#35498e"/></svg></a>
    <a target="_blank" href="https://www.youtube.com/channel/UC_qgv3BFpK3EhqBPL0iR2IQ"><svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="0.806656" y="-0.000305176" width="49" height="49.5" rx="24.5" fill="currentColor"/><path d="M22.8067 28.4998L29.2942 24.7498L22.8067 20.9998V28.4998ZM37.2567 18.7123C37.4192 19.2998 37.5317 20.0873 37.6067 21.0873C37.6942 22.0873 37.7317 22.9498 37.7317 23.6998L37.8067 24.7498C37.8067 27.4873 37.6067 29.4998 37.2567 30.7873C36.9442 31.9123 36.2192 32.6373 35.0942 32.9498C34.5067 33.1123 33.4317 33.2248 31.7817 33.2998C30.1567 33.3873 28.6692 33.4248 27.2942 33.4248L25.3067 33.4998C20.0692 33.4998 16.8067 33.2998 15.5192 32.9498C14.3942 32.6373 13.6692 31.9123 13.3567 30.7873C13.1942 30.1998 13.0817 29.4123 13.0067 28.4123C12.9192 27.4123 12.8817 26.5498 12.8817 25.7998L12.8067 24.7498C12.8067 22.0123 13.0067 19.9998 13.3567 18.7123C13.6692 17.5873 14.3942 16.8623 15.5192 16.5498C16.1067 16.3873 17.1817 16.2748 18.8317 16.1998C20.4567 16.1123 21.9442 16.0748 23.3192 16.0748L25.3067 15.9998C30.5442 15.9998 33.8067 16.1998 35.0942 16.5498C36.2192 16.8623 36.9442 17.5873 37.2567 18.7123Z" fill="#35498e"/></svg></a>
  </div>
  <div class="menus-footer">
    <nav>
      <h6><?=$bogota?></h6>
      <ul>
        <!-- <li><a href="/<?=$lang?>/experiencias-turisticas/"><?=$experiencia_turisticas?></a></li> -->
        <li><a href="/<?=$lang?>/eventos/agenda-empresarial-148"><?=$agenda_empresarial?></a></li>
        <li><a href="/<?=$lang?>/blog"><?=$blog?></a></li>
          <li><a href="https://eldorado.aero"  target="_blank"><?=$aeropuerto?></a></li>
          <!-- <li><a href="/<?=$lang?>/mice" ><?=$turismoMICE?></a></li> -->
          <li><a href="/<?=$lang?>/banco-imagenes/" ><?=$bancoMultimedia?></a></li>
          <li> <a href="/<?=$lang?>/ruta-leyenda-el-dorado/inicio" >Ruta leyenda el dorado</a></li>
      </ul>
    </nav>
    <nav id="footerDescubre">
      <h6><?=$discover_bogota?></h6>
      <ul>
      </ul>
    </nav>
    <nav>
      <h6><?=$useful_information?></h6>
      <ul>
        <li><a href="/<?=$lang?>/informacion-al-viajero"><?=$cómo_moverse_en_Bogotá?></a></li>
        <li><a href="/<?=$lang?>/informacion-al-viajero"><?=$informacion_general?></a></li>
        <li><a href="/<?=$lang?>/informacion-al-viajero"><?=$descargables?></a></li>
        <!-- <li><a href="/<?=$lang?>/informacion-al-viajero"><?=$recursos_lengua_de_senas?></a></li>
        <li><a href="/<?=$lang?>/informacion-al-viajero"><?=$preguntas_frecuentes?></a></li> -->
      </ul>
    </nav>
    <nav>
      <h6><?=$contact_us?></h6> 
      <ul>
      <li>
        <?= $b->generalInfo->field_ciudadano_txt ?> <a href="tel:<?= $b->generalInfo->field_ciudadano ?>"> <?= $b->generalInfo->field_ciudadano ?></a>
        </li>
        <li>
        <?= $b->generalInfo->field_turista_txt ?> <a href="tel:<?= $b->generalInfo->field_turista ?>"> <?= $b->generalInfo->field_turista ?></a>
        </li>
        <li>
        <a href="https://wa.me/<?= $b->generalInfo->field_whatsapp ?>" class="whatsapp" target="_blank" rel="noopener"><?=$turista?></a>
        </li>
      </ul>
    </nav>

  </div>
</div>
<div class="politics">
<small><?=date("Y") ?> <?=$all_rights_reserved?></small>
<div class="links">
  <a href="/<?= $lang ?>/politica-tratamiento-datos-personales"><?=$privacy_and_terms?></a>
  <a target="_blank" href="<?=$urlGlobal?><?= $b->generalInfo->field_resolucion_239?>"><?=$resolution_239?></a>
  <a target="_blank" href="https://www.idt.gov.co/es/marca-ciudad"><?=$city_brand?></a>
</div>
</footer>
<!-- SCRIPTS -->
<script src="<?=$include_level?>js/jquery-1.12.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
<script src="<?=$include_level?>js/jquery.validate.min.js"></script>
<script src="<?=$include_level?>js/jquery.form.js"></script>
<script src="<?=$include_level?>js/additional-methods.min.js"></script>
<script src="<?=$include_level?>js/jquery.fancybox.min.js"></script>
<script src="<?=$include_level?>js/slick.min.js"></script>
<script src="<?=$include_level?>js/iphone-inline-video.min.js"></script>
<!-- <script src="<?=$include_level?>js/aos.js"></script> -->
<script src="<?=$include_level?>js/jquery.mCustomScrollbar.js"></script>
<script src="<?=$include_level?>js/custom_select.js"></script>
<script src="<?=$include_level?>js/cookie.js"></script>
<script src="<?=$include_level?>js/traffic.js?v=<?=time();?>"></script>
<script src="<?=$include_level?>js/main.js?v=<?=time();?>"></script>

<script>
    function openSubForm(){
        $.fancybox.open({
              src: "/b/sub/",
              type: "ajax",
              opts: {
                afterShow: function (instance, current) {
                  console.info("done!");
                    // FORMS VALIDATE
  validateSubscribe();
                },
              },
            });
    }
</script>
<script>
  if(!document.querySelector(".informacion_util")){
    window.addEventListener(
    "contextmenu",
    function (e) {
      e.preventDefault();
    },
    false
  );
  }
</script>
</body>

</html>