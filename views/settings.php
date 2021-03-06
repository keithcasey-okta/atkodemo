<?php

include "../includes/includes.php";

$thisPage = new htmlPage($config);

// let's not show our api key in the browser.

if ($config["apiKey"]) {
	$config["apiKey"] = substr($config["apiKey"], 0, 5) . "...";
}
else {
	$config["apiKey"] = "NONE";
}

foreach ($config as $key => $value) {

	if (is_array($value)) {
		echo "<p>" . $key . ": " . json_encode($value) . "</p>";
	}
	else {

		echo "<xmp>" . $key . ": " . $value . "</xmp>";

	}

	echo "<br>";
}