<?php

// 1. Autoload the SDK Package. This will include all the files and classes to your autoloader
$composerAutoload = dirname(dirname(dirname(__DIR__))) . '/autoload.php';
if (!file_exists($composerAutoload)) {
    //If the project is used as its own project, it would use rest-api-sdk-php composer autoloader.
    $composerAutoload = dirname(__DIR__) . '/vendor/autoload.php';


    if (!file_exists($composerAutoload)) {
        echo "The 'vendor' folder is missing. You must run 'composer update' to resolve application dependencies.\nPlease see the README for more information.\n";
        exit(1);
    }
}

/** @noinspection PhpIncludeInspection */
require $composerAutoload;
// 2. Provide your Token. Replace the given one with your app Token
// https://accounts.blockcypher.com/dashboard
$token = 'd9f5ce6107b84b3aa5fee7b810d258f8';
$apiContext = new \BlockCypher\Rest\ApiContext(
	new \BlockCypher\Auth\SimpleTokenCredential($token)
);