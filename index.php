<?php

include "includes/includes.php";

$thisPage = new htmlPage($config);

/*************************************/

$thisPage->setTitle($config["name"] . " - Home");

$elements = [
	"oktaWidgetCSScore",
	"oktaWidgetCSStheme",
	"oktaWidgetCSSlocal",
	"mainCSS",
	"jquery",
	"font-awesome",
	"okta-signin-widget",
	"index",
	"dates"
];

$thisPage->addElements($elements);

if (empty($_GET["responseType"])) {
	$responseType = "id_token";

	$thisPage->setConfigValue("responseType", $responseType);


	$thisPage->loadBody("index", ["webHome", "name", "responseType"]);
}


$thisPage->display();