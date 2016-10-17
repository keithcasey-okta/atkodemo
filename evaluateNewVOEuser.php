<?php

include "includes/includes.php";

// echo json_encode($_POST);

$userID = $_POST["userID"];
$credData["credentials"]["password"]["value"] = $_POST["password"];
$profileData["profile"]["mobilePhone"] = $_POST["phone"];

$url = "https://" . $config["oktaOrg"] . ".okta.com/api/v1/users/" . $userID;

$apiKey = $config["apiKey"];

$curl = curl_init();

/***************** SET PROFILE DATA *******************************/

curl_setopt_array($curl, array(
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_HTTPHEADER => array("authorization: SSWS $apiKey ", "accept: application/json", "content-Type: application/json"),
	CURLOPT_RETURNTRANSFER => TRUE,
	CURLOPT_URL => $url,
	CURLOPT_POSTFIELDS => json_encode($profileData)
));

$jsonResult = curl_exec($curl);

/***************** SET CREDENTIALS DATA *******************************/

curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($credData));

curl_setopt_array($curl, array(
	CURLOPT_POST => TRUE,
	CURLOPT_HTTPHEADER => array("Authorization: SSWS $apiKey ", "Accept: application/json", "Content-Type: application/json"),
	CURLOPT_RETURNTRANSFER => TRUE,
	CURLOPT_URL => $url,
));

$jsonResult = curl_exec($curl);

/*******************************************/
