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

$firstName = $userData["profile"]["firstName"];
$lastName = $userData["profile"]["lastName"];
$login = $userData["profile"]["login"];
$email = $userData["profile"]["email"];
$activationCode = $userData["profile"]["activationCode"];

if ($userType == "pro") {
	echo "<p>Please give us some more information about yourself.";

	$output = "<form action = 'evaluateNewVOEuser.php' method = 'POST'>";
	$output .= "<input type = 'text' placeholder = 'mobile phone' name = 'phone'></input>";
	$output .= "<br>";
	$output .= "<input type = 'password' placeholder = 'password' name = 'password'></input>";
	$output .= "<br>";
	$output .= "<input type = 'hidden' name = 'userID' value = '" . $userID . "'>";
	$output .= "<input type = 'submit' value = 'submit' name = 'submit'></input>";
	$output .= "</form>";

	echo $output;
}





// // echo "the post is: ";

// // echo json_encode($_POST);

// if (array_key_exists("flowType", $_POST)) {
// 	$regType = $_POST["flowType"];
// }
// else {
// 	if (empty($_POST["regType"])) { $regType = "basic"; }
// 	else { $regType = $_POST["regType"]; }
// }

// foreach ($_POST as $fieldName => $value) {
// 	if ($fieldName == "basic" || $fieldName == "flowType") {}
// 	else {
// 		$user[$fieldName] = filter_var($value, FILTER_SANITIZE_STRING);
// 	}
// }

// // echo "<p>";

// // echo "<p>the user object is: " . json_encode($user);

// $thisUser = new user($regType, $user);

// if ($regType == "basic" || $regType == "sfChatter") {

// 	$cookieToken = $thisUser->authenticate();

// 	$thisUser->redirect($cookieToken);
// }
// else {
// 	if ($regType == "okta") {
// 		if ($thisUser->hasOktaEmailAddress()) {
// 			$thisUser->setAdminRights();
// 		}
// 	}

// 	$thisUser->sendActivationEmail();

// 	$headerString = "Location: " . $config["webHomeURL"] . "thankYou.php?email=" . $thisUser->email;
// 	$headerString .= "&firstName=" . $thisUser->firstName;

// 	header($headerString);
// }