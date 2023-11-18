<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$country = htmlspecialchars($_GET['country'], ENT_COMPAT);
$country = strip_tags($country);

if (empty($country)) {  
  $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
  $stmt = $conn->query("SELECT * FROM countries");

  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  echo "<ul>" . "\n";
  foreach ($results as $row):
    echo "<li>" . $row['name'] . ' is ruled by ' . $row['head_of_state'] . "</li>" . "\n";
  endforeach;
  echo "</ul>";

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
    echo  "<td>" . $row['name'] . "</td>";
    echo  "<td>" . $row['continent'] . "</td>";
    echo  "<td>" . $row['independence_year'] . "</td>";
    echo  "<td>" . $row['head_of_state'] . "</td>";
    echo "</tr>" . "\n";
  endforeach;
  echo "<table>";
}



?>

