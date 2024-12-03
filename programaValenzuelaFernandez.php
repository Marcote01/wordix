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
 * Almacena y carga al programa el listado de palabras que se usaran para jugar 
 * Estructura tipo indexada
 * @return array $coleccionPalabras
 */
$coleccionPalabras= cargarColeccionPalabras();

/**
 * Almacena las partidas guardadas con sus respectivos datos/valores ingresados. 
 * Desde $part1 hasta $part12 se encuentran datos de partidas pre cargadas.
 * Estructura tipo asociativa.
 * @return array
 */
$coleccionPartidas= cargarPartidas();

/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

/**
 * Declaración de variables: 
 * @var string $usuario
 * @var int $opcion
 */


//Inicialización de variables:

//Proceso:
 echo"Ingrese su nombre: ";
  $usuario=trim(fgets(STDIN));
  escribirMensajeBienvenida($usuario);

do {
    $opcion= seleccionarOpcion(); //Chequea que sea del 1 al 8.
    switch ($opcion) {
        case 1: 
            /*se inicia la partida de wordix solicitando el nombre del
            jugador y un número de palabra para jugar.*/
            do {
                echo "Ingrese un número de palabra que no haya usado antes, y a continuación, el nombre de usuario: \n";
                $palabraWordix = trim(fgets(STDIN));
                $nombreUsuarioJugando = trim(fgets(STDIN));
            }   
            while (verificarSiExistePalabra($palabraWordix, $coleccionPalabras) == false || ((verificarSiYaJugo($nombreUsuarioJugando, $palabraWordix, $coleccionPartidas)) ==false));
           
            //almacena los resultados de la partida en la variable $partida
            $partida= jugarWordix($palabraWordix, $nombreUsuarioJugando);

            //almacena la partida, dentro de la coleccion de partidas
            agregarPartida($coleccionPartidas, $partida);
        
            break;
        case 2: 
            /**
             * Solicita el nombre de jugador, y permite jugar con una palabra aleatoria
             * de las disponibles. Verifica que la misma no haya sido jugada previamente.}
             * @var string
             */
            echo "Ingrese su nombre de usuario: \n";
            $nombreUsuarioJugando = trim(fgets(STDIN));
            do{
                $indiceAleatorio = rand(0, count($coleccionPalabras) - 1);
                $palabraWordix = $coleccionPalabras[$indiceAleatorio];
            }
            while (verificarSiYaJugo($nombreUsuarioJugando,$indiceAleatorio,$coleccionPartidas)/* ==false */);
            $partida=jugarWordix($indiceAleatorio, $nombreUsuarioJugando);
            agregarPartida($coleccionPartidas, $partida);
            break;
        case 3: 
            /**
             * Se le solicita al usuario un número de partida y se muestra en pantalla
             * @var int $nroPartida 
             */
            do {
                echo "Por favor, ingrese un número de partida existente, entre 0 y " . (count($coleccionPartidas) - 1) . ": ";
                $nroPartida = trim(fgets(STDIN));
            
                if (is_numeric($nroPartida)) {
                    $nroPartida = (int)$nroPartida;
                } else {
                    $nroPartida = null;
                }
            
            } while ( $nroPartida === null || 
                $nroPartida < 0 || 
                $nroPartida > count($coleccionPartidas) - 1 || 
                !verificarSiExistePartida($nroPartida, $coleccionPartidas) 
            );

        case 4:
            /**
             * Solicita un nombre de jugador. Muestra la primera partida ganadora del mismo.
             */
                echo "Ingrese el nombre de usuario del cual desea ver la primera partida ganada: \n";
                $nombreJugador = trim(fgets(STDIN));
                $resultado = primerPartidaGanada($coleccionPartidas, $nombreJugador);

                // Verifica si se encontró una partida ganada
                if ($resultado !== null) {
                    // Muestra la partida ganada, si es que se encontro alguna
                    mostrarPartida($resultado, $coleccionPartidas);
                } else {
                    // Muestra este mensaje si no tiene partidas ganadas
                    echo "El usuario no ha ganado aún ninguna partida :c\n";
                }
                break;

        case 5: 
            /**
             *  Se le solicita al usuario que ingrese un nombre de jugador y se muestran las estadisticas:
             *  @var string $nombreJugador
             */
            do{ echo "Ingrese el nombre de usuario del cual desea ver las estadisticas, asegurese que dicho jugador haya jugado anteriormente: \n";
            $nombreJugador= trim(fgets(STDIN));
            } while(verificarSiExisteJugador($nombreJugador, $coleccionPartidas)==false);
            $estadisticas=resumenJugador($coleccionPartidas, $nombreJugador);
            echo "********************************************************\n" .
            "Jugador: " . $resumenJugador['jugador'] . "\n" .
            "Partidas: " . $resumenJugador['partidas'] . "\n" .
            "Puntaje Total: " . $resumenJugador['puntaje'] . "\n" .
            "Victorias: " . $resumenJugador['victorias'] . "\n" .
            "Intento 1: " . $resumenJugador['intento1'] . "\n" .
            "Intento 2: " . $resumenJugador['intento2'] . "\n" .
            "Intento 3: " . $resumenJugador['intento3'] . "\n" .
            "Intento 4: " . $resumenJugador['intento4'] . "\n" .
            "Intento 5: " . $resumenJugador['intento5'] . "\n" .
            "Intento 6: " . $resumenJugador['intento6'] . "\n" .
            "********************************************************\n";
            break;
        case 6: 
            /**
             * Se mostrará en pantalla la estructura ordenada alfabéticamente por jugador y por palabra
             * Llama a la función para ordenar y mostrar las partidas.
             */
            ordenarPartidas($coleccionPartidas);
            break;
        case 7: 
            //Solicita palabra de 5 letras al usuario. La agrega en MAYUS a la colección de palabras
            $palabraParaAgregar=leerPalabra5Letras();
            agregarPalabra($coleccionPalabras, $palabraParaAgregar);
            break;
        case 8: 
            //Echo que recorre una sola vez, y despide al jugador del programa.
            echo"Gracias por jugar en wordix!! lo esperamos pronto!";
            break;
    } 

} while ($opcion != 8);
