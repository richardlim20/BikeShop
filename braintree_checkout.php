<?php
require 'vendor/autoload.php';

// Braintree configuration
$gateway = new Braintree\Gateway([
    'environment' => 'sandbox',
    'merchantId' => 'w9k333wdk5wz4khc',
    'publicKey' => 'bw4bdt9v96qmf2hn',
    'privateKey' => '827b084696d86fd80f838805842b6269'
]);

//Using sample visa card 
//card number: 4111111111111111 expiry:any cvv: 123
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cardNumber = $_POST['card_number'];
    $expiryMonth = $_POST['expiry_month'];
    $expiryYear = $_POST['expiry_year'];
    $cvv = $_POST['cvv'];
    $amount = $_POST['cart_total'];

    // Process payment with Braintree
    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'creditCard' => [
            'number' => $cardNumber,
            'expirationMonth' => $expiryMonth,
            'expirationYear' => $expiryYear,
            'cvv' => $cvv
        ],
        'options' => [
            'submitForSettlement' => true
        ]
    ]);

    if ($result->success) {
        // Payment was successful
        echo 'Transaction ID: ' . $result->transaction->id;
        header('Location: success.php');
    } else {
        // Payment failed, display the error
        echo 'Payment failed: ' . $result->message;
    }
}
?>