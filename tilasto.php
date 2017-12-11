<!DOCTYPE html>
<html>

<head>
<title>WeatherStation2000</title>
<link rel="stylesheet" href="ilma.css">
<meta http-equiv="refresh" content="60; url=<?php echo $_SERVER['PHP_SELF']; ?>">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

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

$sql = "SELECT ts, tempC, humidity FROM weatherData WHERE ts > DATE_ADD(NOW(), INTERVAL -5 DAY) ORDER BY ts";
$result = $conn->query($sql);
$data = array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$aika = date('Y,n,d,H,i,s',strtotime($row['ts']));
		$data[] = array("TimeStamp" => Date($aika), "Temperature" => $row['tempC'], "Humidity" => $row['humidity']);
    }
} 

$conn->close();

echo '
function drawChart() {
var data = google.visualization.arrayToDataTable([
["Aika", "Lämpötila"]';
foreach($data as $row) {
	echo ',["'.$row[TimeStamp].'",'.$row[Temperature].']';
}
echo ']);';

echo '
var humm = google.visualization.arrayToDataTable([
["Aika", "Kosteus"]';
foreach($data as $row) {
	echo ',["'.$row[TimeStamp].'",'.$row[Humidity].']';
}
echo ']);';
?>

var options = {
          curveType: 'function',
	  title: 'Edellisin 5 päivän lämpötila',
          legend: { position: 'bottom' },
	  backgroundColor: { fill:'transparent' },
	  colors: ['red']
        };

		var options2 = {
          curveType: 'function',
	  title: 'Edellisen 5 päivän kosteusarvot',
          legend: { position: 'bottom' },
	  backgroundColor: { fill:'transparent' },
	  colors: ['blue']
	};

	var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
	chart.draw(data, options);
	var chart2 = new google.visualization.LineChart(document.getElementById('curve_chart2'));
        chart2.draw(humm, options2);
}
    </script>
</head>

<body>
<img align="center" src="images/header.jpg" alt="ylapalkki">

<h1 align="left">Statistics by WeatherStation 2000</h1>

<table align="left" border="0" cellspacing="0" cellpadding="0">
<a href="ilma.php">ETUSIVU</a>

<div id="curve_chart" style="width: 900px; height: 500px"></div>
<div id="curve_chart2" style="width: 900px; height: 500px"></div>

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
