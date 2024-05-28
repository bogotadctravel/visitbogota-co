<?php 
  $include_level = "../";  
  $project_base = "/vacacional/";
  $project_folder = "vacacional";
  include "../includes/header.php";
  $bogota = new bogota($_GET["lang"] ? $_GET["lang"]  : 'es' );
  include "includes/vacacional.php";
  $vacacional = new vacacional($_GET["lang"] ? $_GET["lang"]  : 'es' );
  if($lang === "es"){

    // Español
    $descubre_bogota = "Descubre Bogotá";
    $bogota_natural = "Bogotá natural";
    $bogota_cultural = "Bogotá cultural";
    $experiencias_turisticas = "Experiencias turísticas";
    $planifica_tu_viaje = "Planifica tu viaje";
    $informacion_util = "Información al viajero";
    $informacion_general = "Información general";
    $como_moverse_en_bogota = "¿Cómo moverse en Bogotá?";
    $descargables = "Descargables - Guías, Tips, Catálogos...";
    $turismo_mice_en_bogota = "Turismo MICE en Bogotá";
    $porque_bogota = "¿Por qué Bogotá?";
    $encuentra_un_lugar_para_tu_evento = "Encuentra un lugar para tu evento";
    $encuentra_proveedores_para_tu_evento = "Encuentra proveedores para tu evento";
    $publicaciones_recientes = "Publicaciones recientes";
    $Porcategoría = "Por categoría";
    $Porzona = "Por zona";
  }else{
  // Inglés
  $descubre_bogota = "Discover Bogotá";
  $bogota_natural = "Natural Bogotá";
  $bogota_cultural = "Cultural Bogotá";
  $experiencias_turisticas = "Tourist Experiences";
  $planifica_tu_viaje = "Plan Your Trip";
  $informacion_util = "Useful Information";
  $informacion_general = "General Information";
  $como_moverse_en_bogota = "How to Move in Bogotá?";
  $descargables = "Downloads - Guides, Tips, Catalogs...";
  $turismo_mice_en_bogota = "Tourism MICE in Bogotá";
  $porque_bogota = "Why Bogotá?";
  $encuentra_un_lugar_para_tu_evento = "Find a Place for Your Event";
  $encuentra_proveedores_para_tu_evento = "Find Suppliers for Your Event";
  $publicaciones_recientes = "Recent Publications";
  $Porcategoría = "By category";
  $Porzona = "By area";
  }
?>