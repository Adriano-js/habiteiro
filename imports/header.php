<?php
$linkperfil = 'http://localhost/phplogin/membros.php?id=' . $_SESSION['id'];
$link_perfil = 'http://localhost/phplogin/home.php?id=' . $_SESSION['id'];
$id = $_GET['id'];
$username = "SELECT username FROM accounts WHERE id = $current_id";
$result = $con->query($username);

if ($result->num_rows > 0) {
	// output data of each row
	while ($row = $result->fetch_assoc()) {

?>
		<nav class="navtop">
			<div>
				<a href="<?php echo $link_perfil ?>">
					<h1>Habiteiro de <?php echo $row["username"];
									}
								} else {
									header('Location: notfound.php?id=' . $current_id);
								} ?>

					</h1>
				</a>
				<a href="logout.php" class="info">Sair</a>
				<a href="<?php echo $linkperfil ?>" class="info">Membros</a>
			</div>
		</nav>