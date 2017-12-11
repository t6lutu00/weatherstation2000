<!DOCTYPE html>
<html>

<head>
<title>WeatherStation2000</title>
<link rel="stylesheet" href="ilma.css">
<meta http-equiv="refresh" content="20; url=<?php echo $_SERVER['PHP_SELF']; ?>">
</head>

<body>
<img align="center" src="images/header.jpg" alt="ylapalkki">

<h1 align="left">Current Weather by WeatherStation 2000</h1>

<table align="left" border="0" cellspacing="0" cellpadding="0">


<a href="tilasto.php">TILASTOT</a>
<br>
<br>

<?php

$servername = "localhost";
$username = "root";
$password = "ryhma8";
$dbname = "Ilma";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT tempC, humidity FROM weatherData WHERE weatherDataid=(SELECT MAX(weatherDataid) FROM weatherData)";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<span> Temperature: ' . round($row["tempC"], 1).'&degC - humidity: ' . round($row["humidity"], 0). '%<br><br><br> </span>';
    }
} else {
    echo "0 results";
}
$conn->close();

?>

<td border="0" align="center">
<br>
<br>
<a href="https://drive.google.com/file/d/1izOq2CQFPrrh7Tr_6qIoHtEdb0bH2uQD/view"><img src="images/androidlogo.jpg" alt="Download app for Android"></a>
</td>

<tr>
</tr>

<td border="0" align="left">
<img align="left" src="images/footer.jpg" alt="alapalkki">
</td>

<tr>
</tr>

<td border="0" align="center">
<p>copyrait ryhma8</p>
</td>
</table>

</body>
</html>