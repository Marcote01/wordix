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
            do{
            echo"Por favor, ingrese un numero de partida, entre 0 y ".(count($coleccionPartidas)-1).".";
            $nroPartida= trim(fgets(STDIN));}
            while(verificarSiExistePartida($nroPartida,$coleccionPartidas)==false);
            mostrarPartida($nroPartida, $coleccionPartidas);
            break;

        case 4: 
            /*Se le solicita al usuario un nombre de jugador y se muestra 
            pantalla el primer juego ganado por dicho jugador */
            echo "Ingrese el nombre de usuario del cual desea ver la primer partida ganada: \n";
            $nombreJugador= trim(fgets(STDIN));
            $resultado= primerPartidaGanada($coleccionPartidas,$nombreJugador);
            if($resultado==$i){
                mostrarPartida($resultado,$coleccionPartidas);
                
            }else{
                echo"el usuario no ha ganado ninguna partida :c ";;
            };
            break;

        case 5: 
            /* Se le solicita al usuario que ingrese un nombre de jugador y se muestre
            las estadisticas:*/
            do{ echo "Ingrese el nombre de usuario del cual desea ver las estadisticas, asegurese que dicho jugador haya jugado anteriormente: \n";
            $nombreJugador= trim(fgets(STDIN))}
            while(verificarSiExisteJugador($nombreJugador, $coleccionPartidas)==false);
            $estadisticas=resumenJugador($coleccionPartidas, $nombreJugador);
            print_r($estadisticas);

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
        agregarPartida($coleccion, $palabra, $jugador, $intentos, $puntaje);}
  

} while ($opcion != 8);
