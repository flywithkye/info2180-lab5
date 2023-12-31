<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$country = htmlspecialchars($_GET['country'], ENT_COMPAT);
$country = strip_tags($country);
$lookup;
if (isset($_GET['lookup'])){
  $lookup = htmlspecialchars($_GET['lookup'], ENT_COMPAT);
  $lookup = strip_tags($lookup);
}


if (empty($country)) {  
  $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
  $stmt = $conn->query("SELECT * FROM countries");

  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  echo "All Countries" . "\n";
  echo "<table>" . "\n";
  echo "<tr>" . "\n";
  echo "<th>Country Name</th>" . "\n";
  echo "<th>Continent</th>" . "\n";
  echo "<th>Independence Year</th>" . "\n";
  echo "<th>Head of State</th>" . "\n";
  echo "</tr>" . "\n";
  foreach ($results as $row):
    echo "<tr>" . "\n";
    echo  "<td>" . $row['name'] . "</td>";
    echo  "<td>" . $row['continent'] . "</td>";
    if ($row['independence_year'] === null){
      echo "<td>" . "Not independent" . "</td>";
    } else {
      echo "<td>" . $row['independence_year'] . "</td>";
    }  
    echo  "<td>" . $row['head_of_state'] . "</td>";
    echo "</tr>" . "\n";
  endforeach;
  echo "</table>";

} elseif(isset($lookup)) {
  if ($lookup === "cities"){
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $stmt = $conn->query("SELECT * FROM countries JOIN cities ON code=cities.country_code WHERE countries.name LIKE '$country'");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>" . "\n";
    echo "<tr>" . "\n";
    echo "<th>City Name</th>" . "\n";
    echo "<th>District</th>" . "\n";
    echo "<th>Population</th>" . "\n";
    echo "</tr>" . "\n";
    foreach ($results as $row):
      echo "<tr>" . "\n";
      echo  "<td>" . $row['name'] . "</td>";
      echo  "<td>" . $row['district'] . "</td>";
      echo  "<td>" . $row['population'] . "</td>";
      echo "</tr>" . "\n";
    endforeach;
    echo "</table>";
  }  

} else {
  $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");

  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  echo "<table>" . "\n";
  echo "<tr>" . "\n";
  echo "<th>Country Name</th>" . "\n";
  echo "<th>Continent</th>" . "\n";
  echo "<th>Independence Year</th>" . "\n";
  echo "<th>Head of State</th>" . "\n";
  echo "</tr>" . "\n";
  foreach ($results as $row):
    echo "<tr>" . "\n";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['continent'] . "</td>";
    if ($row['independence_year'] === null){
      echo "<td>" . "Not independent" . "</td>";
    } else {
      echo "<td>" . $row['independence_year'] . "</td>";
    }    
    echo "<td>" . $row['head_of_state'] . "</td>";
    echo "</tr>" . "\n";
  endforeach;
  echo "</table>";
}


?>

