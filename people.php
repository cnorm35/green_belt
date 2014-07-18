<?php
session_start();
require('new-connection.php');
$query = "SELECT Incidents.name, Incidents.date, Users.first_name
FROM Incidents JOIN Users ON Users.id = Incidents.Users_id
WHERE Incidents.id = {$_GET['id']}";
$people= fetch_record($query);
$date = strtotime($people['date']);
?>

<!doctype html>
<html>
<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<title>Whitnesses</title>
</head>
<body>
	<body>
	<h4>Whitnesses</h4>
	<?php
		echo 
		"<p>Welcome {$_SESSION['first_name']}  <a href='process.php'>Log Out</a></p>
		<h3>Incident name: {$people['name']}</h3>
		<h3>Incident date: " . date('M jS Y', $date) . "</h3>
		<h3>Seen by:  {$people['first_name']} </h3>
		<a href='home.php'><button>Back to Home</button></a>";
	?>
</body>
</html>