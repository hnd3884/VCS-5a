<?php
require_once 'public/config/routes.php';
require_once 'vendor/autoload.php';

if (!session_id()) {
   session_start();
}

$facebook = new \Facebook\Facebook([
   'app_id' => '683401275628249',
   'app_secret' => '1d4af98c4c30a7354e12e0c852baefac',
   'default_graph_version' => 'v2.10'
]);
$facebook_helper = $facebook->getRedirectLoginHelper();

if (isset($_GET['code'])) {

    if (isset($_SESSION['access_token'])) {
        $access_token = $_SESSION['access_token'];
    } else {
        $access_token = $facebook_helper->getAccessToken();

        $_SESSION['access_token'] = $access_token;

        $facebook->setDefaultAccessToken($_SESSION['access_token']);
    }

    $_SESSION['user_id'] = '';
    $_SESSION['user_name'] = '';
    $_SESSION['user_email_address'] = '';
    $_SESSION['user_image'] = '';

    $graph_response = $facebook->get("/me?fields=name,email", $access_token);

    $facebook_user_info = $graph_response->getGraphUser();

    if (!empty($facebook_user_info['id'])) {
        $_SESSION['user_image'] = 'http://graph.facebook.com/' . $facebook_user_info['id'] . '/picture';
    }

    if (!empty($facebook_user_info['name'])) {
        $_SESSION['user_name'] = $facebook_user_info['name'];
    }

    if (!empty($facebook_user_info['email'])) {
        $_SESSION['user_email_address'] = $facebook_user_info['email'];
    }

    $_SESSION["id"] = $facebook_user_info['id'];
    $_SESSION["loggedin"] = true;
    $_SESSION["fullname"] = $facebook_user_info['name'];
    $_SESSION["role"] = 1;

    header("location: " . ROUTE_HOME);
    exit;
}

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: " . ROUTE_LOGIN);
    exit;
}

header("location: " . ROUTE_HOME);
