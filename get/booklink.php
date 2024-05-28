<!DOCTYPE HTML>
<html>
    <head>
        <title>Redirigiendo...</title>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-8N63N7HW85"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-8N63N7HW85');

        /*const myEvent = {
            event_name: "form_start", // Nombre del evento
            event_params: { // Parámetros opcionales del evento
                category: "bookings",
                label: "<?=$_GET['id']?>",
                value: <?=$_GET['price']?>
            }
            };*/
         gtag('event', 'form_start', {'event_category': 'bookings', 'event_label':'<?=$_GET['id']?>','value':<?=$_GET['price']?>});
         //dataLayer.push(myEvent);
        window.location = "<?=$_GET['url']?>";
        </script>

    </head>
    <body>
       <h1> Te estamos redirigiendo al link de reserva de la empresa responsable de esta oferta...</h1>
    </body>

    <style>
        <h1></h1>
    </style>
    </html>
