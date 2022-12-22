<?php 
require_once("../config.php");

function getAllPlacesVisited(bool $visited):array | null {
  $credenciales = darCredenciales();  
  $dbConnect = pg_connect("host=".$credenciales['host']." port=".$credenciales['port']." dbname=".$credenciales['dbname']." user=".$credenciales['user']." password=".$credenciales['passwd']);

    if (!$dbConnect) {
        echo "Error accesing to DataBase: ".$credenciales['dbname'];
        return null;
    }

    $query = "";
    if ($visited) {
      $query = "SELECT * FROM places WHERE visited = 't'";  
    } else {
      $query = "SELECT * FROM places WHERE visited = 'f'";
    }

    $consult = pg_query($dbConnect, $query);

    pg_close($dbConnect);

    if (!$consult) {
      echo "Error at query\n";
      exit;
    }
    
    $output = [];

    while ($row = pg_fetch_assoc($consult)) {
      array_push($output, [$row['id'], $row['name'], $row['visited']]);
    }
    
    return $output;
}

?>