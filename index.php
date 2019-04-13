<?php

//Adding the initial setup to connect to BlockCypher App
require __DIR__  . '/config/bootstrap.php';



// 3. Lets try to create a new webhook using WebHook API mentioned here
// http://dev.blockcypher.com/#webhooks
$webHook = new \BlockCypher\Api\WebHook();
$webHook->setUrl("https://requestb.in/slmm49sl?uniqid=" . uniqid());
$webHook->setEvent('unconfirmed-tx');

// 4. Make a Create Call and Print the Card
try {
    $webHook->create($apiContext);
    echo $webHook;
}
catch (\BlockCypher\Exception\BlockCypherConnectionException $ex) {
    // This will print the detailed information on the exception. 
    //REALLY HELPFUL FOR DEBUGGING
    echo $ex->getData();
}