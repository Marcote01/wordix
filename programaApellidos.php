<?php
include_once("wordix.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Valenzuela, Alexis. FAI 5560. TUDW. alexis.valenzuela@est.fi.uncoma.edu.ar . alevalenzuelahk */
/* Fernandez Marcos. FAI 5620. marcosfer1323@gmail.com . Marcote01 */
/* ****COMPLETAR***** */


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Obtiene una colección de palabras
 * @return array
 */
function cargarColeccionPalabras()
{
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "BRUTO", "FRUTA", "TRUCO", "FRUTO", "LASTRE"
    ];

    return ($coleccionPalabras);
}

/* ****COMPLETAR***** */



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
  escribirMensajeBienvenida($usuario)
  $partida = jugarWordix("MELON", strtolower("MaJo"));
  print_r($partida);
  imprimirResultado($partida); 
 */



do {
    echo "Seleccioná el número que desees: \n
    1) Jugá al wordix con una palabra a elegir por vos! \n
    2) Jugá al wordix con una palabra aleatoria! \n
    3) Visualizá datos de una partida anterior: \n
    4) Visualizá la primera victoria del jugador que quieras: \n
    5) Visualizá las estadísticas de un jugador: \n
    6) Visualizá listado de partidas ordenadas alfabéticamente por jugador y por palabra: \n
    7) Agregá tu palabra de 5 letras al juego Wordix: \n
    8) Salir. \n";

    $opcion = trim(fgets(STDIN));
    switch ($opcion) {
        case 1: 
            echo "Ingrese el número de palabra, y a continuación, el nombre de usuario: \n";
            $palabraWordix = trim(fgets(STDIN));
            $nombreUsuario = trim(fgets(STDIN));
            esPalabra($palabraWordix)
            jugarWordix($palabraWordix, $nombreUsuario)

            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

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
} while ($opcion < 8 && $opcion >=1);


