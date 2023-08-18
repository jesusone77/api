<?php

$apiUrl = "https://pokeapi.co/api/v2/pokemon/ditto";
$ch = curl_init($apiUrl); //Esto te permite hacer las opciones de exect o setopt o close
// Configurar opciones de cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch); 

if (curl_errno($ch)) {
    echo 'Error en la solicitud cURL: ' . curl_error($ch);
} else {
    // La respuesta está en formato JSON
    $jsonData = json_decode($response, true);
    print("<pre>".print_r($jsonData,true)."</pre>");

    // Ahora puedes manipular los datos según sea necesario
    // Siguientes pasos
    // foreach ($jsonData as $user) {
    //     // #
    // }
}

// Cerrar la sesión cURL
curl_close($ch);