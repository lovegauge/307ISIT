<?php
session_start();
require_once('library/models.php');

$customerId = $_POST['customer_id'];
$customerPassword = $_POST['password'];

$cf = new CustomerFactory();

try {
$customer = $cf->fetch( $customerId );
//var_dump($customer);
if ( $customer->login($customerPassword) == false ) {
	throw new Exception("Password is incorrect");
	}
	
	$cf->storeCustomer( $customer );
	}
	catch ( Exception $e ) {
	echo "Failed login: ".$e->getMessage();
	}

header("Location: /307ISIT/assignment07/Task06/welcomeBack.php");
exit;

