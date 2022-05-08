<?php

//('classMano.php');
require_once 'classCarta.php';
require_once 'classMano.php';
session_start();

if (isset($_POST['enviar'])) {

    $t = $_SESSION['t'];

    $_SESSION['num'] = $_POST['num'];
    $j = $_SESSION['m']->cambia($_SESSION['num']);
    $g = $_SESSION['m']->valor();

    echo "<h1 class ='jugFin' align='center'>LA JUGADA FINAL ES<br><span>" . $g . "</span></h1>";


    echo "<div class=jugadaF>";
    echo "<table class='tabla' align='center'  >";

    echo "<caption class='maquina'> Máquina</caption>";
    echo "<tr><th > nº 0</th><th> nº 1</th><th> nº 2</th><th> nº 3</th><th> nº 4</th></tr>";
    echo "<tr>";
    foreach ($t as $e => $val) {
        echo "<td class='mano' name='valores' >" . $val . "</td>";
    }
    echo "</tr>";

    echo "</table>";


    echo "<table class='tabla' align='center'  >";
    echo "<caption class='humano'> Humano</caption>";
    echo "<tr><th class='human'> nº 0</th><th class='human'> nº 1</th><th class='human'> nº 2</th><th class='human'> nº 3</th><th class='human'> nº 4</th></tr>";
    echo "<tr>";
    foreach ($j as $l => $vl) {
        echo "<td class='mano' name='valores' >" . $vl . "</td>";
    }
    echo "</tr>";

    echo "</table>";
    echo "</div>";
   
}
echo "<div class='otra'>";
echo'  <form action="index.php" method="post"><input type="submit" class="bot1" name="seleccion" value="¡OTRA!"></form>';
echo "</div>";
