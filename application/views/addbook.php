<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Add Book: Amazing Zone</title>

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

	textarea{
		resize:none;
	}
	</style>
</head>
<body>
<h1>Add a Book</h1>
<div id='toprightnav'>
	<ul>
		<li><a href="/">Home</a></li>
		<li><form action='logout'>
			<button type='submit' value='submit'>Log Out</button>
		</form></li>
		
	</ul>
</div>
<div id="container">

<p><?= $this->session->flashdata('errors'); ?></p>
	<div id="body">
		<form method='post' action='review' id='theform'>
			<label>Title: <input type='text' name='title'></label>
			<label>Author: <select name='author'>
				<option value="ex1">ex 1</option>
				<option value="ex2">ex 2</option>
				<option value="ex3">ex 3</option>
			</select></label>
			<label>Or enter new Author: <input type='text' name='newauthor'></label>
			<label>Review: <textarea form='theform' placeholder="add review" name="review"></textarea></label>
			<label>Rating: <input type='range' name='rating' min="1" max="5"></label>
			<button type='submit' value='submit'>Add Book</button>
		</form>
	</div>
</div>
</body>
</html>