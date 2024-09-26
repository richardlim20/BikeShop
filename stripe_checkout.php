<?php

require __DIR__ . "/vendor/autoload.php";

$stripe_secret_key = "sk_test_51Q39RcKHqR9b6MMHrZ6GPnN43QiaUMHrE0tbMkOzJqX4Kr4FPKPoyRtdrjuEV0iMp53iTiwFBMRdqJQND2HHEo7J00DGQwz67T";

\Stripe\Stripe::setApiKey($stripe_secret_key);

// Get the cart total
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $cart_total = $_POST['cart_total'];

  // convert cart to cents as stripe uses cents as its value
  $cart_total_cents = $cart_total * 100; 

  // Create a Checkout Session with the cart total as unit_amount
  $checkout_session = \Stripe\Checkout\Session::create([
      "mode" => "payment",
      "success_url" => "http://localhost/secure-a2-q1/success.php",
      "cancel_url" => "http://localhost/secure-a2-q1/billing.php",
      "line_items" => [
          [
              "quantity" => 1,
              "price_data" => [
                  "currency" => "aud",
                  "unit_amount" => $cart_total_cents,
                  "product_data" => [
                      "name" => "Shopping Cart"
                  ]
              ]
          ],   
      ]
  ]);

  // Redirect the customer to the Stripe Checkout page
  http_response_code(303);
  header("Location: " . $checkout_session->url);
} 
else {
  echo "No cart total provided.";
}