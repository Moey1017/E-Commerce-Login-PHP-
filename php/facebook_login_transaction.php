<?php
session_start();
require_once 'configuration.php';
require_once '../vendor/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '765147987351220',
  'app_secret' => 'db10dde3dfb9d645d8b3497e461c3c51',
  'default_graph_version' => 'v2.10',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://williamhadnett.space/Login_CA2/php/fb-callback.php', $permissions);
header('location: '.$loginUrl.'');

//echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';