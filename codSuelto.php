<?php
function agregarPalabra($coleccionPalabras, $palabraParaAgregar)
{
    $palabraExistente = false;
    $i = 0;
    $numPalabras = count($coleccionPalabras);

    while ($i < $numPalabras && !$palabraExistente) {
        if (strtoupper($coleccionPalabras[$i]) === strtoupper($palabraParaAgregar)) {
            $palabraExistente = true;
        }
        $i++;
    }

    if ($palabraExistente) {
        echo "La palabra ya se encuentra en la colección. Intente con otra palabra.\n";
        return $coleccionPalabras;
    }

    $coleccionPalabras[] = $palabraParaAgregar;
    echo "La palabra se ha agregado correctamente a la colección de palabras Wordix.\n";

    return $coleccionPalabras;
}

function mostrarPartida($nro, $coleccionPartidas)
{
    $indice = $nro - 1;
    $partida = $coleccionPartidas[$indice];

    echo "\n******************************************************";
    echo "\nPartida WORDIX $nro: palabra {$partida['palabraWordix']}\n";
    echo "Jugador: {$partida['jugador']}\n";
    echo "Puntaje: {$partida['puntaje']} puntos\n";

    $intentos = $partida['intentos'];

    if ($intentos != 0) {
        echo "Intento: Adivinó la palabra en $intentos intento(s).\n";
        echo "******************************************************\n";
    } else {
        echo "Intento: No adivinó la palabra.\n";
        echo "******************************************************\n";
    }
}

//Una función que dada la colección de partidas y el nombre de un jugador, retorne el resumen del jugador
//utilizando la estructura c) de la sección EXPLICACIÓN 2.




//Una función que dada una colección de pardas y el nombre de un jugador, retorne el índice de la primer
//partida ganada por dicho jugador.
// ** Estructura asociativa, almacena el resumen de un jugador que tendrá los siguientes datos: 
// ** jugador, partidas, puntaje, victorias, intento1, intento2, intento3, intento4, intento5, intento6. **

function resumenJugador($coleccionPartidas, $nombreJugador){
    $totalPartidas = 0;
    $totalPuntaje = 0;
    $totalVictorias = 0;
    $intentosAdivinados = [];
    

}

function primerPartidaGanada($coleccionPartidas, $nombreJugador){
    for 
}
?>