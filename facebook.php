<?php

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

require 'vendor/autoload.php';

session_start();

if (isset($_SESSION['fb_access_token']) && !empty($_SESSION['fb_access_token'])) {
    echo 'Ya obtuviste el token ahora puedas hacer cosas con el porque lo tienes el una sessión, prro';
    echo $_SESSION['fb_access_token'];
}

try {
    $fb = new Facebook([
        'app_id' => '767538411061963',
        'app_secret' => '09e176ad04b0fe0b4a5540f7c4ae8b37',
        'default_graph_version' => 'v2.10'
    ]);
} catch (FacebookSDKException $e) {
    echo 'Error when setting Facebook App credentials';
    exit;
}

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

exit;

if (isset($accessToken)) {
    echo 'hola';
    $data = [
        'message' => 'My awesome photo upload example.',
        'source' => $fb->fileToUpload('https://creativolab.com.mx/gallery/img/me.jpg'),
    ];

    try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->post('/me/photos', $data, $accessToken);
    } catch(FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }

    $graphNode = $response->getGraphNode();

    echo 'Photo ID: ' . $graphNode['id'];
} else {
    echo 'image not published';
}