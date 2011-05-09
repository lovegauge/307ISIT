<?php

/**
* Grab a db connection and return it
*/
function getDbConnection() {
	$dbConnection = new mysqli('localhost','root','root','library_db');
	if ( $dbConnection->connect_error ) {
		throw new Exception("Unable to connect to the database: ". $dbConnection->connect_error );
	}
	return $dbConnection;
}
