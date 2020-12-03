<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
include('imports/connection.php');
include('imports/header.php');
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Profile Page</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>

<body class="loggedin">
	<?php require_once('imports/header.php'); ?>
	<div class="content">
		<h2>Profile Page</h2>
		<div>
			<p>Your account details are below:</p>
			<table>
				<tr>
					<td>Username:</td>
					<?php
					$id = $_GET['id'];
					$username = "SELECT username FROM accounts WHERE id = $id";
					$result = $con->query($username);

					if ($result->num_rows > 0) {
						// output data of each row
						while ($row = $result->fetch_assoc()) {

					?>
							<td>
						<?php
							echo $row["username"];
						}
					} else {
						echo "0 results";
					}
						?>
							</td>
				</tr>

				<tr>
					<td>Email:</td>
					<?php
					$email = "SELECT email FROM accounts WHERE id = $id";
					$result = $con->query($email);

					if ($result->num_rows > 0) {
						// output data of each row
						while ($row = $result->fetch_assoc()) {

					?>
							<td>
						<?php
							echo $row["email"];
						}
					} else {
						echo "0 results";
					}
					$con->close();
						?>
							</td>
				</tr>
			</table>
		</div>
	</div>
</body>

</html>