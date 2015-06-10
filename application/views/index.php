<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Amazing Zone books</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>
<h2>Welcome to Amazing Zone books</h2>
<div id="container">


<p><?= $this->session->flashdata('errors'); ?></p>
	<div id="body">
		<form method='post' action='register'>
			<label>Name: <input type='text' name='name'></label>
			<label>Alias: <input type='text' name='alias'></label>
			<label>Email: <input type='email' name='mail'></label>
			<label>Password: <input type='password' name='passcode'></label>
			<label>Confirm PW: <input type='password' name='cpasscode'></label>
			<button type='submit' value='submit'>Register</button>
		</form>

		<form method='post' action='signin'>
			<label>Email: <input type='email' name='mail'></label>
			<label>Password: <input type='password' name='passcode'></label>
			<button type='submit' value='submit'>Login</button>
		</form>
	</div>
</div>
</body>
</html>