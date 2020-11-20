<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';
$input = file_get_contents('php://input');
$searchtag = "countries";

if (strlen($input) >= 6) {
    if (substr($input, 0, 6) == "cities") {
        $searchtag = substr($input, 0, 6);
        $input = substr($input, 6);
    }
}

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
if ($searchtag == "countries") {
    $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$input%'");
}
elseif ($searchtag == "cities") {
    $stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code=countries.code WHERE countries.name LIKE '%$input%'");
}


$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php if ($searchtag == "countries"): ?>
<table>
  <tr>
    <th>Name</th>
    <th>Continent</th> 
    <th>Independence</th>
    <th>Head of State</th>
  </tr>
  <?php foreach ($results as $row): ?>
    <tr>
      <td><?= $row['name'] ?></td>
      <td><?= $row['continent'] ?></td>
      <td><?= $row['independence_year'] ?></td>
      <td><?= $row['head_of_state'] ?></td>
    </tr>
  <?php endforeach; ?>
</table>
<?php elseif ($searchtag == "cities"): ?>
<table>
  <tr>
    <th>Name</th>
    <th>District</th> 
    <th>Population</th>
  </tr>
  <?php foreach ($results as $row): ?>
    <tr>
      <td><?= $row['name'] ?></td>
      <td><?= $row['district'] ?></td>
      <td><?= $row['population'] ?></td>
    </tr>
  <?php endforeach; ?>
</table>
<?php endif ?>