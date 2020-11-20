<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';
$country = htmlspecialchars($_GET["country"]);
$context = htmlspecialchars($_GET["context"]);

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
if ($context == "countries") {
    $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
}
elseif ($context == "cities") {
    $stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code=countries.code WHERE countries.name LIKE '%$country%'");
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php if ($context == "countries"): ?>
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
<?php elseif ($context == "cities"): ?>
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