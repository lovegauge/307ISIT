<?php
require_once 'library/models.php';
require_once 'library/db.php';
require_once 'library/html.php';
// Code to set the status available and save it



htmlStart("Login");?>

<body>
	<p>Type the book id you would like to set as available</p>
	<form action="setStatusAvailable.php" method="Get"> 
		<p>Book id: </p><input type="text" name="book_id">
		<input type="submit" name ="submit" value="submit"> 
	</form>  
	
<?php
$bf = new BookFactory();
$myBook = $bf->fetch($_GET['book_id']);
$myBook->setStatusAvailable();
$bf->save( $myBook );
?>
	<p>You have made book id <?php echo $_GET['book_id'] ?> Available</p>


<?php htmlEnd(); ?>


