<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Amazing Zone Main Page</title>

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
<h2>Welcome, <?= $this->session->userdata('loggedname') ?></h2>
<div id='toprightnav'>
	<ul>
		<li><a href='addbook'>Add Book And Review</a></li>
		<li><form action='logout'>
			<button type='submit' value='submit'>Log Out</button>
		</form></li>	
	</ul>
</div>
<div id="container">

	<div id="body">
		<h1>Latest Book Reviews</h1>
<?php
	foreach ($recentreviews as $review) {
		?><h2><a href="review/<?=$review['book_id']  ?>"><?= $review['title'] ?></a></h2>
<?php  echo 'Rating: ';
for($i=0; $i<$review['rating'];$i++){
			echo "&#9751";
		}
		while($i<5){
			echo '&#9750';
			$i++;
		}

?>	<p><?= $review['alias']?> says: 
<?=
$review['txt'];
?></p>
<p><?= 'posted on ' . $review['date_added']	
?>

<hr><?php
	}

	?><p></p>

<?php 
?>


		<h2>Other Books to Review</h2>
		<div>
<?php
foreach ($allbooks as $book) {
?><p><a href="review/<?= $book["book_id"] ?>"> <?= $book["title"] ?></a></p>
<?php	
	}
?>
		</div>
	</div>
</div>
</body>
</html>