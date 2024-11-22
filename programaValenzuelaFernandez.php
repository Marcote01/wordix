<?php
include_once("wordix.php");

                                    /***** INTEGRANTES *******/
/* 
 -- Apellido y nombre --      -- Legajo --   -- Carrera --              -- Correo --                -- Usuario de Github --     
    
    Valenzuela, Alexis.         FAI 5560.        TUDW        alexis.valenzuela@est.fi.uncoma.edu.ar     /alevalenzuelahk
    Fernández Marcos.           FAI 5620.        TUDW        marcosfer1323@gmail.com                    /Marcote01
*/


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Obtiene una colección de palabras, siendo ésta una estructura de 20 palabras.
 * @return array
 */
function cargarColeccionPalabras() {
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "BRUTO", "FRUTA", "TRUCO", "FRUTO", "LASTRE"
    ];
    return ($coleccionPalabras);
}

/**
 * Almacena las partidas guardadas con sus respectivos datos/valores ingresados. 
 * Desde $part1 hasta $part12 se encuentran datos de partidas pre cargadas.
 * Estructura tipo asociativa.
 * @return array
 */
function cargarPartidas()
{   //inicializacion de array 
    $coleccionPartidas=[];
    $part1 = ["palabraWordix" => "MUJER", "jugador" => "luis", "intentos" => 0, "puntaje" => 0];
    $part2 = ["palabraWordix" => "QUESO", "jugador" => "ale", "intentos" => 1, "puntaje" => 6];
    $part3 = ["palabraWordix" => "FUEGO", "jugador" => "bimbo", "intentos" => 3, "puntaje" => 9];
    $part4 = ["palabraWordix" => "RASGO", "jugador" => "pedro", "intentos" => 4, "puntaje" => 8];
    $part5 = ["palabraWordix" => "CASAS", "jugador" => "karel", "intentos" => 0, "puntaje" => 0];
    $part6 = ["palabraWordix" => "GATOS", "jugador" => "karel", "intentos" => 5, "puntaje" => 7];
    $part7 = ["palabraWordix" => "GOTAS", "jugador" => "luis", "intentos" => 5, "puntaje" => 7];
    $part8 = ["palabraWordix" => "HUEVO", "jugador" => "kleiton", "intentos" => 0, "puntaje" => 0];
    $part9 = ["palabraWordix" => "FRUTO", "jugador" => "luz", "intentos" => 4, "puntaje" => 8];
    $part10 = ["palabraWordix" => "BRUTO", "jugador" => "cabrito", "intentos" => 0, "puntaje" => 0];
    $part11 = ["palabraWordix" => "FRUTA", "jugador" => "matias", "intentos" => 2, "puntaje" => 10];
    $part12 = ["palabraWordix" => "TINTO", "jugador" => "matias", "intentos" => 0, "puntaje" => 0];
    array_push($coleccionPartidas, $part1, $part2, $part3, $part4, $part5, $part6, $part7, $part8, $part9, $part10, $part11, $part12);
    return ($coleccionPartidas);
}

/** ***COMPLETADO, falta testear***
 * Agrega una palabra de 5 letras a la colección de palabras Wordix.
 * @param array $coleccionPalabras
 * @param string $palabraParaAgregar
 * @return array Retorna colección de palabras actualizada.
 */
function agregarPalabra($coleccionPalabras, $palabraParaAgregar) {
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

/** ***COMPLETADO, falta testear***    
 * Muestra los detalles de una partida específica.
 * @param int $nro
 * @param array $coleccionPartidas
 */
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


/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:
//@var int $palabraWordix
//@var string $usuario

//Inicialización de variables:


//Proceso:
/* echo"Ingrese su nombre: ";
  $usuario=trim(fgets(STDIN));
  $partida = jugarWordix("MELON", strtolower("MaJo"));


  
  print_r($partida);
  imprimirResultado($partida); 
 */



do {
    $opcion= menuDeOpciones();
    switch ($opcion) {
        case 1: 
            echo "Ingrese el número de palabra, y a continuación, el nombre de usuario: \n";
            $palabraWordix = trim(fgets(STDIN));
            $nombreUsuarioJugando = trim(fgets(STDIN));
            esPalabra($palabraWordix);
            jugarWordix($palabraWordix, $nombreUsuarioJugando);
            
            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2
            /*  
            $palabraWordix= coleccionPalabras[rand(int)]
            
            echo "Ingrese su nombre de usuario: \n";
            $nombreUsuarioJugando = trim(fgets(STDIN)); 
            
            jugarWordix($nombreUsuarioJugando, )
            */
            break;
        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3
            break;
        case 4: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 4

            break;
        case 5: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 5
            break;

        case 6: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 6

            break;
        case 7: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 7

            break;
        case 8: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 8
            //echo"SALIDA";
            break;
    }
        if(($opcion<=3) && ($opcion >=1 )){
           // Arreglo contenedor predefinido
        agregarPartida(&$coleccion, $palabra, $jugador, $intentos, $puntaje);}
  

} while ($opcion != 8);


