<?php

// # Create and Send with MicroTXClient
// Server-side signing.
// This sample code demonstrate how you can create, sign and send a new microtransaction, as documented here at:
// <a href="http://dev.blockcypher.com/#microtransaction-endpoint">http://dev.blockcypher.com/#microtransaction-endpoint</a>
//
// API used: POST /v1/btc/main/txs/micro

require __DIR__ . '/../bootstrap.php';

// $microTXClient = new \BlockCypher\Client\MicroTXClient($apiContexts['BCY.test']);
$microTXClient = new \BlockCypher\Client\TXClient($apiContexts['ETH.main']);

try {
    /// Create, Sign and Send a MicroTX (server-side signing)
    // $microTX = $microTXClient->push('f86d048503f5476a0083027f4b941a8c8adfbe1c59e8b58cc0d515f07b7225f51c72882a45907d1bef7c00801ba0e68be766b40702e6d9c419f53d5e053c937eda36f0e973074d174027439e2b5da0790df3e4d0294f92d69104454cd96005e21095efd5f2970c2829736ca39195d8');
    $microTXClient = new \BlockCypher\Client\MicroTXClient($apiContexts['ETH.main']);
 $microTX = $microTXClient->sendSigned(
        "2c2cc015519b79782bd9c5af66f442e808f573714e3c4dc6df7d79c183963cff", // private key
        "C4MYFr4EAdqEeUKxTnPUF3d3whWcPMz1Fi", // to address
        10000 );// value (satoshis)
} catch (Exception $ex) {
    ResultPrinter::printError("Created and Send MicroTX", "MicroTX", null, null, $ex);
    exit(1);
}

ResultPrinter::printResult("Created and Send MicroTX", "MicroTX", $microTX->getHash(), null, $microTX);