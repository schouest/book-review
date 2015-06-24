<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Amazing Zone: User Info</title>

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

	#toprightnav{
		position: absolute;
		right: 0px;
		top: 0px;	
	}

	#toprightnav form,li{
		display: inline;
	}

	#toprigtnav ul{
		list-style-type: none;
	}
	</style>
</head>
<body>
<h2>Welcome to Amazing Zone books</h2>
<div id='toprightnav'>
	<ul>
		<li><a href='/'>Home</a></li>
		<li><a href='addbook'>Add Book And Review</a></li>
		<li><form action='logout'>
			<button type='submit' value='submit'>Log Out</button>
		</form></li>
		
	</ul>
</div>
<div id="container">
	<div id="body">
		<h3>User Alias: <?= $user_info[0]['alias'] ?></h3>
		<p>Name: <?= $user_info[0]['name']?></p>
		<p>Email: <?= $user_info[0]['email']?></p>
		<p>Total Reviews: <?= count($user_info) ?></p>
		<br>
		<h4>Posted Reviews on the following books</h4>
<?php foreach ($user_info as $review) {
?><p><a href="/review/<?= $review['book_id'] ?>"><?= $review['title'] ?></a></p><?php
}
?>
	</div>
</div>
</body>
</html>