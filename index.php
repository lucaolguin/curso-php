<?php
const API_URL = "https://whenisthenextmcufilm.com/api";

# Inicializar una nueva sesion de cURL; ch = curl handle
$ch = curl_init(API_URL);

// Indicar  que queremos recibir el resultado de la peticion}
// y no mostrarla en pantalla
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Desactiva verificación SSL (solo para pruebas)

/* Ejecutar la peticion
y guardardamos el resultado 
*/
$result = curl_exec($ch);
if ($result === false) {
    die("cURL error: " . curl_error($ch)); // Muestra el error si falla
}


// Una alternativa seria utilizar file_get_contents
// $result = file_get_contents(API_URL); // para hacer solo un GET de una API
$data = json_decode($result, true);
curl_close($ch);

?>

<head>
    <meta charset="UTF-8">
    <title>La próxima película de Marvel</title>
    <meta name="description" content="La proxima pelicula de marvel">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css">
</head>


<main>
    <section>
        <img 
            src="<?= $data["poster_url"]; ?>" width= "300" alt="Poster de <?= $data["title"]; ?>"
            style="border-radius: 16px; border: 3px solid black;">
    </section>

    <hgroup>
        <h2> <?= $data["title"]; ?> se estrena en <?= $data["days_until"] ?> días</h2>
        <p> Fecha de estreno: <?= $data["release_date"] ?></p>
        <p> La siguiente es: <?= $data["following_production"]["title"] ?> en <?= $data["following_production"]["days_until"] ?> días.</p>
    </hgroup>
</main>

<style>
    :root {
        color-scheme: black on white;
    }

    body {
        display: grid;
        place-content: center;
    }

    section {
        display: flex;
        justify-content: center;
    }

    hgroup {
        display: flex;
        flex-direction: column;
        text-align: center;
    }

    img {
        margin: 0 auto;
    }
</style>