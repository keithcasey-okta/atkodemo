<?php

include "includes/includes.php";

echo json_encode($_GET);

$userID = $_GET["userID"];
$code = $_GET["activationCode"];
$userType = $_GET["userType"];

$url = "https://" . $config["oktaOrg"] . ".okta.com/api/v1/users/" . $userID;

$apiKey = $config["apiKey"];

$curl = curl_init();
  
curl_setopt_array($curl, array(
	CURLOPT_HTTPHEADER => array("Authorization: SSWS $apiKey ", "Accept: application/json", "Content-Type: application/json"),
	CURLOPT_RETURNTRANSFER => TRUE,
	CURLOPT_URL => $url
));

$jsonResult = curl_exec($curl);

$userData = json_decode($jsonResult, TRUE);

echo "<p>";

echo $jsonResult;

if ($code == $userData["profile"]["activationCode"]) {
	// echo "<p>Code is good.";
}
else {
	echo "<p>Code is not good.";
	exit;
}

$login = $userData["profile"]["login"];

if ($userType == "pro") {
	echo "<p>Please give us some more information about yourself.";

	$output = "<form action = 'evaluateNewVOEuser.php' method = 'POST'>";
	$output .= "<input type = 'text' placeholder = 'mobile phone' name = 'phone'></input>";
	$output .= "<br>";
	$output .= "<input type = 'password' placeholder = 'password' name = 'password'></input>";
	$output .= "<br>";
	$output .= "<input type = 'hidden' name = 'userID' value = '" . $userID . "'>";
	$output .= "<input type = 'hidden' name = 'login' value = '" . $login . "'>";
	$output .= "<input type = 'submit' value = 'submit' name = 'submit'></input>";
	$output .= "</form>";

	echo $output;
}