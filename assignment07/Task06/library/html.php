<?php

function htmlStart( $pageTitle ) {
	echo "
<html>
	<head>
		<title>$pageTitle</title>
		<link rel='stylesheet' type='text/css' href='http://yui.yahooapis.com/3.3.0/build/cssreset/reset-min.css'>
		<link rel='stylesheet' type='text/css' href='http://yui.yahooapis.com/3.3.0/build/cssbase/base-min.css'>
		<link rel='stylesheet' type='text/css' href='http://yui.yahooapis.com/3.3.0/build/cssfonts/fonts-min.css'>
		
		<!-- link to my own css file -->
		<link rel='stylesheet' type='text/css' href='css/main.css' />
		
		<!-- link to jQuery Library -->
		<script type='text/javascript' src='http://ajax.microsoft.com/ajax/jquery/jquery-1.4.4.min.js'></script>
		
		<!---- link to java script library ---->
		<script type='text/javascript' src='javascript/main.js'></script>
			</head>
	";
}	
		
		
function htmlNav(){
echo "	
<div id='container'>
	<div id='header'>
		<h1>
			Rich Mahogany Books
		</h1>
	</div>

	<div id='navigation'>
		<ul>
			<li><a href = 'listBooks.php'>List Books</a> </li>
			<li><a href = 'showMyBooks.php'>Show my books</a> </li>
		</ul>
	</div>

";
}

function htmlEnd() {
	echo "
		</div>
	</body>
</html>";
}
//display title
function showTitle ($title){
	echo"<h1> $title </h1>";

}
function displayTable ($books){
	
	echo"<table border = 1>";
			echo"<tbody>";
			foreach ( $books as $book ) :
				echo"<tr class='listing'>";
				echo "<td><img src='./images/";
				echo $book->getPictureFile(); 
				echo "'></td>";
				echo"<td>";
						echo"<h1>".$book->getName(); 
						echo"</h1>";
						echo"<div class='productdescription'>";
								echo nl2br($book->getabstract()); 
						echo"</div>";
						echo"<br/>";
						echo"<strong>ISBN: "; 
						echo $book->getisbn(); 
						echo"</strong>";
						echo"<br/><br/>";
						echo"<strong>Author: ";
						echo $book->getauthor(); 
						echo"</strong>";
						echo"<br/><br/>";
						echo"<strong>Status: ";
						echo $book->getStatusType(); 
						echo"</strong>";
						echo"<br/><br/>";
							echo"<a href='addProduct.php?id=".$book->getId();
							echo"'>Borrow!</a>";
						echo"</td>";
					echo"</tr>";
			endforeach; 
			echo"</tbody>";
		echo"</table>";
}
