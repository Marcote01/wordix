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
cargarColeccionPalabras();

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
        }  while (verificarSiExiste($coleccionPalabras) == false
         || ((verificarSiYaJugo($nombreUsuarioJugando, $palabraWordix, $coleccionPartidas)) ==false));
           
         
         $partida= jugarWordix($palabraWordix, $nombreUsuarioJugando);
            agregarPartida($coleccionPartidas, $partida);
        
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
        agregarPartida($coleccion, $palabra, $jugador, $intentos, $puntaje);}
  

} while ($opcion != 8);
