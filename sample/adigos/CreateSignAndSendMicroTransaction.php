<?php

// # Create, Sign and Send MicroTX
// This sample code demonstrate how you can create, sign and send a new microtransaction, as documented here at:
// <a href="http://dev.blockcypher.com/#microtransaction-endpoint">http://dev.blockcypher.com/#microtransaction-endpoint</a>
//
// API used: POST /v1/btc/main/txs/micro

require __DIR__ . '/../bootstrap.php';

/// New MicroTX
$microTX = new \BlockCypher\Api\MicroTX();
$microTX->setFromPubkey("0454a19232d2a96eb8306cef950ee23b1d6612a82bbb5b5e7befc0d44ada1949a17a4a7dacdfb1c3d6e422a1a6e04afaa6c02c4ef53eed6c124aa")
    ->setToAddress("0x4c0213ba22ce64c23ab114cff5185dd3cd9b2051")
    ->setValueSatoshis(10000);

$microTXClient = new \BlockCypher\Client\MicroTXClient($apiContexts['ETH.main']);

try {
    /// Create
    $microTXToSign = $microTXClient->create($microTX);

    ResultPrinter::printResult("Created MicroTX", "MicroTX", $microTXToSign->getHash(), $microTX, $microTXToSign);

    /// Sign
    $microTXSigned = $microTXToSign->sign("#######"); // Hex private key

    /// Send
    $microTXSent = $microTXClient->send($microTXSigned);

    ResultPrinter::printResult("Send MicroTX", "MicroTX", $microTXSent->getHash(), $microTXSigned, $microTXSent);

} catch (Exception $ex) {
    ResultPrinter::printError("Created, Sign and Send MicroTX", "MicroTX", null, null, $ex);
    exit(1);
}