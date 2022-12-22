<?php 
require_once("../modelo/DAO.php");

function generateList(bool $visited) {
    $places = getAllPlacesVisited($visited);
    $output = "<ul>\n";
    for ($i = 0; $i<sizeof($places); $i++) {
        $place = $places[$i];
        $output=$output."<li>".$place[1]."</li>\n";
    }
    $output = $output."</ul>\n";

    echo $output;
}
?>