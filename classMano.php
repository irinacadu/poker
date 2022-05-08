<?php

//require_once './classCarta.php';
class Mano extends Carta {

    private $cartas = array();

    public function __construct() {
        $this->cartas = array();
        $this->baraja = $this->baraja;
        $this->nuevaMano = array();
    }

    public function inicia() {
//Los comodines me han dado problemas desde el principio por lo que para ver la funcionalidad de las jugadas del método que veremos posteriormente los he comentado aunque el programa está preparado para meterlos;
        $a_mano = array();
        $h = "contiene el valor";
        $c = new Carta();
        $f = $c->baraja;
        //$comodin1 = $f[53];
        //$comodin2 = $f[52];

        do {
            $n = $c->getNumero(); //despues de haber creado un nuevo objeto carta, llamamos al método de la clase Carta para generar un nuevo número aleatorio.
            array_push($a_mano, $n); //Creamos un array auxiliar para ir metiendo los valores que nos va generando el método anterior.
            foreach ($a_mano as $l => $val) {//recorremos el array
                if (in_array($val, $this->cartas)) { //y si en nuestro array original encontramos ese número           
                    $n = $c->getNumero(); //generamos otro nuevo
                } else {

                    array_push($this->cartas, $val); //si no, lo incluimos
                }
            }
        } while (sizeof($this->cartas) < 5); //mientras la longitud de nuestras cartas (o mano) sea menor que cinco

        return $this->cartas; //devolvemos la juaga inicial.
    }

    public function cambia($num) {
        $c = new Carta();
        $aux = array();//creamos un array auxiliar
        $n = $c->getNumero();//generamos de nuevo un numero
        array_push($aux, $n);//y lo introducimos en este nuevo array
       
            do {//hacemos esto mientras el array auxiliar sea menor que 5. El funcionamiento es el mismo que se ha utilizado para el método de iniciar la mano.
            $n = $c->getNumero();
            array_push($aux, $n);

            foreach ($aux as $l => $val) {
                if (in_array($val, $aux)) {
                    $n = $c->getNumero();
                } else {

                    array_push($aux, $val);
                }
            }
        } while (sizeof($aux) < 5);

        
        //A continuación es donde vamos a cambiar la carta que seleccionamos. Esto lo haremos recorriendo los dos arrays.
        foreach ($this->cartas as $e => $g) { //Primero, recorremos el de la primera jugada capturando el indice y el valor que contiene ese indice          
            if ($num == $e) {//Si el numero introducido coincide con el indice de la mano original
                foreach ($aux as $u => $v) {//recorremos el array auxiliar.
                    if ($e == $u) { //si el indice del array auxiliar coincide con el indice con la mano origina                  
                        $this->cartas = str_replace($g, $v, $this->cartas);//cambiamos el valor de ese indice por el otro.
                    }
                }
            }
        }


        return $this->cartas;
    }

    public function valor() {

        $manoFinal = $this->getCartas();//capturamos la mano final, tanto si hemos cambiado la carta como si no.      
        $b = new Carta();//creamos objeto carta 
        $baraja = $b->getBaraja();//y capturamos la baraja que hemos creado en la clase Carta
       //Creamos una variable para cada jugada final;
        $rf = "1. ROYAL FLUSH - FLOR IMPERIAL";
        $sf = "2. STRAIGHT FLUSH - ESCALERA DE COLOR";
        $pk = "3. POKER";
        $full = "4. FULL";
        $flush = "5. COLOR";
        $escalera = "6. ESCALERA";
        $trio = "7. TRIO";
        $doblePareja = "8. DOBLE PAREJA";
        $pareja = "9. PAREJA";
        $cartaAlta = "10. CARTA MAS ALTA";

       //---> $cad1 = ['2T', '2R', '2C', '2C', '1R'];//Esta cadena es la que he ido utilizando para probar los algoritmos por consola.
       
        //Preparación para el condicional de la escalera de color:     
         $arrayIndex = array();//creamos un array donde almacenaremos los índices.
         foreach ($manoFinal as $el => $v) {//recorremos la mano final
            foreach ($baraja as $bel => $val) {//y recorremos la baraja
                if ($v == $val) {//si el valor de la baraja es igual que el de la mano final
                    $num = $bel;//la variable creada almacenará el indice;
                    array_push($arrayIndex, $num); //Straight flush
                    //   $this->write_to_console($num); 
                }
            }
        }
        /*--> COMPROBAR POR CONSOLA
          $arrayIndex = array();//creamos un array donde almacenaremos los índices.
          foreach ($cad1 as $el => $v) {//recorremos la mano final
          foreach ($baraja as $bel => $val) {//y recorremos la baraja
          if ($v == $val) {//si el valor de la baraja es igual que el de la mano final
          $num = $bel;//la variable creada almacenará el indice;
          array_push($arrayIndex, $num); //Straight flush
          //   $this->write_to_console($num);
          }
          }
          }
         * 
         */



        //Preparación para el condicional de la jugada:POKER
        $regex = '/[CTRP]/';//Creamos expresion regular para que nos detecte los palos
        $repl = preg_replace($regex, "", $manoFinal);//y los sustituimos por "nada" de manera que solo nos queden los valores:
        
        /*-->COMPROBAR POR CONSOLA
        $regex = '/[CTRP]/';
        $repl = preg_replace($regex, "", $cad1);
         */


        //Preparación para el condicional de la jugada: FULL
        $p = 0;
        $p = array_count_values($repl);//esto ha sido para mi la clave de muchas jugadas. Trabajando con este método de php se genera un array con unas dimensiones concretas
        //dependiendo de cuantos valores repetidos o no hay en la mano. Es decir, si la mano tiene una longitud de 5 cartas y me salen, por ejemplo, 2-2-3-4-3,
        //se va a generar un array de 3 puesto que hay 3 numeros diferentes. Por lo tanto, dependiendo de la longitus que tenga el array, podemos saber si 
        //tenemos un full= si p contiene 2 y p contiene 3.
        //Si tenemos un poker: longitusdde p es 2 (2 valores distintos) y asi con varias jugadas que verás a continuación.
        //con este método he jugado tanto con la longitus como comprobando si el array contiene X numero;
        
      

        //Preparación para el condicional de la jugada: COLOR       
        $regex2 = '/[\dJQK]/';//preparamos una expresion regular donde seleccionamos los números y las figuras de manera que solo nos quedemos con los palos.
        $rep2 = preg_replace($regex2, "", $manoFinal);
        $unicos = array_count_values($rep2);//hacemos los mismo, contamos cuantas veces se repite el palo.
        $longUnicos = sizeof($unicos);//y contamos su longitud. Si es 5, sabemos que todas las cartas son del mismo palo/color.
        
        /*-->COMPROBAR POR CONSOLA
         $regex2 = '/[\dJQK]/';//preparamos una expresion regular donde seleccionamos los números y las figuras de manera que solo nos quedemos con los palos.
        $rep2 = preg_replace($regex2, "", $cad1);
        $unicos = array_count_values($rep2);//hacemos los mismo, contamos cuantas veces se repite el palo.
        $longUnicos = sizeof($unicos);//y contamos su longitud. Si es 5, sabemos que todas las cartas son del mismo palo/color.
        
         */

        //Preparación para el condicional de la jugada : ESCALERA
        $regex3 = '/[JQK]/';//la ultima expresión regular que creamos es para seleccionar las figuras de manera que podamos darle un valor numérico.
        $arrayEscalera = array();
        $int = 0;
        for ($i = 0; $i < sizeof($repl); $i++) {
            if (preg_match($regex3, $repl[$i])) {//condicionamos con la comprobación de la expresión regular.
                if ($repl[$i] == 'J') {//y sustituimos las figuras por valores numéricos.
                    $int = str_replace($repl[$i], 11, 'J');
                    array_push($arrayEscalera, $int);
                } else if ($repl[$i] == 'Q') {
                    $int = str_replace($repl[$i], 12, 'Q');
                    array_push($arrayEscalera, $int);
                } else if ($repl[$i] == 'K') {
                    $int = str_replace($repl[$i], 13, 'K');
                    array_push($arrayEscalera, $int);
                }
            } else {
                $int = intval($repl[$i]);
                array_push($arrayEscalera, $int);//introducimos todos los valores que hemos obtenido en el array auxiliar.
            }
        }



        //Preparación para el condicional de la jugada: LA CARTA MAS ALTA
        $arrayMax = array();//funciona igual que el anterior pero sacaremos la carta mas alta cuando comprobemos la jugada.
        $int3 = 0;
        for ($i = 0; $i < sizeof($repl); $i++) {
            if (preg_match($regex3, $repl[$i])) {
                if ($repl[$i] == 'J') {
                    $int3 = str_replace($repl[$i], 11, 'J');
                    array_push($arrayMax, $int3);
                } else if ($repl[$i] == 'Q') {
                    $int3 = str_replace($repl[$i], 12, 'Q');
                    array_push($arrayMax, $int3);
                } else if ($repl[$i] == 'K') {
                    $int3 = str_replace($repl[$i], 13, 'K');
                    array_push($arrayMax, $int3);
                } else {
                    $int3 = intval($repl[$i]);
                    array_push($arrayMax, $int3);
                }
            }
        }

     

        for ($i = 0; $i < sizeof($manoFinal); $i++) {//recorremos la jugada final para condicionarla utilizando los algoritmos descritos anteriormente.
           

                //ROYAL FLUSH-FLOR IMPERIAL
                //En esta mano comprobamos que es lo que contiene cada una de las posiciones de la jugada. Esto lo hacemos con cada uno de los palos.
            //Esto lo hacemos asi ya que la escalera real , es una mano muy específica en la que se tienen en cuenta un rango de números específicos.
                if ((((str_contains($manoFinal[0], 1)) && (str_contains($manoFinal[0], 'C'))) /*|| (str_contains($manoFinal[0], 'X'))*/) &&
                        (((str_contains($manoFinal[1], 'K')) && (str_contains($manoFinal[1], 'C'))) /* || (str_contains($cad1[1], 'X')) */) &&
                        (((str_contains($manoFinal[2], 'Q')) && (str_contains($manoFinal[2], 'C'))) /* || (str_contains($cad1[2], 'X')) */) &&
                        (((str_contains($manoFinal[3], 'J')) && (str_contains($manoFinal[3], 'C'))) /* || (str_contains($cad1[3], 'X')) */) &&
                        (((str_contains($manoFinal[4], '10')) && (str_contains($manoFinal[4], 'C'))) /* || (str_contains($cad1[4], 'X')) */)) {

                    return $rf;
                } else if ((((str_contains($manoFinal[0], 1)) && (str_contains($manoFinal[0], 'T')))/* || (str_contains($cad1[0], 'X')) */) &&
                        (((str_contains($manoFinal[1], 'K')) && (str_contains($manoFinal[1], 'T'))) /* || (str_contains($manoFinal[1], 'X')) */) &&
                        (((str_contains($manoFinal[2], 'Q')) && (str_contains($manoFinal[2], 'T'))) /* || (str_contains($cad1[2], 'X')) */) &&
                        (((str_contains($manoFinal[3], 'J')) && (str_contains($manoFinal[3], 'T'))) /* || (str_contains($cad1[3], 'X')) */) &&
                        (((str_contains($manoFinal[4], '10')) && (str_contains($manoFinal[4], 'T')))/* || (str_contains($cad1[4], 'X')) */)) {

                      return $rf;
                } else if ((((str_contains($manoFinal[0], 1)) && (str_contains($manoFinal[0], 'R')))/* || (str_contains($cad1[0], 'X')) */) &&
                        (((str_contains($manoFinal[1], 'K')) && (str_contains($manoFinal[1], 'R')))/* || (str_contains($cad1[1], 'X')) */) &&
                        (((str_contains($manoFinal[2], 'Q')) && (str_contains($manoFinal[2], 'R'))) /* || (str_contains($cad1[2], 'X')) */) &&
                        (((str_contains($manoFinal[3], 'J')) && (str_contains($manoFinal[3], 'R'))) /* || (str_contains($cad1[3], 'X')) */) &&
                        (((str_contains($manoFinal[4], '10')) && (str_contains($manoFinal[4], 'R'))) /* || (str_contains($cad1[4], 'X')) */)) {

                      return $rf;
                } else if ((((str_contains($manoFinal[0], 1)) && (str_contains($manoFinal[0], 'P'))) /* || (str_contains($manoFinal[0], 'X')) */) &&
                        (((str_contains($manoFinal[1], 'K')) && (str_contains($manoFinal[1], 'P'))) /* || (str_contains($cad1[1], 'X')) */) &&
                        (((str_contains($manoFinal[2], 'Q')) && (str_contains($manoFinal[2], 'P'))) /* || (str_contains($cad1[2], 'X')) */) &&
                        (((str_contains($manoFinal[3], 'J')) && (str_contains($manoFinal[3], 'P'))) /* || (str_contains($cad1[3], 'X')) */) &&
                        (((str_contains($manoFinal[4], '10')) && (str_contains($manoFinal[4], 'P'))) /* || (str_contains($cad1[4], 'X')) */)) {

                    return $rf;
                }//STRAIGHT FLUSH-ESCALERA DE COLOR //No funciona con comodines
                else if (($arrayIndex[0] == $arrayIndex[1] - 1)) {//Para saber si son consecutivos, jugamos con los indices almacenados. Como nuestra baraja está ordenada por 
                    if (($arrayIndex[1] == $arrayIndex[2] - 1)) {//palos y cartas consecutivas, sabemos que si el indice anterior es igual al indice posterior menos uno
                        if (($arrayIndex[2] == $arrayIndex[3] - 1)) {//seran cartas del mismo palo consecutivas.
                            if (($arrayIndex[3] == $arrayIndex[4] - 1)) {

                                return $sf;
                            }
                        }
                    }

                    //POKER  
                } else if (in_array(4,$p)) {//Tal y como he explicado anteriormente. Para saber si hay poker comprobamos si el array contiene el número 4.
                    return $pk;//Esto es que ha contado que de un mismo valor hay cuatro ocurrencias por lo que si o si es un poker.
                    //FULL
                } else if ((in_array(2, $p)) && (in_array(3, $p))) {//Aquí comprobamos si el array contiene dos ocurrencias esto será que tenemos un numero que aparece 2 veces
                    return $full;//y otro que aparece 3 veces. Por lo tanto es un full.
                    //FLUSH-COLOR
                } else if ($longUnicos == 1) {//aquí capturábamos el palo. Si el array está compuesto por una sola posición sabemos que solo hay un palo por lo tanto es color.
                    return $flush;
                    //ESCALERA
                } else if ($arrayEscalera[0] == $arrayEscalera[1] - 1 && $arrayEscalera[1] == $arrayEscalera[2] - 1 && $arrayEscalera[2] == $arrayEscalera[3] - 1 && $arrayEscalera[3] == $arrayEscalera[4] - 1) {
                    return $escalera;//Aquí determinamos si la posición anterior es menor que la posterior en 1. Si es así, sabemos que es una escalera. Aquí no comprobamos el palo.
                    //TRIO
                } else if (in_array(3, $p)) {//Si el array contiene un 3 será un trío. El filtro del full ya lo pasó así que solo necesitamos saber si contiene un 3.

                    return $trio;
                    //DOBLE PAREJA  
                } else if (sizeof($p) == 3) {//Comprobamos la longitud. Si es tres, sabemos que tendremos 3 valores. Dos de ellos repetidos.Por lo que tenemos doble pareja.
                    return $doblePareja;
                    //PAREJA 
                } else if (sizeof($p) == 4) {//si la longitud es 4 sabemos que al menos, uno de los números, será repetido. Asi que tenemos una pareja.
                    return $pareja;
                } else if ($maximo = max($arrayEscalera)) {//Una vez pasado el filtro de todas las jugadas llegamos a la carta mas alta, sacando el número más alto de la jugada.
                    return $cartaAlta;
                }
            }
            
            /*
             * COMPROBACION DE JUGADAS MEDIANTE CONSOLA
             *   for ($i = 0; $i < sizeof($cad1); $i++) {
           

                //ROYAL FLUSH-FLOR IMPERIAL
               
                if ((((str_contains($cad1[0], 1)) && (str_contains($cad1[0], 'C'))) || (str_contains($cad1[0], 'X'))) &&
                        (((str_contains($cad1[1], 'K')) && (str_contains($cad1[1], 'C')))  || (str_contains($cad1[1], 'X')) ) &&
                        (((str_contains($cad1[2], 'Q')) && (str_contains($cad1[2], 'C'))) || (str_contains($cad1[2], 'X')) ) &&
                        (((str_contains($cad1[3], 'J')) && (str_contains($cad1[3], 'C')))  || (str_contains($cad1[3], 'X')) ) &&
                        (((str_contains($cad1[4], '10')) && (str_contains($cad1[4], 'C')))  || (str_contains($cad1[4], 'X')) )) {

                    $this->write_to_console($rf);
                } else if ((((str_contains($cad1[0], 1)) && (str_contains($cad1[0], 'T'))) || (str_contains($cad1[0], 'X')) ) &&
                        (((str_contains($cad1[1], 'K')) && (str_contains($cad1[1], 'T')))  || (str_contains($cad1[1], 'X')) ) &&
                        (((str_contains($cad1[2], 'Q')) && (str_contains($cad1[2], 'T')))  || (str_contains($cad1[2], 'X')) ) &&
                        (((str_contains($cad1[3], 'J')) && (str_contains($cad1[3], 'T')))  || (str_contains($cad1[3], 'X')) ) &&
                        (((str_contains($cad1[4], '10')) && (str_contains($cad1[4], 'T'))) || (str_contains($cad1[4], 'X')) )) {

                    $this->write_to_console($rf);
                } else if ((((str_contains($cad1[0], 1)) && (str_contains($cad1[0], 'R')))|| (str_contains($cad1[0], 'X')) ) &&
                        (((str_contains($cad1[1], 'K')) && (str_contains($cad1[1], 'R'))) || (str_contains($cad1[1], 'X')) ) &&
                        (((str_contains($cad1[2], 'Q')) && (str_contains($cad1[2], 'R')))  || (str_contains($cad1[2], 'X')) ) &&
                        (((str_contains($cad1[3], 'J')) && (str_contains($cad1[3], 'R')))  || (str_contains($cad1[3], 'X')) ) &&
                        (((str_contains($cad1[4], '10')) && (str_contains($cad1[4], 'R')))  || (str_contains($cad1[4], 'X')) )) {

                    $this->write_to_console($rf);
                } else if ((((str_contains($cad1[0], 1)) && (str_contains($cad1[0], 'P')))  || (str_contains($cad1[0], 'X')) ) &&
                        (((str_contains($cad1[1], 'K')) && (str_contains($cad1[1], 'P')))  || (str_contains($cad1[1], 'X')) ) &&
                        (((str_contains($cad1[2], 'Q')) && (str_contains($cad1[2], 'P'))) || (str_contains($cad1[2], 'X')) ) &&
                        (((str_contains($cad1[3], 'J')) && (str_contains($cad1[3], 'P'))) || (str_contains($cad1[3], 'X')) ) &&
                        (((str_contains($cad1[4], '10')) && (str_contains($cad1[4], 'P'))) || (str_contains($cad1[4], 'X')) )) {

                    $this->write_to_console($rf);
                }//STRAIGHT FLUSH-ESCALERA DE COLOR 
                else if (($arrayIndex[0] == $arrayIndex[1] - 1)) {
                    if (($arrayIndex[1] == $arrayIndex[2] - 1)) {
                        if (($arrayIndex[2] == $arrayIndex[3] - 1)) {
                            if (($arrayIndex[3] == $arrayIndex[4] - 1)) {

                                $this->write_to_console($sf);
                            }
                        }
                    }

                    //POKER  
                } else if (in_array(4,$p)) {
                   $this->write_to_console($pk);
                    //FULL
                } else if ((in_array(2, $p)) && (in_array(3, $p))) {
                    $this->write_to_console($full);
                    //FLUSH-COLOR
                } else if ($longUnicos == 1) {
                    $this->write_to_console($flush);
                    //ESCALERA
                } else if ($arrayEscalera[0] == $arrayEscalera[1] - 1 && $arrayEscalera[1] == $arrayEscalera[2] - 1 && $arrayEscalera[2] == $arrayEscalera[3] - 1 && $arrayEscalera[3] == $arrayEscalera[4] - 1) {
                    $this->write_to_console($escalera);
                    //TRIO
                } else if (in_array(3, $p)) {

                    $this->write_to_console($trio);
                    //DOBLE PAREJA  
                } else if (sizeof($p) == 3) {
                    $this->write_to_console($doblePareja);
                    //PAREJA 
                } else if (sizeof($p) == 4) {
                    $this->write_to_console($pareja);
                } else if ($maximo = max($arrayEscalera)) {
                    $this->write_to_console($cartaAlta);
                }
            }
             */
        }


    public function getCartas() {

        return $this->cartas;
    }

    public function setCartas($cartas): void {
        $this->cartas = $cartas;
    }

    
    //Esta función se ha generado para hacer comprobaciones por consola.
   /* function write_to_console($data) {
        $console = $data;
        if (is_array($console))
            $console = implode(',', $console);
        echo "<script>console.log('Console: " . $console . "' );</script>";
    }
*/
}
