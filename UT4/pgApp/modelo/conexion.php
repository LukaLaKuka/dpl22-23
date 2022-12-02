<?php 
require_once("credencial.php");
define("credenciales", darCredenciales());

if (!$dbConnect) {
  echo "An error occurred.\n";
  exit;
}

function consultCity($visited) {
    $dbConnect = pg_connect("host=".credenciales->host." port=".$credenciales->port." dbname=".$credenciales->dbname." user=".$credenciales->user." password=".$credenciales->passwd);

    if (!$dbConnect) {
        return false;
    }

    $query = "SELECT name FROM places WHERE $visited";

    $consult = pg_query($dbConnect, $query);

    pg_close($dbConnect);

    if (!$consult) {
      echo "An error occurred.\n";
      exit;
    }
    
    $output = "<ul>\n";
    
    while ($row = pg_fetch_assoc($consult)) {
      $output = "$output\t<il>$row</il>\n";
    }
    
    $output = "$output</ul>\n";
}

?>