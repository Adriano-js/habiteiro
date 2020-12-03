<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="mystyle.css">
	<title>Login</title>
</head>

<body>
	<video playsinline autoplay muted loop poster="" id="bgvid">
		<source src="img/Ants.mp4" type="video/mp4">
	</video>
	<div class="login">
		<form action="authenticate.php" method="post">
			<h1>Login</h1>
			<label for="username">
				<i class="fas fa-user"></i>
			</label>
			<input type="text" name="username" placeholder="Usuário" id="username">
			<label for="password">
				<i class="fas fa-lock"></i>
			</label>

			<input type="password" name="password" placeholder="Senha" id="password">
			<input type="submit" value="Entrar">
			<a href="register.html">Criar conta</a>
		</form>
	</div>

</body>

</html>