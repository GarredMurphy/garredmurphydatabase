
<html>
    <link href="css/styles.css" rel ="stylesheet" type="text/css" />
    <body>
<?php
$servername = "us-cdbr-iron-east-05.cleardb.net";
$username = "b10d78d16d1281";
$password = "12f943a2";
$dbname = "heroku_e746fa7e355c8e7";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$sql = "SELECT id, name, college FROM Departments";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
     echo "de partment id : ".$row["id"] . "<br>";
     }
} else {
    echo "0 results";
}
$conn->close();
?> 
</body>
</html>