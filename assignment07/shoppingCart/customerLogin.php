<?php
session_start();
require_once 'library/html.php';
require_once 'library/models.php';

$currentCustomer = new Customer(2);
var_dump($currentCustomer);

