Hello World 
<br />
<?php
include_once('DBInfo.config');

$connection = new mysqli($server, $user, $password, $db);

if ($connection->connect_error)
{
	die("Connection failed: " . $connection->connect_error);
}
echo "connected successfully";
echo "<br />";

$sql = "select * from Test";
$result = $connection->query($sql);
echo "Database returned " . $result->num_rows . " row:";
echo "<br />";
echo "<table border=solid>";
while($row = $result->fetch_assoc())
{
	echo "<tr> <td>" . $row['Hello'] . "</td><td> " . $row['World'] . "</td></tr>";
}
echo "</table>"
?>
