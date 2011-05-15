<?php
session_start();
require_once('library/html.php');
require_once('library/models.php');
?>

<!-------form for selecting what to display --------------->
<?php htmlStart("Product List"); ?>
<body>
<?php htmlNav(); ?>
	<p>Welcome back <?php echo $_SESSION['customer_name']?> please make a selection
<?php htmlEnd(); ?>
