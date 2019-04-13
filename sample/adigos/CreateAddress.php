<?php

// # Create Address
// This sample code demonstrate how you can create an address.
//
// API called: '/v1/eth/main/addrs'

require __DIR__ . '/../bootstrap.php';

$addressKeyChain = null;

/// For Sample Purposes Only.
$request = null;

$addressClient = new \BlockCypher\Client\AddressClient($apiContexts['ETH.main']);

try {
    $addressKeyChain = $addressClient->generateAddress();
} catch (Exception $ex) {
    ResultPrinter::printError("Create Address", "AddressKeyChain", null, $request, $ex);
    exit(1);
}

ResultPrinter::printResult("Create Address", "AddressKeyChain", $addressKeyChain->getAddress(), $request, $addressKeyChain);

return $addressKeyChain;