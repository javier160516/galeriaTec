<?php 

// echo '<pre>';
// var_dump($_COOKIE);
// echo '</pre>';

require_once __DIR__ . '/vendor/autoload.php';

$access_token = $_COOKIE['PHPSESSID'];
echo $_COOKIE['PHPSESSID'];

// $fb = new Facebook\Facebook([
//   'app_id' => '767538411061963',
//   'app_secret' => 'EAAK6EnZAXwssBAHZCXcwc7jdQy8b5ZCjbrXxnA4lMdz0WnPmYJEJppLRZCnma1xtU0HZANpUQBsFhPYfkZCSUoLZBcNfjPVyoC13cL8BYxuwWOVZCJT1eSAAHQhulnABisaVM2ZCvpLWtcCJgYOSEJ5tSI0N2DzorpU0lOFg9NqDSuU52aFPquasW9ofWOjstdxznPEuNuc4ViAZDZD',
//   'default_graph_version' => 'v14.0',
//   ]);

// $helper = $fb->getJavaScriptHelper();

// try {
//   $accessToken = $helper->getAccessToken();
// } catch(Facebook\Exception\ResponseException $e) {
//   // When Graph returns an error
//   echo 'Graph returned an error: ' . $e->getMessage();
//   exit;
// } catch(Facebook\Exception\SDKException $e) {
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

$fb = new Facebook\Facebook([
    'app_id' => '767538411061963',
    'app_secret' => 'EAAK6EnZAXwssBAHZCXcwc7jdQy8b5ZCjbrXxnA4lMdz0WnPmYJEJppLRZCnma1xtU0HZANpUQBsFhPYfkZCSUoLZBcNfjPVyoC13cL8BYxuwWOVZCJT1eSAAHQhulnABisaVM2ZCvpLWtcCJgYOSEJ5tSI0N2DzorpU0lOFg9NqDSuU52aFPquasW9ofWOjstdxznPEuNuc4ViAZDZD',
    'default_graph_version' => 'v14.0',
    //'default_access_token' => '{access-token}', // optional
  ]);

  $data = [
    'message' => 'My awesome photo upload example.',
    'source' => $fb->fileToUpload('img/e1027b80c89dac19e6eb371ad47d06d0.jpg'),
  ];

  try {
    // Returns a `Facebook\Response` object
    $response = $fb->post('/me/photos', $data, $access_token);
  } catch(Facebook\Exception\ResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exception\SDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }

  $graphNode = $response->getGraphNode();

echo 'Photo ID: ' . $graphNode['id'];