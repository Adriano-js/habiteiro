<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...

include('imports/connection.php');

if (isset($_POST['but_upload'])) {

	$name = $_FILES['file']['name'];
	$target_dir = "upload/";
	$target_file = $target_dir . basename($_FILES["file"]["name"]);

	// Select file type
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	// Valid file extensions
	$extensions_arr = array("jpg", "jpeg", "png", "gif");

	$result = mysqli_query($con, "SELECT * FROM imagens WHERE user_id=$id AND perfil = 0");

	// Check extension
	if (in_array($imageFileType, $extensions_arr)) {

		$result = mysqli_query($con, "SELECT * FROM imagens WHERE user_id=$id");
		if ($row = mysqli_fetch_array($result)) {
			$query = "DELETE FROM imagens WHERE user_id=$current_id AND perfil = 0 ";
			mysqli_query($con, $query);

			$query = "UPDATE imagens SET img_name = '$name' WHERE user_id=$current_id AND perfil = 0 ";
			mysqli_query($con, $query);
		}

		// Insert record
		$query = "INSERT INTO imagens(img_name, user_id, perfil) VALUES('$name', '$current_id', 0)";
		mysqli_query($con, $query);

		// Upload file
		move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $name);
	}
}

$sql = "SELECT img_name from imagens where user_id=$id AND perfil=0";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

$image = $row['img_name'];
$profile_src = "upload/" . $image;

//ENVIAR FOTO DE PERFIL!!
if (isset($_POST['but_upload2'])) {

	$name = $_FILES['file']['name'];
	$target_dir = "upload/";
	$target_file = $target_dir . basename($_FILES["file"]["name"]);

	// Select file type
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	// Valid file extensions
	$extensions_arr = array("jpg", "jpeg", "png", "gif");

	$result = mysqli_query($con, "SELECT * FROM imagens WHERE user_id=$id AND perfil=1");

	// Check extension
	if (in_array($imageFileType, $extensions_arr)) {

		$result = mysqli_query($con, "SELECT * FROM imagens WHERE user_id=$id AND perfil=1");
		if ($row = mysqli_fetch_array($result)) {

			$query = "DELETE FROM imagens WHERE user_id=$current_id AND perfil = 1 ";
			mysqli_query($con, $query);

			$query = "UPDATE imagens SET img_name = '$name' WHERE user_id=$current_id AND perfil=1 ";
			mysqli_query($con, $query);
		}

		// Insert record
		$query = "INSERT INTO imagens(img_name, user_id, perfil) VALUES('$name', '$current_id', '1')";
		mysqli_query($con, $query);

		// Upload file
		move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $name);
	}
}



$sql = "SELECT img_name from imagens where user_id=$id AND perfil=1";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

$image_perfil = $row['img_name'];
$perfil_src = "upload/" . $image_perfil;

if (isset($_POST['enviar'])) {
	$task = $_POST['task'];
	if (empty($task)) {
		$errors = "Você não pode adicionar uma tarefa vazia.";
	} else {
		$query = "INSERT INTO tasks(task, user_id) VALUES('$task', '$current_id')";
		mysqli_query($con, $query);
	}
}

if (isset($_GET['del_task'])) {
	$task_id = $_GET['del_task'];
	mysqli_query($con, 'DELETE FROM tasks WHERE task_id=' . $task_id);
	header('Location: home.php?id=' . $current_id);
}

if (isset($_GET['del_proc'])) {
	$task_id = $_GET['del_proc'];
	mysqli_query($con, 'DELETE FROM mapa WHERE proc_id=' . $task_id);
	header('Location: home.php?id=' . $current_id);
}

if (isset($_POST['enviarproc'])) {
	$proc = $_POST['proc'];
	if (empty($proc)) {
		$errorsproc = "Você não pode adicionar uma tarefa vazia.";
	} else {
		$query = "INSERT INTO mapa(proc, user_id) VALUES('$proc', '$current_id')";
		mysqli_query($con, $query);
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Home Page</title>

	<!--Linkar CSS.-->
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

</head>

<body id="body" class="loggedin">
	<!--Adicionar menu.-->
	<?php require_once('imports/header.php') ?>

	<!--Container para todos os items do site.-->
	<div class="container">
		<div class="procrastinacao">
			<div class="topo">
				<div class="user" style="background-image: url(<?php echo $perfil_src; ?>); background-size: cover; background-position: center;">
					<!-- SVG da câmera -->
					<svg version="1.1" id="Layer_2" class="layer" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
						<g>
							<circle cx="255.811" cy="285.309" r="75.217" />
							<path d="M477,137H352.718L349,108c0-16.568-13.432-30-30-30H191c-16.568,0-30,13.432-30,30l-3.718,29H34
								c-11.046,0-20,8.454-20,19.5v258c0,11.046,8.954,20.5,20,20.5h443c11.046,0,20-9.454,20-20.5v-258C497,145.454,488.046,137,477,137
								z M255.595,408.562c-67.928,0-122.994-55.066-122.994-122.993c0-67.928,55.066-122.994,122.994-122.994
								c67.928,0,122.994,55.066,122.994,122.994C378.589,353.495,323.523,408.562,255.595,408.562z M474,190H369v-31h105V190z" />
						</g>
					</svg>
				</div>
				<div class="titulo">
					<?php
					$username = "SELECT username FROM accounts WHERE id = $id";
					$result = $con->query($username);
					if ($result->num_rows > 0) {
						// output data of each row
						while ($row = $result->fetch_assoc()) {

					?>
							<span><?php echo $row["username"];
								}
							} ?></span>
							<?php if ($id == $current_id) {
							?>
								<a href="#">Editar Perfil</a>
							<?php } ?>

				</div>
			</div>

			<!--Div principal do mapa de procrastinação-->
			<div class="mapa-procrastinacao">

				<div class="lista-proc">
					<h2>Lista de Procrastinação</h2>

					<?php
					if ($current_id == $id) {
					?>
						<form method="post" action="home.php?id=<?php echo $id ?>">

							<?php if (isset($errorsproc)) { ?>
								<span><?php echo $errorsproc; ?></span>
							<?php } ?>

							<input type="text" name="proc" class="text_input" autocomplete="off">
							<button type="submit" class="task_btn" name="enviarproc">Adicionar Procrastinação</button>
						</form>
					<?php } ?>

					<ol>
						<?php
						if ($current_id == $id) {
							$sql = "SELECT proc, proc_id FROM mapa WHERE user_id=$id ORDER BY proc_id";
							$task = mysqli_query($con, $sql);
							while ($row = mysqli_fetch_assoc($task)) {

						?>
								<li class="elemento-li" class="task"><?php echo $row['proc'] ?>
									<a href="home.php?id=<?php echo $current_id ?>&del_proc=<?php echo $row['proc_id'] ?>">x</a>
								</li>
						<?php	}
						}

						?>




					</ol>
				</div>
			</div>
		</div>

		<!-- Trocar a foto de fundo.-->
		<div class="todo" id="todo" style="background: url('<?php echo $profile_src;  ?>'); background-size: cover; background-position: center;">

			<!--Div da Lista de tarefas.-->
			<div class="lista">

				<?php
				if ($current_id == $id) { ?>
					<form id="form-task" method="post" action="home.php?id=<?php echo $id ?>">

						<?php if (isset($errors)) { ?>
							<span><?php echo $errors; ?></span>
						<?php } ?>

						<input type="text" name="task" class="text_input" autocomplete="off">
						<button type="submit" class="task_btn" name="enviar">Adicionar Tarefa</button>
					</form>
				<?php } ?>


				<!--Tabela para inserir a lista de tarefas.-->
				<table>
					<thead>
						<tr>
							<th>Tarefa</th>
							<?php
							if ($current_id == $id) { ?>
								<th>Ação</th>
							<?php } ?>

						</tr>
					</thead>

					<tbody>
						<?php
						if ($current_id == $id) {
							$sql = "SELECT task, task_id FROM tasks WHERE user_id=$id ORDER BY task_id";
							$task = mysqli_query($con, $sql);
							while ($row = mysqli_fetch_assoc($task)) { ?>
								<tr>
									<td class="task"><?php echo $row['task'] ?></td>
									<td class="delete">
										<a href="home.php?id=<?php echo $current_id ?>&del_task=<?php echo $row['task_id'] ?>">x</a>
									</td>
								</tr>
						<?php	}
						} ?>

					</tbody>
				</table>

			</div>

			<!--Div para colocar elementos na parte inferior da página.-->
			<div class="todo-footer">
				<div class="submit-popup" id="submit-popup">
					<div class="submit-popup-top">

						<!--svg do X na div popup-->
						<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="357px" height="357px" viewBox="0 0 357 357" style="enable-background:new 0 0 357 357;" xml:space="preserve">
							<g>
								<g id="close">
									<polygon points="357,35.7 321.3,0 178.5,142.8 35.7,0 0,35.7 142.8,178.5 0,321.3 35.7,357 178.5,214.2 321.3,357 357,321.3 
													214.2,178.5 		" />
								</g>
							</g>
						</svg>
					</div>

					<!--Formulário para adicionar foto de fundo-->
					<form method="post" action="" enctype='multipart/form-data'>
						<input type='file' name='file' class="button1" />
						<input type='submit' value='Enviar Foto' class="button1" name='but_upload'>
					</form>

					<form method="post" class="form2" action="" enctype='multipart/form-data'>
						<input type='file' name='file' class="button1" />
						<input type='submit' value='Enviar Foto de perfil' class="button1" name='but_upload2'>
					</form>
				</div>

				<!-- SVG da câmera -->
				<svg version="1.1" id="Layer_1" class="layer" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
					<g>
						<circle cx="255.811" cy="285.309" r="75.217" />
						<path d="M477,137H352.718L349,108c0-16.568-13.432-30-30-30H191c-16.568,0-30,13.432-30,30l-3.718,29H34
								c-11.046,0-20,8.454-20,19.5v258c0,11.046,8.954,20.5,20,20.5h443c11.046,0,20-9.454,20-20.5v-258C497,145.454,488.046,137,477,137
								z M255.595,408.562c-67.928,0-122.994-55.066-122.994-122.993c0-67.928,55.066-122.994,122.994-122.994
								c67.928,0,122.994,55.066,122.994,122.994C378.589,353.495,323.523,408.562,255.595,408.562z M474,190H369v-31h105V190z" />
					</g>
				</svg>
				<!--Fim do SVG.-->
			</div>
			<!--Fim da div footer.-->

		</div>
		<!--Fim da div para trocar foto de fundo.-->

	</div>
	<!--Fim do container principal.-->

	<!--Linkar JavaScript I-->
	<script src="code.js"></script>
</body>

</html>