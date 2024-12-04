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

//Proceso:
do {
    $opcion= seleccionarOpcion(); //Chequea que sea del 1 al 8.
    switch ($opcion) {
        case 1: 
            /*se inicia la partida de wordix solicitando el nombre del
            jugador y un número de palabra para jugar.*/
            $jugador=solicitarJugador();
            escribirMensajeBienvenida(($jugador));
            do {
                $numero = solicitarNumeroEntre(1, count($coleccionPalabras));
                $palabraWordix = $coleccionPalabras[$numero - 1];
                
            if (verificarSiYaJugo($jugador, $palabraWordix, $coleccionPartidas)){
                echo "La palabra ya fue utilizada por el jugador. Vuelva a ingresar. ";
                }
            }
            while (verificarSiYaJugo($jugador, $palabraWordix, $coleccionPartidas));
            
            //almacena los resultados de la partida en la variable $partida
            $partida= jugarWordix($palabraWordix, $jugador);

            //almacena la partida, dentro de la coleccion de partidas
            $coleccionPartidas=agregarPartida($coleccionPartidas, $partida);
            break;
        case 2: 
            /**
             * Solicita el nombre de jugador, y permite jugar con una palabra aleatoria
             * de las disponibles. Verifica que la misma no haya sido jugada previamente.}
             * @var string
             */
            $jugador=solicitarJugador();
            escribirMensajeBienvenida(($jugador));   

            $palabraAleatoria=elegirPalabraAleatoria($coleccionPalabras, $coleccionPartidas, $jugador);
            
            if (!$palabraAleatoria){
                echo"No quedan palabras disponibles para jugar. Vuelva a intentar mas tarde.";
            }
            
            $partida=jugarWordix($palabraAleatoria, $jugador);
            $coleccionPartidas=agregarPartida($coleccionPartidas, $partida);
            break;
        case 3: 
            /**
             * Se le solicita al usuario un número de partida y se muestra en pantalla
             * @var int $nroPartida 
             */
                echo "Por favor, ingrese un número de partida existente, entre 1 y " . (count($coleccionPartidas) - 1) . ": ";
                $nroPartida = trim(fgets(STDIN));            
                mostrarPartida($nroPartida, $coleccionPartidas); 
                do {
                    echo"Desea visualizar otra partida? SI/NO ";
                    $visualizar=strtoupper(trim(fgets(STDIN)));
                    if ($visualizar == "SI"){
                        echo "Por favor, ingrese otro número de partida existente, entre 1 y " . (count($coleccionPartidas) - 1) . ": ";
                        $nroPartida = trim(fgets(STDIN));    
                        mostrarPartida($nroPartida, $coleccionPartidas);
                    }
                    else if ($visualizar != "NO" && $visualizar !="SI"){
                        echo "Respuesta invalida. Debe ingresar SI o NO. ";
                    }
                }
                while ($visualizar != "NO");   
                break;
        case 4:
            /**
             * Solicita un nombre de jugador. Muestra la primera partida ganadora del mismo.
             */
                echo "Ingrese el nombre de usuario del cual desea ver la primera partida ganada: \n";
                $nombreJugador = trim(fgets(STDIN));
                $resultado = primerPartidaGanada($coleccionPartidas, $nombreJugador);

                // Verifica si se encontró una partida ganada
                if ($resultado != -1) {
                    // Muestra la partida ganada, si es que se encontro alguna
                    mostrarPartida($resultado, $coleccionPartidas);
                } else {
                    // Muestra este mensaje si no tiene partidas ganadas
                    echo "El usuario no ha ganado aún ninguna partida :c \n";
                }
                do {
                    echo"Desea visualizar otro usuario? SI/NO ";
                    $visualizar=strtoupper(trim(fgets(STDIN)));
                    if ($visualizar == "SI"){
                        echo "Ingrese el nombre de usuario del cual desea ver la primera partida ganada: \n";
                        $nombreJugador = trim(fgets(STDIN));
                        $resultado = primerPartidaGanada($coleccionPartidas, $nombreJugador);
                        if ($resultado != -1) {
                            // Muestra la partida ganada, si es que se encontro alguna
                            mostrarPartida($resultado, $coleccionPartidas);
                        } else {
                            // Muestra este mensaje si no tiene partidas ganadas
                            echo "El usuario no ha ganado aún ninguna partida :c \n";
                        }
                    }
                    else if ($visualizar != "NO" && $visualizar !="SI"){
                        echo "Respuesta invalida. Debe ingresar SI o NO. ";
                    }
                }
                while ($visualizar != "NO");
                break;

        case 5: 
            /**
             *  Se le solicita al usuario que ingrese un nombre de jugador y se muestran las estadisticas:
             *  @var string $nombreJugador
             */
            echo "Ingrese el nombre de usuario del cual desea ver las estadisticas, asegurese que dicho jugador haya jugado anteriormente: \n";
            $jugador= trim(fgets(STDIN));
            //while(verificarSiExisteJugador($nombreJugador, $coleccionPartidas)==false);
            $estadisticas=resumenJugador($coleccionPartidas, $jugador);
            imprimirResumenJugador($estadisticas);
            do {
                echo"Desea visualizar otro usuario? SI/NO ";
                $visualizar=strtoupper(trim(fgets(STDIN)));
                if ($visualizar == "SI"){
                    echo "Ingrese el nombre de usuario del cual desea ver las estadisticas, asegurese que dicho jugador haya jugado anteriormente: \n";
                    $jugador= trim(fgets(STDIN));
                    $estadisticas=resumenJugador($coleccionPartidas, $jugador);
                    imprimirResumenJugador($estadisticas);
                }
                else if ($visualizar != "NO" && $visualizar !="SI"){
                    echo "Respuesta invalida. Debe ingresar SI o NO. ";
                }
            }
            while ($visualizar != "NO");
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
            echo"Gracias por jugar en WORDIX! Te esperamos pronto :)";
            break;
    } 

} while ($opcion != 8);
