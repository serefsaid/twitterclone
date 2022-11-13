<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Twitter'a giriş yap</title>
</head>
<body>
	<label for="">Kayıt ol : </label>
	<form action="<?=base_url()?>Main_controller/signUp" method="POST">
		<input type="text" required name="usernameSign">
		<input type="password" required name="passwordSign">
		<input type="submit" value="Kayıt Ol">
	</form>
	<label for="">Giriş yap : </label>
	<form action="<?=base_url()?>Main_controller/login" method="POST">
		<input type="text" required name="username">
		<input type="password" required name="password">
		<input type="submit" value="Giriş Yap">
	</form>
</body>
</html>