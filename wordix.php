<?php

/***** DEFINICION DE CONSTANTES *******/

const CANT_INTENTOS = 6;

/*  disponible: letra que aún no fue utilizada para adivinar la palabra
    encontrada: letra descubierta en el lugar que corresponde
    pertenece: letra descubierta, pero corresponde a otro lugar
    descartada: letra descartada, no pertence a la palabra
*/
const ESTADO_LETRA_DISPONIBLE = "disponible";
const ESTADO_LETRA_ENCONTRADA = "encontrada";
const ESTADO_LETRA_DESCARTADA = "descartada";
const ESTADO_LETRA_PERTENECE = "pertenece";

/***** DEFINICION DE FUNCIONES ********/

/** Escrbir un texto en color ROJO
 * @param string $texto)
 */
function escribirRojo($texto) {
    echo "\e[1;37;41m $texto \e[0m";
}

/**
 * Escrbir un texto en color VERDE
 * @param string $texto)
 */
function escribirVerde($texto){
    echo "\e[1;37;42m $texto \e[0m";
}

/**
 * Escrbir un texto en color AMARILLO
 * @param string $texto)
 */
function escribirAmarillo($texto){
    echo "\e[1;37;43m $texto \e[0m";
}

/**
 * Escrbir un texto en color GRIS
 * @param string $texto)
 */
function escribirGris($texto){
    echo "\e[1;34;47m $texto \e[0m";
}

/**
 * Escrbir un texto pantalla.
 * @param string $texto)
 */
function escribirNormal($texto){
    echo "\e[0m $texto \e[0m";
}

/**
 * Escribe un texto en pantalla teniendo en cuenta el estado.
 * @param string $texto
 * @param string $estado
 */
function escribirSegunEstado($texto, $estado){
    switch ($estado) {
        case ESTADO_LETRA_DISPONIBLE:
            escribirNormal($texto);
            break;
        case ESTADO_LETRA_ENCONTRADA:
            escribirVerde($texto);
            break;
        case ESTADO_LETRA_PERTENECE:
            escribirAmarillo($texto);
            break;
        case ESTADO_LETRA_DESCARTADA:
            escribirRojo($texto);
            break;
        default:
            echo " $texto ";
            break;
    }
}

/** Funcion que segun el nombre de usuario iniciado, le da un mensaje de bienvenida al mencionado
 * @param var $usuario
 */
function escribirMensajeBienvenida($usuario){
    echo "***************************************************\n";
    echo "** Hola ";
    escribirAmarillo($usuario);
    echo " Juguemos una PARTIDA de WORDIX! **\n";
    echo "***************************************************\n";
}

/** Funcion que elige una palabra aleatoria de la colección de palabras, y chequea 
 * si la misma ya fue jugada previamente por la misma persona.
 * @param array $coleccionPalabras
 * @param array $coleccionPartidas
 * @param string $jugador
 * @return string|[] //Devuelve la palabra seleccionada, o un arreglo vacío en caso de que el jugador haya utilizado todas las palabras.
 */
function elegirPalabraAleatoria($coleccionPalabra, $coleccionPartidas, $jugador){
    $palabrasJugadas = [];
    $palabrasDisponibles = [];

    foreach ($coleccionPartidas as $partida){
        if ($partida["jugador"] === $jugador){
            $palabrasJugadas[] = $partida["palabraWordix"];
        }
    }
    foreach ($coleccionPalabra as $palabra){
        $esDisponible = true;
        foreach ($palabrasJugadas as $palabraJugada){
            if ($palabra === $palabraJugada){
                $esDisponible = false;
                break;
            }
        }
        if ($esDisponible){
            $palabrasDisponibles[] = $palabra;
        }
    }
    $palabraSeleccionada = -1;
    if (count($palabrasDisponibles) > 0){
        $indiceRandom = rand(0, count($palabrasDisponibles) - 1);
        $palabraSeleccionada = $palabrasDisponibles[$indiceRandom];
    }
    return $palabraSeleccionada;
}



/** Función que chequea, letra por letra, si las mismas corresponden a un valor alfabético. Devuelve valor booleano */
function esPalabra($cadena) {
    //int $cantCaracteres, $i, boolean $esLetra
    $cantCaracteres = strlen($cadena);
    $esLetra = true;
    $i = 0;
    while ($esLetra && $i < $cantCaracteres) {
        $esLetra =  ctype_alpha($cadena[$i]);
        $i++;
    }
    return $esLetra;
}

/** Inicia una estructura de datos Teclado. La estructura es de tipo: ¿Indexado, asociativo o Multidimensional?
 *@return array
 */
function iniciarTeclado() {
    //array $teclado (arreglo asociativo, cuyas claves son las letras del alfabeto)
    $teclado = [
        "A" => ESTADO_LETRA_DISPONIBLE, "B" => ESTADO_LETRA_DISPONIBLE, "C" => ESTADO_LETRA_DISPONIBLE, "D" => ESTADO_LETRA_DISPONIBLE, "E" => ESTADO_LETRA_DISPONIBLE,
        "F" => ESTADO_LETRA_DISPONIBLE, "G" => ESTADO_LETRA_DISPONIBLE, "H" => ESTADO_LETRA_DISPONIBLE, "I" => ESTADO_LETRA_DISPONIBLE, "J" => ESTADO_LETRA_DISPONIBLE,
        "K" => ESTADO_LETRA_DISPONIBLE, "L" => ESTADO_LETRA_DISPONIBLE, "M" => ESTADO_LETRA_DISPONIBLE, "N" => ESTADO_LETRA_DISPONIBLE, "Ñ" => ESTADO_LETRA_DISPONIBLE,
        "O" => ESTADO_LETRA_DISPONIBLE, "P" => ESTADO_LETRA_DISPONIBLE, "Q" => ESTADO_LETRA_DISPONIBLE, "R" => ESTADO_LETRA_DISPONIBLE, "S" => ESTADO_LETRA_DISPONIBLE,
        "T" => ESTADO_LETRA_DISPONIBLE, "U" => ESTADO_LETRA_DISPONIBLE, "V" => ESTADO_LETRA_DISPONIBLE, "W" => ESTADO_LETRA_DISPONIBLE, "X" => ESTADO_LETRA_DISPONIBLE,
        "Y" => ESTADO_LETRA_DISPONIBLE, "Z" => ESTADO_LETRA_DISPONIBLE
    ];
    return $teclado;
}

/** Escribe en pantalla el estado del teclado. Acomoda las letras en el orden del teclado QWERTY
 * @param array $teclado */
function escribirTeclado($teclado) {
    /**
     * @param array $ordenTeclado (arreglo indexado con el orden en que se debe escribir el teclado en pantalla)
     * @param string $letra, $estado 
     */
    $ordenTeclado = [
        "salto",
        "Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P", "salto",
        "A", "S", "D", "F", "G", "H", "J", "K", "L", "salto",
        "Z", "X", "C", "V", "B", "N", "M", "salto"
    ];
    foreach ($ordenTeclado as $letra) {
        switch ($letra) {
            case 'salto':
                echo "\n";
                break;
            default:
                $estado = $teclado[$letra];
                escribirSegunEstado($letra, $estado);
                break;
        }
    }
    echo "\n";
};


/** Escribe en pantalla los intentos de Wordix para adivinar la palabra
 * @param array $estruturaIntentosWordix
 */
function imprimirIntentosWordix($estructuraIntentosWordix) {
    $cantIntentosRealizados = count($estructuraIntentosWordix);
    $cantIntentosFaltantes = CANT_INTENTOS - $cantIntentosRealizados;

    for ($i = 0; $i < $cantIntentosRealizados; $i++) {
        $estructuraIntento = $estructuraIntentosWordix[$i];
        echo "\n" . ($i + 1) . ")  ";
        foreach ($estructuraIntento as $intentoLetra) {
            escribirSegunEstado($intentoLetra["letra"], $intentoLetra["estado"]);
        }
        echo "\n";
    }

    for ($i = $cantIntentosRealizados; $i < CANT_INTENTOS; $i++) {
        echo "\n" . ($i + 1) . ")  ";
        for ($j = 0; $j < 5; $j++) {
            escribirGris(" ");
        }
        echo "\n";
    }
    echo "\n" . "Le quedan " . $cantIntentosFaltantes . " Intentos para adivinar la palabra!";
}

/**
 * Dada la palabra wordix a adivinar, la estructura para almacenar la información del intento 
 * y la palabra que intenta adivinar la palabra wordix.
 * devuelve la estructura de intentos Wordix modificada con el intento.
 * @param string $palabraWordix
 * @param array $estruturaIntentosWordix
 * @param string $palabraIntento
 * @return array estructura wordix modificada
 */
function analizarPalabraIntento($palabraWordix, $estruturaIntentosWordix, $palabraIntento) {
    $cantCaracteres = strlen($palabraIntento);
    $estructuraPalabraIntento = []; // Almacena cada letra de la palabra intento
    
    // Recorre cada carácter de la palabra
    for ($i = 0; $i < $cantCaracteres; $i++) {
        $letraIntento = $palabraIntento[$i];
        $posicion = strpos($palabraWordix, $letraIntento);
        $estado = ESTADO_LETRA_DESCARTADA; 

        if ($posicion !== false) {
            if ($letraIntento == $palabraWordix[$i]) {
                $estado = ESTADO_LETRA_ENCONTRADA;
            } else {
                $estado = ESTADO_LETRA_PERTENECE;
            }
        }

        $estructuraPalabraIntento[count($estructuraPalabraIntento)] = [
            "letra" => $letraIntento,
            "estado" => $estado
        ];
    }
    $estruturaIntentosWordix[count($estruturaIntentosWordix)] = $estructuraPalabraIntento;
    return $estruturaIntentosWordix;
}

/**
 * Actualiza el estado de las letras del teclado. 
 * Teniendo en cuenta que una letra sólo puede pasar:
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_ENCONTRADA, 
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_DESCARTADA, 
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_PERTENECE
 * de ESTADO_LETRA_PERTENECE a ESTADO_LETRA_ENCONTRADA
 * @param array $teclado
 * @param array $estructuraPalabraIntento
 * @return array el teclado modificado con los cambios de estados.
 */
function actualizarTeclado($teclado, $estructuraPalabraIntento) {
    foreach ($estructuraPalabraIntento as $letraIntento) {
        $letra = $letraIntento["letra"];
        $estado = $letraIntento["estado"];
        switch ($teclado[$letra]) {
            case ESTADO_LETRA_DISPONIBLE:
                $teclado[$letra] = $estado;
                break;
            case ESTADO_LETRA_PERTENECE:
                if ($estado == ESTADO_LETRA_ENCONTRADA) {
                    $teclado[$letra] = $estado;
                }
                break;
        }
    }
    return $teclado;
}

/**
 * Determina si se ganó una palabra intento posee todas sus letras "Encontradas".
 * @param array $estructuraPalabraIntento
 * @return bool
 */
function esIntentoGanado($estructuraPalabraIntento) {
    $cantLetras = count($estructuraPalabraIntento);
    $i = 0;

    while ($i < $cantLetras && $estructuraPalabraIntento[$i]["estado"] == ESTADO_LETRA_ENCONTRADA) {
        $i++;
    }

    if ($i == $cantLetras) {
        $ganado = true;
    } else {
        $ganado = false;
    }

    return $ganado;
}

/**
 * Calcula el puntaje de una partida de Wordix.
 * @var int $puntajeBase, $puntajeLetras
 * @param int $nroIntento Número de intento en que se adivinó la palabra.
 * @param string $palabraAdivinada Palabra adivinada por el jugador.
 * @return int $puntajeTotal obtenido en la partida.
 */
function obtenerPuntajeWordix($nroIntento, $palabraAdivinada) {
    if ($nroIntento > 6 || $nroIntento < 1) {
        return 0;
    }

    $puntajeBase = 7 - $nroIntento; 
    $puntajeLetras = 0;

    // Calculamos el puntaje para cada letra de la palabra:
    for ($i = 0; $i < strlen($palabraAdivinada); $i++) {
        $letra = strtoupper($palabraAdivinada[$i]);

        if ($letra === 'A' || $letra === 'E' || $letra === 'I' || $letra === 'O' || $letra === 'U') {
            $puntajeLetras += 1; // Vocales suman un punto
        } elseif ($letra >= 'A' && $letra <= 'M') {
            $puntajeLetras += 2; // Consonantes de A a M valen 2 puntos
        } else {
            $puntajeLetras += 3; // Consonantes de N a Z valen 3 puntos
        }
    }
    $puntajeTotal = $puntajeBase + $puntajeLetras;
    return $puntajeTotal;
}

/**
 * Dada una palabra para adivinar, juega una partida de wordix intentando que el usuario adivine la palabra.
 * @param string $palabraWordix
 * @param string $nombreUsuario
 * @return array $partida - estructura con el resumen de la partida, para poder ser utilizada en estadísticas.
 */
function jugarWordix($palabraWordix, $nombreUsuario) {
    /*Inicialización*/
    $arregloDeIntentosWordix = [];
    $teclado = iniciarTeclado();
    $nroIntento = 0;
    do { 
        echo "Comenzar con el Intento " . ($nroIntento+1) . ":\n";
        $palabraIntento = leerPalabra5Letras();
        $indiceIntento = $nroIntento;
        $arregloDeIntentosWordix = analizarPalabraIntento($palabraWordix, $arregloDeIntentosWordix, $palabraIntento);
        $teclado = actualizarTeclado($teclado, $arregloDeIntentosWordix[$indiceIntento]);
        /*Mostrar los resultados del análisis: */
        imprimirIntentosWordix($arregloDeIntentosWordix);
        escribirTeclado($teclado);
        /*Determinar si la plabra intento ganó e incrementar la cantidad de intentos */
        $ganoElIntento = esIntentoGanado($arregloDeIntentosWordix[$indiceIntento]);
        $nroIntento++;
    } while ($nroIntento <= CANT_INTENTOS && !$ganoElIntento);

    if ($ganoElIntento) {
        $puntaje = obtenerPuntajeWordix($nroIntento, $palabraIntento);
        echo "¡Felicidades, ganaste! Lo lograste en el intento: " . $nroIntento . ". \nLa palabra ganadora fue: " . $palabraIntento . ".\n¡Obtuvo $puntaje puntos!\n";
    } else {
        $nroIntento = 0;
        $puntaje = 0;
        echo "Seguí Jugando Wordix, la próxima será! ";
    }

    $coleccionPartidas = [
        "palabraWordix" => $palabraWordix,
        "jugador" => $nombreUsuario,
        "intentos" => $nroIntento,
        "puntaje" => $puntaje
    ];
    return $coleccionPartidas;
}

/** Funcion que verifica que exista el nro de partida.
 * @param int $nroPartida
 * @param array $coleccionPartida    
 * @var int $i
 * @var boolean $existe*/
    
    function verificarSiExistePartida($nroPartida, $coleccionPartidas) {
    $i = 0;
    $existe = false;

    while ($i < count($coleccionPartidas) && $existe== false) {
    if ($i === $nroPartida){
        $existe=true;
    }
    $i++;  
    
    }
    return $existe; 
}
/** Función que verifica si un jugador existe dentro de la coleccion partidas, mediante recorrido parcial.
 * @var int $i
 * @var boolean $encontrado
 * @param string $jugador
 * @param array $coleccionPartidas
 */

function verificarSiExisteJugador($jugador, $coleccionPartidas) {
    $i = 0;
    $encontrado = false;
    while ($i < count($coleccionPartidas) && !$encontrado) {
        if ($jugador === $coleccionPartidas[$i]['jugador']) {
            $encontrado = true; 
        }
        $i++; 
    }
    return $encontrado;
}
/** Funcion que verifica si el usuario ya jugo anteriormente con la palabra que eligió, mediante recorrido parcial.
 * @var int $i
 * @var boolean $encontrado 
 * @param string $jugador, $palabra 
 * @param array $coleccionPalabra
 */ 

function verificarSiYaJugo($jugador, $palabra, $coleccionPartidas) {
        $i = 0;
        $encontrado = false;
    
        while ($i < count($coleccionPartidas) && $encontrado == false) {
            $partida = $coleccionPartidas[$i];
    
            if ($partida['jugador'] == $jugador && $partida['palabraWordix'] == $palabra) {
                $encontrado = true; 
                //es decir, si encuentra la palabra, retorna true.
            }
            $i++;  
        }
        
        return $encontrado;
    }
    

/** Función sin retorno para agregar arreglos al array contenedor de partidas $coleccionPartidas
 * @param array $coleccionPartidas, $partida
 * @var int $n
 */ 
function agregarPartida($coleccionPartidas, $partida) {
    $coleccionPartidas[] = $partida;
    return $coleccionPartidas; // ******Nos faltaba retornar el arreglo actualizado. Esto hacia que falle al cargar un nuevo jugador.*****
}


/** 1- Una función llamada cargarColeccionPalabras, que inicialice una estructura de datos con ejemplos de
 * Palabras de 5 letras en mayúsculas y que retorne la colección de palabras
 * Almacena y carga al programa el listado de palabras que se usaran para jugar 
 * Estructura tipo indexada
 * @return array $coleccionPalabras
 */
function cargarColeccionPalabras() {
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "BRUTO", "FRUTA", "TRUCO", "FRUTO", "PADEL"
    ];
    return ($coleccionPalabras);
}
 
/* 2- Una función llamada cargarPartidas, que inicialice una estructura de datos con ejemplos de Partidas y que
retorne la colección de partidas descripta en la sección EXPLICACION 2. Mínimo debe cargar 10 partidas
donde vayan variando los jugadores, las palabras, los intentos y los puntajes, en algunos casos los
jugadores se deben repertir*/

/** Almacena las partidas guardadas con sus respectivos datos/valores ingresados. 
 * Estructura tipo asociativa.
 * @return array $coleccionPartidas
 */
function cargarPartidas(){ 
    $coleccionPartidas=[];

    //Partidas pre cargadas
    $coleccionPartidas[0] = ["palabraWordix" => "MUJER", "jugador" => "luis", "intentos" => 0, "puntaje" => 0];
    $coleccionPartidas[1] = ["palabraWordix" => "QUESO", "jugador" => "ale", "intentos" => 1, "puntaje" => 19];
    $coleccionPartidas[2]= ["palabraWordix" => "FUEGO", "jugador" => "bimbo", "intentos" => 3, "puntaje" => 14];
    $coleccionPartidas[3] = ["palabraWordix" => "RASGO", "jugador" => "pedro", "intentos" => 4, "puntaje" => 13];
    $coleccionPartidas[4] = ["palabraWordix" => "CASAS", "jugador" => "karel", "intentos" => 0, "puntaje" => 0];
    $coleccionPartidas[5] = ["palabraWordix" => "GATOS", "jugador" => "karel", "intentos" => 5, "puntaje" => 12];
    $coleccionPartidas[6] = ["palabraWordix" => "GOTAS", "jugador" => "matias", "intentos" => 5, "puntaje" => 12];
    $coleccionPartidas[7] = ["palabraWordix" => "HUEVO", "jugador" => "kleiton", "intentos" => 0, "puntaje" => 0];
    $coleccionPartidas[8] = ["palabraWordix" => "FRUTO", "jugador" => "luz", "intentos" => 4, "puntaje" => 13];
    $coleccionPartidas[9] = ["palabraWordix" => "BRUTO", "jugador" => "cabrito", "intentos" => 0, "puntaje" => 0];
    $coleccionPartidas[10] = ["palabraWordix" => "FRUTA", "jugador" => "matias", "intentos" => 2, "puntaje" => 16];
    $coleccionPartidas[11] = ["palabraWordix" => "TINTO", "jugador" => "matias", "intentos" => 0, "puntaje" => 0];
    
    return ($coleccionPartidas);
}   
/* 3-  Para visualizar el menú de opciones (que siempre es el mismo), una función seleccionarOpcion que
muestre las opciones del menú en la pantalla (ver sección EXPLICACION 1), le solicite al usuario una
opción válida (si la opción no es válida vuelva a solicitarla en la misma función hasta que la opción sea
válida), y retorne el número de la opción. La última opción del menú debe ser “Salir”.
 */

/** Funcion que invoca el menu de opciones
 * @return int $opcion
 */

 function seleccionarOpcion(){
    echo "Seleccioná el número que desees: \n
    1) Jugá al wordix con una palabra a elegir por vos! \n
    2) Jugá al wordix con una palabra aleatoria! \n
    3) Visualizá datos de una partida anterior: \n
    4) Visualizá la primera victoria del jugador que quieras: \n
    5) Visualizá las estadísticas de un jugador: \n
    6) Visualizá listado de partidas ordenadas alfabéticamente por jugador y por palabra: \n
    7) Agregá tu palabra de 5 letras al juego Wordix: \n
    8) Salir. \n";
    echo "Por favor, ingrese un número del 1 al 8: ";
    $opcion = trim(fgets(STDIN));
    while (!is_numeric($opcion) || $opcion <= 1 && $opcion >= 8){
        echo "El número ingresado no es válido. Ingrese una opción **DEL 1 AL 8**: ";
        $opcion = trim(fgets(STDIN));
    }
    return $opcion;
}

/** 4. Una función que le pida al usuario ingresar una palabra de 5 letras, y retorne la palabra.
 * Esta función solicita al usuario una palabra, la convierte en mayúsculas y verifica que sea del valor y longitud solicitados (Alfabéticos y 5 caracteres, respectivamente).
 *@var return string $palabra
 */
function leerPalabra5Letras() {
    //string $palabra
    echo "Ingrese una palabra de 5 letras: ";
    $palabra = strtoupper(trim(fgets(STDIN)));
    do {
        if ((strlen($palabra)!=5) || !esPalabra(($palabra))){
        echo "Debe ingresar una palabra de CINCO letras: ";
        $palabra = strtoupper(trim(fgets(STDIN)));
        }
    }
    while ((strlen($palabra) != 5) || !esPalabra($palabra));
    return $palabra;
}


/** 5- Una función que solicite al usuario un número entre un rango de valores. Si el número ingresado por el
 * usuario no es válido, la función se encarga de volver a pedirlo. La función retorna un número válido.
 * 
 * Esta función recibe por parámetro un numero mínimo y un número máximo. Luego, solicita la usuario un número dentro de ese rango.
 * En caso de que el mismo no sea entero, o no se encuentre dentro del rango, le volverá a solicitar números hasta que el ingresado sea válido.
 */
function solicitarNumeroEntre($min, $max) {
    //int $numero
    echo "Ingrese un numero de palabra que no haya usado antes, entre ".$min." y ".$max.": ";
    (int)$numero=trim(fgets(STDIN));
    while (!(is_numeric($numero) && (($numero == (int)$numero) && ($numero >= $min && $numero <= $max)))) {
        echo "Número invalido. Debe ingresar un número ENTERO entre " . $min . " y " . $max . ": ";
        $numero = trim(fgets(STDIN));
    }
    return (int)$numero;
}

/** 6. Una función que dado un número de partida, muestre en pantalla los datos de la partida como lo indica la
 * sección EXPLICACIÓN 1.
 *
 * Muestra los detalles de una partida específica.
 * @param int $nro
 * @param array $coleccionPartidas
 */

 function mostrarPartida($nro, $coleccionPartidas) {
     if ($nro >= 0 && $nro < count($coleccionPartidas)) {
         $partida = $coleccionPartidas[$nro];
 
         echo "\n******************************************************";
         echo "\nPartida WORDIX " . ($nro) . ": palabra {$partida['palabraWordix']}\n";
         echo "Jugador: {$partida['jugador']}\n";
         echo "Puntaje: {$partida['puntaje']} puntos\n";
 
         $intentos = $partida['intentos'];
  
         if ($intentos != 0) {
             echo "Intento: Adivinó la palabra en $intentos intento(s).\n";
         } else {
             echo "Intento: No adivinó la palabra.\n";
         }
         echo "******************************************************\n";
     } else {
         echo "El número de partida es inválido.\n";
     }
 }

/** 7. Una función agregarPalabra cuya entrada sea la colección de palabras y una palabra, y la función retorna
 * la colección modificada al agregarse la nueva palabra.
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

/*
8. Una función que dada una colección de pardas y el nombre de un jugador, retorne el índice de la primer
parda ganada por dicho jugador. Si el jugador ganó ninguna parda, la función debe retornar el valor -1.
(debe ulizar las instrucciones vistas en la materia, no utiizar funciones predenidas de php).*/
function primerPartidaGanada($coleccionPartidas, $nombreJugador) {
    $partidaGanada = false; 
    $i = 0;
    $n = count($coleccionPartidas); 

    while ($i < $n && !$partidaGanada) { // Recorre mientras haya partidas y no se haya encontrado una ganada
        if ($coleccionPartidas[$i]['jugador'] === $nombreJugador && $coleccionPartidas[$i]['puntaje'] > 0) {
            $partidaGanada = true;
        } else {
            $i++; 
        }
    }

    if ($partidaGanada) {
        $resultado=$i;
    } else {
         $resultado=-1; // Retornar -1 si no se encontró ninguna partida ganada
    }
    return $resultado;
}

/** Una función que dada una colección de partidas y el nombre de un jugador, retorne el índice de la primer
 * partida ganada por dicho jugador, utilizando la estructura c) de la sección EXPLICACIÓN 2.
 * Estructura asociativa, almacena el resumen de un jugador que tendrá los siguientes datos: 
 * jugador, partidas, puntaje, victorias, intento1, intento2, intento3, intento4, intento5, intento6.
 * @param array $coleccionPartidas
 * @param string $nombreJugador
*/

function resumenJugador($coleccionPartidas, $nombreJugador){
        $totalPartidas = 0;
        $totalPuntaje = 0;
        $totalVictorias = 0;
        $intentosAdivinados = [];//Arreglo para contar los intentos
    
        for ($i = 0; $i <= 6; $i++) {
            $intentosAdivinados[$i] = 0;
        }
        foreach ($coleccionPartidas as $partida) {
            if ($partida['jugador'] === $nombreJugador) {
                $totalPartidas++;
                $totalPuntaje += $partida['puntaje'];
                if ($partida['puntaje'] > 0) {
                    $totalVictorias++;
                }
                if ($partida['intentos'] > 0 && $partida['intentos'] <= 6) {
                    $intentosAdivinados[$partida['intentos']]++;
                }
            }
        }
        $resumenJugador['jugador'] = $nombreJugador;
        $resumenJugador['partidas'] = $totalPartidas;
        $resumenJugador['puntaje'] = $totalPuntaje;
        $resumenJugador['victorias'] = $totalVictorias;
        $resumenJugador['intento1'] = $intentosAdivinados[1];
        $resumenJugador['intento2'] = $intentosAdivinados[2];
        $resumenJugador['intento3'] = $intentosAdivinados[3];
        $resumenJugador['intento4'] = $intentosAdivinados[4];
        $resumenJugador['intento5'] = $intentosAdivinados[5];
        $resumenJugador['intento6'] = $intentosAdivinados[6];
    
        return $resumenJugador;
    }

    /**
     * Función que imprime el resumen de un jugador
     * @param array $resumenJugador 
     */
    function imprimirResumenJugador($resumenJugador){
        if ($resumenJugador["partidas"]>0){
            $porcentajeVictorias = ($resumenJugador['victorias']) / ($resumenJugador['partidas'])*100;
            echo "\n**************************************************************\n";
            echo "Jugador: " . $resumenJugador['jugador'] . "\n";
            echo "Partidas: " . $resumenJugador['partidas'] . "\n";
            echo "Puntaje Total: " . $resumenJugador['puntaje'] . "\n";
            echo "Victorias: " . $resumenJugador['victorias'] . "\n";
            echo "Porcentaje Victorias: " . round($porcentajeVictorias, 2) . " %\n";
            echo "Partidas adivinadas: \n";
        
            for ($i = 0; $i <= 5; $i++){
                echo "Intento: ".($i+1).": ".$resumenJugador["intento".($i+1)]."\n";
            }
            echo "**************************************************************\n";
        } 
        else{
            echo"El jugador ".$resumenJugador['jugador'].", no registra partidas guardadas. ";
        }  
}

/**10. Una función solicitarJugador sin parámetros formales que solicite al usuario el nombre de un jugador y
retorne el nombre en minúsculas. La función debe asegurar que el nombre del jugador comience con una
letra. (Ulice funciones predenidas de string). */
function solicitarJugador(){
    echo "Ingrese el nombre del jugador (Si o si debe comenzar con una letra): ";
    $nombre=trim(fgets(STDIN));

    while (!(ctype_alpha($nombre[0]) && strlen($nombre)>0)){
        echo "Ingrese un nombre válido. Debe comenzar SI O SI con una letra: ";
        $nombre = trim(fgets(STDIN));
    }
    return strtolower($nombre);
}



// Función de comparación para ordenar las partidas. Usa return debido al UASORT.
function compararPartidas($a, $b) {
    $verif = 0;
    // Comparar por el nombre del jugador
    if ($a['jugador'] == $b['jugador']) {
        // Si el jugador es el mismo, comparamos por la palabra ingresada
        if ($a['palabraWordix'] == $b['palabraWordix']) {
            $verif = 0;
        } else {
            $verif = ($a['palabraWordix'] < $b['palabraWordix']) ? -1 : 1;
        }
    } else {
        // Si los jugadores son diferentes, ordenar por el nombre del jugador
        $verif = ($a['jugador'] < $b['jugador']) ? -1 : 1;
    }
    return $verif;
}

/** 
 * 11- Una función sin retorno que, dada una colección de partidas, muestre la colección de partidas ordenada
* por el nombre del jugador y por la palabra. Utilice la función predeterminada uasort de php y print_r.
* Función que ordena las partidas, SIN retorno, usando uasort y print_r.*/

function ordenarPartidas($coleccionPartidas) {
    // Usamos uasort y pasamos como parametro la coleccion de partidas. Luego, llamamos a la función de comparación.
    uasort($coleccionPartidas, 'compararPartidas');
    
    // Mostramos la colección de partidas ordenada
    print_r($coleccionPartidas);
}
?>