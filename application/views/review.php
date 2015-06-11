<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//TODO: Need to add ability to review from this page
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Amazing Zone: book review</title>

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
<h2>Reviews of <?= $book['title']?></h2>
<h3>Author: <?= $book['name'] ?></h3>
<div id='toprightnav'>
	<ul>
		<li><a href='/'>Home</a></li>
		<li><form action='logout'>
			<button type='submit' value='submit'>Log Out</button>
		</form></li>		
	</ul>
</div>
<div id="container">
<p><?= $this->session->flashdata('errors'); ?></p>
	<div id="body">
		<form method='post' action='submitreview/<?= $book["book_id"] ?>' id='theform'>
			<label>Review: <textarea cols='50' rows='12' form='theform' placeholder="add review" name="review"></textarea></label>
			<label>Rating: <input type='range' name='rating' min="1" max="5"></label>
			<input type='hidden' value="<?= $book['book_id'] ?>" name='id_book'>
			<button type='submit' value='submit'>Add Review</button>
		</form>

		<h2>Reviews:</h2>
<?php 	foreach ($reviews as $review) {
		?><hr><?php
		 echo 'Rating: ';
		for($i=0; $i<$review['rating'];$i++){
			echo "&#9751";
		}
		while($i<5){
			echo '&#9750';
			$i++;
		}

		?><br>
		<p><?= $review['alias'] ?> says: <?= $review['txt'] ?></p>
		<p>Posted on: <?= $review['date_added'] ?></p><?php
		}
	

?>
	</div>
</div>
</body>
</html>