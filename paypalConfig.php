<?php
//global variable configuration
/*
* PayPal configuration
*/
// PayPal configuration
define('PAYPAL_ID', 'mango__82@hotmail.com'); //seller email
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE
//redirect page
define('PAYPAL_RETURN_URL', 'http://localhost/secure-a2-q1/success.php'); 
define('PAYPAL_CANCEL_URL', 'http://localhost/secure-a2-q1/cancel.php'); 
define('PAYPAL_NOTIFY_URL', 'http://127.0.0.1/secure-a2-q1/ipn.php');
//define currency
define('PAYPAL_CURRENCY', 'AUD');

// Change not required
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)? "https://www.sandbox.paypal.com/cgi-bin/webscr": "https://www.paypal.com/cgi-bin/webscr");
?>