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

/**
 * Obtiene la coleccion de partidas
 * @return array
 */
function cargarColeccionPartidas()

{   //inicializacion de array 
    $coleccionPartidas=[];

    //

    $pa1 = ["palabraWordix" => "SUECO", "jugador" => "kleiton", "intentos" => 0, "puntaje" => 0];
    array_push($coleccionPartidas,);


    ];

    return ($coleccionPartidas);
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
            function cargarColeccionPartidas($palabraWordix,$usuario, )   
        }

} while ($opcion != 8);


