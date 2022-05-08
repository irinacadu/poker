<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="main.css">
        <title>Póker</title>

        <?php

        class Carta {

            protected $numero;
            protected $aNumeros = array();
            protected $palo;
            protected $baraja = array();

            public function __construct() {

                $longPalo = 4;
                $numero = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'); //Creamos el array con los valores de las cartas de la baraja
                // $comodin ="X"; ///Declaramos el comodin a parte.
                //instanciamos el array que tendrá todas las cartas de la baraja
                for ($i = 0; $i < $longPalo; $i++) {//como tenemos 4 palos recorremos esta longitud para crear la baraja y añadir los palos
                    foreach ($numero as $index => $value) {//recorremos el array de números y sacamos su valor   
                        $this->numero = $value; //indicamos que el atributo numero de la clase será este valor
                        array_push($this->aNumeros, $this->numero);
                        if ($i == 0) {//si el indice de los palos es 0 le asignamos el palo Trébol. Esto lo hacemos con cada índice.
                            $this->palo = 'T';
                        } else if ($i == 1) {
                            $this->palo = 'C';
                        } else if ($i == 2) {
                            $this->palo = 'P';
                        } else if ($i == 3) {
                            $this->palo = 'R';
                        }
                        array_push($this->baraja, $this->numero . $this->palo); //Insertamos en la baraja todas las cartas de todos los palos
                    }
                }

                //  array_push($this->baraja,$comodin);//Una vez hecho el array, insertamos los dos comodines al final
                //  array_push($this->baraja,$comodin);

                foreach ($this->baraja as $i => $val) {
                    
                }
            }

            public function getNumero() {
                //A la hora de coger el número lo primero es randomizar el array. El resultado que nos da es el índice:
                $num = array_rand($this->baraja);
                foreach ($this->baraja as $el => $val) {//por lo que hacemos un for each para recorrerlos y sacar los valores
                    if ($el == $num) {//si el índice de la baraja, coincide con el que hemos cogido aleatoriamente
                        return $val; //sacamos su valor
                    }
                }
                // 
            }

            public function getPalo() {
                return $this->palo;
            }

            public function getBaraja() {
               
                return $this->baraja;
            }

            public function setNumero($numero): void {
                $this->numero = $numero;
            }

            public function setPalo($palo): void {
                $this->palo = $palo;
            }

         /*   function write_to_console($data) {
                $console = $data;
                if (is_array($console))
                    $console = implode(',', $console);

                echo "<script>console.log('Console: " . $console . "' );</script>";
            }*/

            public function __toString() {
                return "Carta:  $this->numero. $this->palo ";
            }

        }
        