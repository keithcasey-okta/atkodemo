<?php

$home = "atkotravel"; // establishes homedir in webdir

include $_SERVER['DOCUMENT_ROOT'] . "/" . $home . "/includes/includes.php";

$thisPage = new htmlPage($config);

/*** Manually add elements here ******/

$thisPage->setTitle("Atko Travel Agency - Session manager");

// okta sign-in widget js
$thisPage->addElement("okta-signin-widget");

// local js logic to check to see whether an okta session exists
$thisPage->addElement("checkForSession");

$thisPage->display();