<?php
session_start();
$auth_token = $_SESSION["auth"];
$auth_token = $_SERVER["HTTP_AUTHORIZATION"];

$response = checkauth($auth_token);
$json_data = json_decode($response, 1);

echo $response;


function checkauth($auth_token) {
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://id.g88.vin/api/Account/CheckAuthen',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer $auth_token",
    "authority: id.g88.vin",
    'Cookie: __cfduid=dd341756b5068a99ffa3138703308a1b81612025870'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

return $response;
}
?>