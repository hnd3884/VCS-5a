<?php

require_once '../../vendor/autoload.php';

if (!session_id()) {
   session_start();
}

$facebook = new \Facebook\Facebook([
   'app_id' => '683401275628249',
   'app_secret' => '1d4af98c4c30a7354e12e0c852baefac',
   'default_graph_version' => 'v2.10'
]);