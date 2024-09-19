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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Information</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                <!-- define paypal button and send data -->
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
                <div class="flex justify-between">
                    <input type="radio" name="radgroup" value="gpay" id="gpay-option" class="block mt-4">
                    <label for="gpay-option">Google Pay</label>
                </div>
                <div class="flex justify-between">
                    <input type="radio" name="radgroup" value="other1" id="other1-option" class="block mt-4">
                    <label for="other1-option">Other Payment 1</label>
                </div>
                <div class="flex justify-between">
                    <input type="radio" name="radgroup" value="other2" id="other2-option" class="block mt-4">
                    <label for="other2-option">Other Payment 2</label>
                </div>
                <button class="bg-blue-500 w-full p-2 mt-8">Continue to Checkout</button>
            </div>
</body>
</html>
