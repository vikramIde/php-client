<?php

// # Get Address
// The Address resource allows you to retrieve details about an Address.
//
// API called: '/v1/btc/main/addrs/1DEP8i3QJCsomS4BSMY2RpU1upv62aGvhD'

require __DIR__ . '/../bootstrap.php';

/// override default sample address with GET parameter
if (isset($_GET['address'])) {
    $sampleAddress = filter_input(INPUT_GET, 'address', FILTER_SANITIZE_SPECIAL_CHARS);
} else {
    $sampleAddress = '0x4c0213ba22ce64c23ab114cff5185dd3cd9b2051';
}

$addressClient = new \BlockCypher\Client\AddressClient($apiContexts['ETH.main']);
// $addressClient = new \BlockCypher\Client\AddressClient($apiContexts['BCY.test']);

try {
    $address = $addressClient->get($sampleAddress, array(), $apiContexts['ETH.main']);
    // $address = $addressClient->get($sampleAddress, array(), $apiContexts['BCY.test']);
} catch (Exception $ex) {
    ResultPrinter::printError("Get Address", "Address", $sampleAddress, null, $ex);
    exit(1);
}

ResultPrinter::printResult("Get Address", "Address", $address->getAddress(), null, $address);

return $address;