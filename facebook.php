<?php

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
require '/vendor/autoload.php';


# /js-login.php
$fb = new Facebook\Facebook([
  'app_id' => '767538411061963',
  'app_secret' => 'EAAK6EnZAXwssBAMmJmFO8aDKLZBseFqZAa60qfVTlzZAxyQuDRHacOYT0RUKCB5xM2VyqDgkVuXl1tw99miFE48blP7mq6KQB920lnUe1QP75Nx1DTrWZCMTp8B0NFBXGWIM5RkQdNCYZBPy24udK7jEzQ7VU5vUcvYgZCOZBjtYdNWpQ8QqLZCKYvKE4S17MVaUZADVdNtKCssAZDZD',
  'default_graph_version' => 'v2.10',
  ]);

$helper = $fb->getJavaScriptHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  echo 'No cookie set or no OAuth data could be obtained from cookie.';
  exit;
}

// Logged in
echo '<h3>Access Token</h3>';
var_dump($accessToken->getValue());

$_SESSION['fb_access_token'] = (string) $accessToken;

// User is logged in!
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');

// ----------------------------------------------------------

// $access_token = $_COOKIE['PHPSESSID'];
// // echo $_COOKIE['PHPSESSID'];

// $fb = new Facebook\Facebook([
//   'app_id' => '767538411061963',
//   'app_secret' => 'EAAK6EnZAXwssBAMmJmFO8aDKLZBseFqZAa60qfVTlzZAxyQuDRHacOYT0RUKCB5xM2VyqDgkVuXl1tw99miFE48blP7mq6KQB920lnUe1QP75Nx1DTrWZCMTp8B0NFBXGWIM5RkQdNCYZBPy24udK7jEzQ7VU5vUcvYgZCOZBjtYdNWpQ8QqLZCKYvKE4S17MVaUZADVdNtKCssAZDZD',
//   'default_graph_version' => 'v14.0',
//   ]);

// $helper = $fb->getJavaScriptHelper();

// try {
//   $accessToken = $helper->getAccessToken();
// } catch(Facebook\Exceptions\FacebookResponseException $e) {
//   // When Graph returns an error
//   echo 'Graph returned an error: ' . $e->getMessage();
//   exit;
// } catch(Facebook\Exceptions\FacebookSDKException $e) {
//   // When validation fails or other local issues
//   echo 'Facebook SDK returned an error: ' . $e->getMessage();
//   exit;
// }

// if (! isset($accessToken)) {
//   echo 'No cookie set or no OAuth data could be obtained from cookie.';
//   exit;
// }

// // Logged in
// echo '<h3>Access Token</h3>';
// var_dump($accessToken->getValue());

// $_SESSION['fb_access_token'] = (string) $accessToken;

// ----------------------------------------------------------------

// $fb = new Facebook\Facebook([
//   'app_id' => '767538411061963',
//   'app_secret' => 'EAAK6EnZAXwssBAMmJmFO8aDKLZBseFqZAa60qfVTlzZAxyQuDRHacOYT0RUKCB5xM2VyqDgkVuXl1tw99miFE48blP7mq6KQB920lnUe1QP75Nx1DTrWZCMTp8B0NFBXGWIM5RkQdNCYZBPy24udK7jEzQ7VU5vUcvYgZCOZBjtYdNWpQ8QqLZCKYvKE4S17MVaUZADVdNtKCssAZDZD',
//   'default_graph_version' => 'v14.0',
//   //'default_access_token' => '{access-token}', // optional
// ]);

// $data = [
//   'message' => 'My awesome photo upload example.',
//   'source' => $fb->fileToUpload('img/e1027b80c89dac19e6eb371ad47d06d0.jpg'),
// ];

// try {
//   // Returns a `Facebook\Response` object
//   $response = $fb->post('/me/photos', $data, $access_token);
// } catch (Facebook\Exception\ResponseException $e) {
//   echo 'Graph returned an error: ' . $e->getMessage();
//   exit;
// } catch (Facebook\Exception\SDKException $e) {
//   echo 'Facebook SDK returned an error: ' . $e->getMessage();
//   exit;
// }

// $graphNode = $response->getGraphNode();

// echo 'Photo ID: ' . $graphNode['id'];
