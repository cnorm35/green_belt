<?php
session_start();
require('new-connection.php');
$query = "SELECT Incidents.id, Incidents.name, Incidents.date, Users.first_name
		FROM Incidents JOIN Users ON Users.id = Incidents.Users_id";

$incidents = fetch_all($query);

?>

<!doctype html>
<html>
<head>
	<title>Codingdojo Crime Watch</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		echo "<h3>Welcome {$_SESSION['first_name']}  <a href='process.php'>Log Out</a></h3>";
	?>
	<table>
		<thead>
			<thead>
				<th>Incident</th>
				<th>Date</th>
				<th>Reported by</th>
				<th>Did you see it?</th>
				<th>Link</th>
			</thead>
		</thead>
		<?php
			foreach ($incidents as $incident) {
				$date = strtotime($incident['date']);

				echo "<tr>
						<td>{$incident['name']}</td>
						<td>" . date('M jS Y', $date) . "</td>
						<td>{$incident['first_name']}</td>
						<td><a href='process.php?action=people&id={$incident['id']}'>YES</a></td>
						<td><a href='process.php?action=view_incident&id={$incident['id']}'>GO</a></td>";
			}
		?>
	</table>

<?php
	if(isset($_SESSION['incident_errors']))
	{
		foreach ($_SESSION['incident_errors'] as $errors) 
		{
			echo "<p class='text-danger'>{$errors}</p>";
		}
		unset($_SESSION['incident_errors']);
	}
?>
	<h3>Add a new Incident</h3>
	<form action="process.php" method="post">
		<input type="hidden" name="action" value="add_incident"/>
		Incident name:<input type="text" name="incident_name"/>
		Incident Date:<input type="date" name="incident_date"/>
		<input type="submit" value="CREATE"/>
	</form>
</body>
</html>