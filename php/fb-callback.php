<?php

session_start();
require_once '../vendor/autoload.php';
$fb = new Facebook\Facebook([
    'app_id' => '765147987351220',
    'app_secret' => 'db10dde3dfb9d645d8b3497e461c3c51',
    'default_graph_version' => 'v2.10',
        ]);

$helper = $fb->getRedirectLoginHelper();
$_SESSION['FBRLH_state'] = $_GET['state'];

try {
    $accessToken = $helper->getAccessToken();
} catch (Facebook\Exception\ResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exception\SDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (!isset($accessToken)) {
    if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
    }
    exit;
}


// Logged in
//echo '<h3>Access Token</h3>';
$accessToken->getValue();
// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
//echo '<h3>Metadata</h3>';
$tokenMetadata;

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId('765147987351220');
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (!$accessToken->isLongLived()) {
    // Exchanges a short-lived access token for a long-lived one
    try {
        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
    } catch (Facebook\Exception\SDKException $e) {
        echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
        exit;
    }

    //echo '<h3>Long-lived</h3>';
    $accessToken->getValue();
}

$_SESSION['fb_access_token'] = (string) $accessToken;
header('location: test.php');
?>
