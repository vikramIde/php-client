<?php

// # Create TX (without sending it)
//
// This sample code demonstrate how you can create a new transaction, as documented here at:
// <a href="http://dev.blockcypher.com/#creating-transactions">http://dev.blockcypher.com/#creating-transactions</a>
//
// API used: POST /v1/btc/main/txs/new

// Addresses used in this sample:
// Source:
// <a href="https://live.blockcypher.com/btc-testnet/address/n3D2YXwvpoPg8FhcWpzJiS3SvKKGD8AXZ4/">n3D2YXwvpoPg8FhcWpzJiS3SvKKGD8AXZ4</a>
// Destination:
// <a href="https://live.blockcypher.com/btc-testnet/address/mvwhcFDFjmbDWCwVJ73b8DcG6bso3CZXDj/">mvwhcFDFjmbDWCwVJ73b8DcG6bso3CZXDj</a>

require __DIR__ . '/../bootstrap.php';
use BlockCypher\Crypto\Signer;

function signTransaction($tosign, $privateKey){
    $signer = new Signer;
    $signature = $signer->sign($tosign, $privateKey);
    return $signature;
}
/// Tx inputs
$input = new \BlockCypher\Api\TXInput();
$input->addAddress("9a82fd9cbf193d48f46489d8a3dfcd7edbfbf991");

/// Tx outputs
$output = new \BlockCypher\Api\TXOutput();
$output->addAddress("0x4c0213ba22ce64c23ab114cff5185dd3cd9b2051");
$output->setValue(6000); // Satoshis

/// Tx
$tx = new \BlockCypher\Api\TX();
$tx->addInput($input);
$tx->addOutput($output);

//Private key 
$privateKey = "##########################";
/// For Sample Purposes Only.
$request = clone $tx;

$txClient = new \BlockCypher\Client\TXClient($apiContexts['ETH.main']);

try {
    $output = $txClient->create($tx);
    $hex = signTransaction($output->tosign[0],$privateKey);
    $output->signatures=[$hex];//create the hex
    $microTX = $txClient->send($output,$apiContexts['ETH.main']);

} catch (Exception $ex) {
    ResultPrinter::printError("Created TX Error", "TXSkeleton", null, $request, $ex);
    exit(1);
}

ResultPrinter::printResult("Created TX", "TXSkeleton", $output->getTx()->getHash(), $request, $output);

return $output;