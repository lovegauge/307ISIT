<?php
require_once 'library/models.php';
require_once 'library/db.php';
// Code to set the status available and save it
		$bf = new BookFactory();
		$myBook = $bf->fetch(1);
		$myBook->setStatusAvailable();
		var_dump($myBook);
		$bf->save( $myBook );
