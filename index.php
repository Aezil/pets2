<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();

session_start();
$name = session_name();

//Define a default route
$f3->route('GET /', function() {
  $view = new Template();
  echo $view->render('views/pet-home.html');
}
);

$f3->route('GET /order', function() {
  $view = new Template();
  echo $view->render('views/pet-order.html');
}
);

$f3->route('POST /order2', function() {
  $view = new Template();
  echo $view->render('views/pet-order2.html');
  $petType = $_POST['petType'];
  $petColor = $_POST['petColor'];
  $_SESSION['petType'] = $petType;
  $_SESSION['petColor'] = $petColor;
}
);

$f3->route('POST /summary', function() {
  $view = new Template();
  $petType = $_SESSION['petType'];
  $petColor = $_SESSION['petColor'];
  $petName = $_POST['petName'];
  echo $view->render('views/order-summary.html');
  echo "Pet Name: {$petName}<br>";
  echo "Pet Type: {$petType}<br>";
  echo "Pet Color: {$petColor}<br>";
}
);

//Run fat free
$f3->run();
