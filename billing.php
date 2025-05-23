<?php
// Include configuration file
include_once "paypalConfig.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cart'])) {
        $cart_total = 0;
        $cart_names = "";
        foreach ($_POST['cart'] as $item_id => $item_data) {
            $product_id = htmlspecialchars($item_data['id']);
            $product_name = htmlspecialchars($item_data['name']);
            $product_price = htmlspecialchars($item_data['price']);
            $product_qty = htmlspecialchars($item_data['qty']);
            $product_total = htmlspecialchars($item_data['total']);

            $cart_total += $product_total;
            $cart_names .= $product_name;
            $cart_names .= ", ";

            // Process each item (e.g., save to database, generate order)
            echo "ID: $product_id, Product: $product_name, Price: $product_price, Qty: $product_qty, Total: $product_total<br>";
            echo "Cart Total: $cart_total <br>";
            echo "Cart Total: $cart_names <br>";
        }
    }
}

//Hidden field for gpay
echo '<input type="hidden" id="cart_total" value="' . $cart_total . '">';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Information</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <h1>Provide Billing Information</h1>
    <div id="billing-container" class="flex justify-around">
        <form action="" id="form-container" class="bg-gray-300 p-5">
            <h2>Billing address</h2>
            <div class="flex mt-2">
                <label for="firstName">First Name</label>
                <input type="text" name="firstName" id="firstName">
                <label for="lastName">Last Name</label>
                <input type="text" name="lastName" id="lastName">
            </div>
            <div class="mt-2">
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
            </div>
            <div class="mt-2">
                <label for="address">Address</label>
                <input type="text" name="address" id="address">
            </div>
            <div class="mt-2">
                <label for="address2">Address 2</label>
                <input type="text" name="address2" id="address2">
            </div>
            <div class="mt-2 flex">
                <label for="country">Country</label>
                <input type="text" name="country" id="country">
                <label for="state">State</label>
                <input type="text" name="state" id="state">
                <label for="zip">Zip</label>
                <input type="text" name="zip" id="zip">
            </div>
        </form>
        <div id="payment-container" class="bg-gray-300 w-[40%] p-5">
            <h2>Select a payment option</h2>
            <div class="flex-col">
            <!-- PayPal Section -->
                <form action="<?php echo PAYPAL_URL; ?>" method="post" class="flex justify-between">

                <!-- Specify a Buy Now button. -->
                    <input type="hidden" name="cmd" value="_xclick" />

                <!-- Identify your business so that you can collect the payments. -->
                    <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>" />

                <!-- Specify details about the item that buyers will purchase. part of this field will be used in ipn.php-->
                    <input type="hidden" name="item_name" value="<?php echo $cart_names; ?>" />
                    <input type="hidden" name="amount" value="<?php echo $cart_total ?>" />
                    <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>" />

                <!-- Specify URLs -->
                    <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
                    <input type="hidden" name="notify_url" value="<?php echo PAYPAL_NOTIFY_URL; ?>">
                    <div>Paypal</div>
                    <input type="image" border="0" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"/>
                </form>
            <!-- Google Pay section -->
                <div class="flex justify-between">
                    <div>Google Pay</div>
                    <div id="container"></div>
                </div>
                <script src="gpay.js"></script>
                <script async src="https://pay.google.com/gp/p/js/pay.js" onload="onGooglePayLoaded()"></script>
                
                
            <!-- Stripe Payment section -->
                <?php
                    echo
                    '<form id="checkoutForm" method="POST" action="stripe_checkout.php" class="flex justify-between mt-4">
                    <input type="hidden" name="cart_total" value="' . htmlspecialchars($cart_total) . '">
                    <div>Stripe Payment method</div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4">Stripe Payment</button>
                  </form>';
                ?>
                
            <!-- Braintree payment section -->
            <div class="flex justify-between mt-4">
                <div>Pay with BrainTree Visa</div>
                <button id="openModalBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4">
                    Pay with Braintree Visa
                </button>
            </div>

            <div id="paymentModal" class="fixed inset-0 hidden bg-gray-500 bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                    <h2 class="text-xl font-bold mb-4">Braintree Visa Payment</h2>
                <?php
                    echo '
                    <form id="payment-form" method="POST" action="braintree_checkout.php">
                        <label for="card-number" >Card Number</label>
                        <input type="text" id="card-number" name="card_number" class="mt-1 p-2 border w-full" placeholder="4111111111111111" required>

                        <label for="expiry-month" >Expiry Month</label>
                        <input type="text" id="expiry-month" name="expiry_month" class="mt-1 p-2 border w-full" placeholder="MM" required>

                        <label for="expiry-year" >Expiry Year</label>
                        <input type="text" id="expiry-year" name="expiry_year" class="mt-1 p-2 border w-full" placeholder="YYYY" required>

                        <label for="cvv" >CVV</label>
                        <input type="text" id="cvv" name="cvv" class="mt-1 p-2 border w-full" placeholder="123" required>

                        <input type="hidden" name="cart_total" value="' . htmlspecialchars($cart_total) . '">

                        <div class="flex justify-between mt-6">
                            <button type="button" id="closeModalBtn" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </button>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Checkout
                            </button>
                        </div>
                    </form>
                    '
                ?>
                </div>
            </div>

    <script>
        const modal = document.getElementById('paymentModal');
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');

        openModalBtn.addEventListener('click', function() {
            modal.classList.remove('hidden');
        });

        closeModalBtn.addEventListener('click', function() {
            modal.classList.add('hidden');
        });

        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    </script>

            </div>
</body>
</html>
