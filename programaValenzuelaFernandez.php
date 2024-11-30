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
 ***
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

//Declaración de variables:
//@var string:
//$usuario
//@var int: 
//$opcion


//Inicialización de variables:


//Proceso:
 echo"Ingrese su nombre: ";
  $usuario=trim(fgets(STDIN));
  escribirMensajeBienvenida($usuario);

do {
    $opcion= seleccionarOpcion(); //Modificado en wordix. Chequea que sea del 1 al 8.
    switch ($opcion) {
        case 1: 
            /*se inicia la partida de wordix solicitando el nombre del
            jugador y un número de palabra para jugar.*/
            do{
            echo "Ingrese un número de palabra que no haya usado antes, y a continuación, el nombre de usuario: \n";
            $palabraWordix = trim(fgets(STDIN));
            $nombreUsuarioJugando = trim(fgets(STDIN));
        }  while (verificarSiExistePalabra($palabraWordix, $coleccionPalabras) == false
         || ((verificarSiYaJugo($nombreUsuarioJugando, $palabraWordix, $coleccionPartidas)) ==false));
           
         //almacena los resultados de la partida en la variable $partida
         $partida= jugarWordix($palabraWordix, $nombreUsuarioJugando);

         //almacena la partida, dentro de la coleccion de partidas
            agregarPartida($coleccionPartidas, $partida);
        
            break;
        case 2: 
            
            echo "Ingrese su nombre de usuario: \n";
            $nombreUsuarioJugando = trim(fgets(STDIN));
            do{
            $indiceAleatorio = rand(0, count($coleccionPalabras) - 1);
            $palabraWordix = $coleccionPalabras[$indiceAleatorio];
            }
            while(verificarSiYaJugo($nombreUsuarioJugando,$indiceAleatorio,$coleccionPartidas)==false);

            $partida=jugarWordix($indiceAleatorio, $nombreUsuarioJugando);
            agregarPartida($coleccionPartidas, $partida);
            
            break;
        case 3: 
            /*Se le solicita al usuario un número de partida y se muestra en pantalla co
            siguiente formato:
            Partida WORDIX <numero>: palabra <palabr
            Jugador: <nombre>
            Puntaje: <puntaje> puntos
            Intento: No adivinó la palabra | Adivinó la palabra en <X> intentos
            */
            

            //@var int $nroPartida
            do {
                echo "Por favor, ingrese un número de partida existente, entre 0 y " . (count($coleccionPartidas) - 1) . ": ";
                $nroPartida = trim(fgets(STDIN));
            
                if (is_numeric($nroPartida)) {
                    $nroPartida = (int)$nroPartida;
                } else {
                    $nroPartida = null;
                }
            
            } while (
                $nroPartida === null || 
                $nroPartida < 0 || 
                $nroPartida > count($coleccionPartidas) - 1 || 
                !verificarSiExistePartida($nroPartida, $coleccionPartidas) 
            );

        case 4:
                echo "Ingrese el nombre de usuario del cual desea ver la primera partida ganada: \n";
                $nombreJugador = trim(fgets(STDIN));
                $resultado = primerPartidaGanada($coleccionPartidas, $nombreJugador);

                // Verifica si se encontró una partida ganada
                if ($resultado !== null) {
                    // Muestra la partida ganada, si se encontro alguna partida ganada
                    mostrarPartida($resultado, $coleccionPartidas);
                } else {
                    // Muestra este mensaje si no tiene partidas ganadas
                    echo "El usuario no ha ganado aún ninguna partida :c\n";
                }
                break;

        case 5: 
            /* Se le solicita al usuario que ingrese un nombre de jugador y se muestre
            las estadisticas:*/
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
            /* Se mostrará en pantalla la estructu
ordenada alfabéticamente por jugador y por palabra , utilizando la función predefinida uasort d
y la función predefinida print_r. (En el código fuente documentar qué hace cada una de est
funciones predefinidas de php, utilizar el manual php.net). (Este es el único menú de opciones
debe utilizar la función print_r parar mostrar la estructura de dato
 */

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
        agregarPartida($coleccion, $palabra, $jugador, $intentos, $puntaje);}
  

} while ($opcion != 8);
