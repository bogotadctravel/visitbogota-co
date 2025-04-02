<?php 
$bodyClass = 'ra'; 
include "includes/head.php";

$placeID = $_GET['id'];
$place = $b->singlePlace($placeID);
$place = $place[0];

// URLs y rutas
$url = "https://files.visitbogota.co" . $place->field_archivo_ra;
$dir = "/home/bogotas/public_html/visitbogota.co/vacacional/archivos/";
$localPath = $dir . basename($place->field_archivo_ra);
$localUrl = "/vacacional/archivos/" . basename($place->field_archivo_ra); // Ruta pública

// Verificar si la carpeta existe, si no, crearla
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
}

// Función para descargar el archivo con cURL
function downloadFile($url, $path) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    
    $data = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    if ($http_code !== 200) {
        die("Error al descargar el archivo. Código HTTP: $http_code - Error: $error");
    }

    file_put_contents($path, $data);
}

// Descargar el archivo si no existe
if (!file_exists($localPath)) {
    downloadFile($url, $localPath);
}
?>
<style>
    #contenedor3D {
    width: 100vw;
    height: 100vh;
    overflow: hidden;
}
canvas {
    display: block;
}
</style>
  <div id="contenedor3D"></div>

<script type="importmap">
{
"imports": {
"three": "/vacacional/build/three.module.js",
"three/addons/controls/": "/vacacional/jsm/"
}
}
</script>
<script type="module">
    import * as THREE from 'three';
    import { OrbitControls } from 'https://cdn.jsdelivr.net/npm/three@0.153.0/examples/jsm/controls/OrbitControls.js';
    import { FBXLoader } from 'https://cdn.jsdelivr.net/npm/three@0.153.0/examples/jsm/loaders/FBXLoader.js';

    const scene = new THREE.Scene();
    // scene.add(new THREE.AxesHelper(5));

    const ambientLight = new THREE.AmbientLight();
    scene.add(ambientLight);

    const camera = new THREE.PerspectiveCamera(
        75,
        window.innerWidth / window.innerHeight,
        0.1,
        1000
    );
    camera.position.set(0.8, 2, 25.0);

    const renderer = new THREE.WebGLRenderer();
    renderer.setSize(window.innerWidth, window.innerHeight);
    const container = document.getElementById("contenedor3D");
    container.appendChild(renderer.domElement);

    const controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.target.set(0, 1, 0);

    let mixer;
    const clock = new THREE.Clock();

    const fbxLoader = new FBXLoader();
    fbxLoader.load(
        '<?=$localUrl?>',
        (object) => {
            mixer = new THREE.AnimationMixer(object);

            if (object.animations.length > 0) {
                const action = mixer.clipAction(object.animations[0]);
                action.play();
            }

            object.traverse((child) => {
                if (child.isMesh) {
                    child.castShadow = true;
                    child.receiveShadow = true;
                }
            });
            object.position.set(0, 0, 0);
            object.scale.set(0.5, 0.5, 0.5);
            scene.add(object);
        },
        (xhr) => {
            console.log((xhr.loaded / xhr.total) * 100 + '% loaded');
        },
        (error) => {
            console.error(error);
        }
    );

    window.addEventListener('resize', onWindowResize, false);
    function onWindowResize() {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
        render();
    }

    function animate() {
        requestAnimationFrame(animate);

        const delta = clock.getDelta();
        if (mixer) mixer.update(delta);

        controls.update();
        render();
    }

    function render() {
        renderer.render(scene, camera);
    }

    animate();

</script>

<? include 'includes/imports.php'?>