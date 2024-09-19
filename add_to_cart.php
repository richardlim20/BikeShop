<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    // Create an array for the new product
    $product = array(
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
        'image' => $product_image,
        'qty' => 1
    );

    // If cart session doesn't exist, create one
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if the product is already in the cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $product_id) {
            // If product is already in the cart, increase the quantity
            $item['qty']++;
            $found = true;
            break;
        }
    }

    // If product is not found in the cart, add it
    if (!$found) {
        $_SESSION['cart'][] = $product;
    }

    // Redirect to cart page
    header('Location: chart.php');
    exit();
}
?>
