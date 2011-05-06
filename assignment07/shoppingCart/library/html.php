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
			Rad Guitars
		</h1>
	</div>

	<div id='navigation'>
		<ul>
			<li><a href = 'listproducts.php'>List Products</a> </li>
			<li><a href = 'showcart.php'>Show Shopping Cart</a> </li>
			<li>Current Time:<body onload='startTime()'><div id='clock'></div></li>
			
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
function displayTable ($products){
	
	echo"<table border = 1>";
			echo"<tbody>";
			foreach ( $products as $prod ) :
				echo"<tr class='listing'>";
				echo "<td><img src='./images/guitarImages/";
				echo $prod->getPictureFile(); 
				echo "'></td>";
				echo"<td>";
						echo"<h1>".$prod->getName(); 
						echo"</h1>";
						echo"<div class='productdescription'>";
								echo nl2br($prod->getDescription()); 
						echo"</div>";
						echo"<br/>";
						echo"<strong>Category: "; 
						echo $prod->getCategoryName(); 
						echo"</strong>";
						echo"<br/><br/>";
						echo"<strong>Price: $";
						echo $prod->getPrice(); 
						echo"</strong>";
						echo"<br/><br/>";
							echo"<a href='addProduct.php?id=".$prod->getId();
							echo"'>Buy Now!</a>";
						echo"</td>";
					echo"</tr>";
			endforeach; 
			echo"</tbody>";
		echo"</table>";
}
