<?php
session_start();
require_once 'library/models.php';
require_once 'library/db.php';
require_once 'library/html.php';
// Code to set the status available and save it



htmlStart("Borrow");?>
<body>
<?php htmlNav(); ?>

<?php	
		// Code to set the status as borrowed
		$bookId = $_REQUEST['id'];
		$customerId = $_SESSION['customer_id'];
		$bf = new BookFactory();
		$mybook = $bf->fetch($bookId);
		$mybook->setStatusOnHold( $customerId );
		$bf->save( $mybook );
?>
<p>You have now have <?php echo $mybook->getName();?> on hold </p>

<?php htmlEnd(); ?>
