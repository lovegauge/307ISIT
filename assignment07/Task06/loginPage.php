<?php
require_once('library/html.php');
htmlStart("Login");?>
<body>

	<form action="login_result.php" method="POST"> 
		<p>customer id: </p><input type="text" name="customer_id">
		<p>password</p><input type="text" name="password"> 
		<input type="submit" name ="submit" value="submit"> 
	</form>  
	
<?php htmlEnd(); ?>

