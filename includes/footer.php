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
  <svg width="224" height="112" viewBox="0 0 224 112" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M181.814 54.3852C181.642 54.7042 181.174 55.7839 180.83 56.7899C180.092 58.7775 180.141 58.6548 175.172 71.9297C174.557 73.5982 173.549 76.2483 172.958 77.8187C172.344 79.4137 171.556 81.5484 171.187 82.5545C170.818 83.5605 170.327 84.861 170.081 85.4254C169.81 85.9898 169.613 86.5541 169.613 86.6768C169.613 86.824 169.121 88.1245 168.531 89.5968C167.35 92.5659 166.169 95.8784 166.169 96.271C166.169 96.4673 167.941 96.541 171.827 96.541H177.46L177.853 95.8048C178.05 95.4122 178.222 94.9705 178.222 94.8233C178.222 94.6516 178.37 94.1853 178.567 93.7682C179.206 92.4186 180.215 89.8422 180.682 88.4435C180.953 87.7074 181.445 86.4314 181.814 85.6217C182.183 84.8119 182.773 83.3151 183.142 82.3091C183.511 81.3031 184.101 79.8553 184.446 79.1192C184.79 78.3831 185.233 77.2053 185.454 76.5427C185.823 75.4385 186.168 74.5797 186.832 73.1075C186.955 72.8376 187.25 72.0523 187.471 71.3898C187.693 70.7028 188.086 69.6722 188.381 69.0588C188.652 68.4453 189.39 66.6295 190.005 65.01C191.013 62.409 191.21 62.0655 191.727 62.0655C192.219 62.0655 192.415 62.409 193.449 65.1327C194.088 66.8258 194.777 68.568 194.998 68.9851C195.22 69.4268 195.466 70.1139 195.564 70.531C195.662 70.9236 195.834 71.3162 195.957 71.3898C196.08 71.488 196.179 71.7088 196.179 71.9051C196.179 72.1014 196.376 72.7394 196.646 73.3038C196.892 73.8681 197.409 75.1686 197.778 76.1747C198.368 77.7206 199.549 80.7387 200.336 82.6772C200.951 84.1494 201.984 86.7995 202.476 88.1981C202.796 89.0815 203.165 90.0139 203.288 90.2838C203.804 91.3635 205.034 94.4553 205.034 94.6516C205.034 94.7742 205.182 95.2159 205.378 95.6331C206.166 97.3507 206.707 98.6757 207.125 99.8535C207.371 100.516 207.715 101.473 207.912 101.939C208.109 102.405 208.355 103.019 208.453 103.289C208.576 103.559 208.847 104.197 209.068 104.712C209.29 105.227 209.462 105.743 209.462 105.89C209.462 106.111 210.593 108.908 211.602 111.19L211.946 112H217.456C220.703 112 223.015 111.902 223.114 111.754C223.237 111.533 222.597 109.178 222.253 108.687C222.154 108.54 221.662 107.288 221.146 105.865C220.654 104.442 220.088 102.945 219.916 102.553C219.744 102.136 219.252 100.811 218.809 99.6082C218.366 98.3813 217.923 97.1789 217.825 96.909C217.702 96.6391 217.382 95.9275 217.136 95.3141C216.866 94.7006 216.472 93.5964 216.251 92.8603C216.005 92.1242 215.734 91.2899 215.611 91.02C215.488 90.7501 215.144 89.9158 214.873 89.1797C214.603 88.4435 214.283 87.6092 214.16 87.3393C214.037 87.0694 213.693 86.137 213.373 85.2536C213.078 84.3703 212.758 83.536 212.659 83.4133C212.561 83.2661 212.192 82.3336 211.848 81.3276C211.503 80.3215 210.864 78.6039 210.421 77.5243C210.003 76.4446 209.56 75.2177 209.462 74.8251C209.339 74.408 208.896 73.2056 208.478 72.126C208.035 71.0463 207.592 69.9421 207.494 69.6722C206.879 67.9546 206.166 66.1388 205.895 65.5008C205.723 65.0836 205.354 64.1021 205.083 63.2924C204.616 61.8937 204.395 61.3294 203.657 59.5627C203.46 59.1455 203.312 58.6548 203.312 58.4585C203.312 58.2622 203.214 58.0168 203.091 57.8696C202.968 57.7469 202.746 57.2561 202.624 56.7899C202.205 55.3667 201.738 54.2135 201.467 54.0417C201.344 53.9435 196.941 53.8454 191.702 53.8454H182.158L181.814 54.3852Z" fill="#35498e"/>
    <path d="M42.8117 60.6179C38.9007 61.5258 36.0719 63.0717 33.5137 65.6972C30.9801 68.2492 29.5289 70.9974 28.5695 74.8989C28.1268 76.641 28.053 80.9842 28.422 82.162C28.5449 82.5792 28.8155 83.5361 29.0369 84.2723C29.8978 87.2904 31.3737 89.8178 33.5137 91.9526C39.4664 97.9643 48.4938 98.9703 55.4796 94.4309C58.5052 92.4678 60.4976 90.1858 62.0718 86.9223C64.8514 81.1069 64.3594 74.0155 60.7928 68.47C59.1693 65.9426 55.5534 62.7773 53.3888 61.9921C52.9952 61.8448 52.0359 61.5013 51.298 61.2068C50.1911 60.7652 49.3301 60.6425 46.6244 60.5934C44.8041 60.5443 43.0823 60.5443 42.8117 60.6179ZM47.4853 69.8196C52.4541 70.7275 55.7748 76.6165 54.1267 81.5731C52.4049 86.7506 47.3131 89.327 42.8609 87.2413C39.5402 85.6954 37.5232 82.5055 37.5232 78.7513C37.5232 74.6044 40.4749 70.7275 44.3368 69.8196C45.6405 69.5251 45.8372 69.5251 47.4853 69.8196Z" fill="#35498e"/>
    <path d="M81.9199 60.5691C81.7969 60.6182 81.1819 60.7899 80.567 60.9617C75.5244 62.3603 72.0807 64.716 69.4979 68.4702C67.0627 72.0527 66.4232 74.1384 66.4232 78.7515C66.4232 82.2359 66.5462 82.9965 67.5793 85.7447C68.6862 88.6402 71.392 91.9528 74.2945 93.8913C76.0164 95.0691 76.9265 95.5107 79.4601 96.3205C82.1904 97.2284 86.0031 97.5228 88.3153 97.0075C89.127 96.8358 92.1034 96.6149 94.9567 96.5413L100.122 96.4186L100.196 86.0392C100.221 79.9048 100.147 75.488 100.024 75.2426C99.8271 74.8745 99.1138 74.8255 93.4809 74.8255C89.0286 74.8255 87.11 74.8991 86.9378 75.0954C86.8148 75.2672 86.741 77.1811 86.7656 79.6349L86.8394 83.9044L88.5613 83.978C90.3815 84.0516 90.8981 84.3461 90.8981 85.3767C90.8981 86.1128 90.0371 86.8489 88.4383 87.4624C86.5197 88.223 83.2973 88.0758 81.1819 87.1189C79.2387 86.2355 77.2709 84.3216 76.3607 82.3831C75.426 80.3955 75.3522 77.6473 76.2131 75.5371C77.7628 71.611 82.7808 68.9119 86.8886 69.7952C87.6758 69.9425 88.7089 70.286 89.1762 70.5314C89.6436 70.7768 90.3815 71.1448 90.7751 71.3411C91.1932 71.5374 91.7344 71.93 91.9804 72.2245C92.251 72.4944 92.5707 72.7398 92.7429 72.7398C93.2349 72.7398 98.7694 66.7035 98.7694 66.1637C98.7694 65.722 98.425 65.3539 96.8016 64.078C95.7193 63.2192 93.7514 62.1886 92.2264 61.6978C91.2916 61.4034 90.2585 61.0353 89.9142 60.8881C89.3484 60.6427 82.4856 60.3728 81.9199 60.5691Z" fill="#35498e"/>
    <path d="M117.342 60.6177C115.497 61.1085 112.226 62.3844 111.192 63.0469C107.97 65.0836 105.141 68.7397 103.739 72.6166C102.805 75.2912 102.559 79.021 103.124 82.4317C103.518 84.8364 105.264 88.9096 106.519 90.2838C106.888 90.6764 107.355 91.2407 107.601 91.5106C108.167 92.1977 110.504 94.1116 111.684 94.8478C114.366 96.5163 117.883 97.3751 121.278 97.2034C130.969 96.7372 138.373 88.787 138.373 78.8737C138.373 73.7208 136.233 68.5679 132.666 65.2308C131.633 64.2738 128.731 62.1881 128.411 62.1881C128.313 62.1881 127.894 62.0163 127.476 61.82C125.361 60.8631 124.401 60.6668 121.155 60.5932C119.334 60.5441 117.612 60.5441 117.342 60.6177ZM123.787 70.3837C125.681 71.267 127.058 72.6657 128.165 74.8496C129.001 76.5672 129.124 76.9598 129.124 78.6038C129.149 83.585 125.213 87.9527 120.736 87.9527C118.793 87.9527 117.76 87.6337 116.038 86.4804C111.045 83.1433 110.676 75.4139 115.374 71.6351C118.006 69.5249 120.909 69.0832 123.787 70.3837Z" fill="#35498e"/>
    <path d="M139.774 60.6424C139.676 60.7161 139.602 63.0962 139.602 65.918V71.0219H144.719C147.523 71.0219 149.958 71.12 150.106 71.2182C150.352 71.3654 150.425 74.2854 150.475 83.9287L150.548 96.4184L156.034 96.492L161.494 96.5411V84.0514C161.494 74.3099 161.568 71.4881 161.814 71.3409C161.962 71.2427 164.372 71.0955 167.152 71.0219L172.194 70.8992V65.7463V60.5934L156.058 60.5198C147.203 60.4952 139.848 60.5443 139.774 60.6424Z" fill="#35498e"/>
    <path d="M0.920351 78.6775L0.994144 96.1729H9.23443C18.5078 96.1729 18.7784 96.1238 21.5088 94.308C23.3536 93.0811 25.2476 90.5783 25.8134 88.6398C26.3299 86.824 26.3299 83.6341 25.7888 81.9901C25.5674 81.2785 24.9525 80.0516 24.4605 79.2664L23.5504 77.8187L24.1161 76.5182C25.961 72.3468 25.0509 67.4392 21.8531 64.372C20.1313 62.728 19.4425 62.2863 17.6469 61.6729C16.417 61.2557 15.5315 61.2067 8.57029 61.2067H0.871155L0.920351 78.6775ZM16.0726 69.0096C17.1303 69.7703 17.5977 70.7518 17.5977 72.1505C17.5977 73.6227 16.5892 74.9723 15.1871 75.3894C14.1048 75.7084 10.2675 75.782 9.80018 75.4876C9.5296 75.3158 9.38202 72.7639 9.45581 69.3777C9.48041 68.3962 9.70179 68.3471 12.8011 68.3962C14.9411 68.4453 15.3839 68.5189 16.0726 69.0096ZM15.7037 81.7202C17.0566 81.9655 18.557 83.3887 18.8522 84.7138C19.049 85.6462 18.9998 85.9161 18.5324 86.7995C17.4993 88.6152 17.0074 88.8115 13.3423 88.8852C11.5466 88.9097 9.97237 88.8606 9.80018 88.7379C9.6034 88.6152 9.48041 87.6828 9.45581 85.9897C9.38202 82.1864 9.43121 81.8674 9.92317 81.7447C10.5873 81.5729 14.6706 81.5484 15.7037 81.7202Z" fill="#35498e"/>
    <path d="M170.88 47.2587L177.352 30.2708L164.139 15.9795L182.745 19.7546L192.183 2.22748L201.351 25.4172L214.833 31.0798L204.586 35.1245L211.328 53.4606L194.07 39.4389L170.88 47.2587Z" fill="#35498e"/>
    <path d="M203.51 15.7105L205.397 10.0479L199.464 3.84601L206.744 5.19425L209.44 0.610099L211.421 6.40945L216.723 7.08176L212.678 10.0479L213.757 15.7105L208.903 12.4747L203.51 15.7105Z" fill="#35498e"/>
    <path d="M157.072 41.6673L158.959 36.0047L153.026 29.8028L160.306 31.151L163.002 26.5669L164.983 32.3662L170.285 33.0385L166.24 36.0047L167.318 41.6673L162.465 38.4315L157.072 41.6673Z" fill="#35498e"/>
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
        <li><a href="/<?=$lang?>/banco-imagenes/"><?=$exploraciones_visuales?></a></li>
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