<?php
session_start();

// Update quantity logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_qty'])) {
    $product_id = $_POST['product_id'];
    $quantity = intval($_POST['qty']); // Convert quantity to integer

    // Ensure quantity is at least 1
    if ($quantity < 1) {
        $quantity = 1;
    }

    // Loop through the cart and update the quantity
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $product_id) {
            $item['qty'] = $quantity;
            break;
        }
    }

    // Redirect to the cart page or a confirmation page
    header('Location: chart.php');
    exit();
}

// Remove item logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove_item'])) {
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $_POST['product_id']) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the array
            break;
        }
    }
}

// Calculate total
function calculate_total() {
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['qty'];
    }
    return $total;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style async>
        .cart-container {
            width: 80%;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
        }
        .cart-header, .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .cart-header {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .cart-item {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .cart-item img {
            max-width: 100px;
        }
        .cart-item p {
            margin: 0;
        }
        .cart-item .description {
            flex: 2;
            padding: 0 10px;
        }
        .cart-item .price, .cart-item .qty, .cart-item .total {
            flex: 1;
            text-align: center;
        }
        .cart-item .qty input {
            width: 50px;
            text-align: center;
        }
        .update-btn, .remove-btn {
            background-color: black;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .checkout-container {
            display: flex;
            justify-content: center;
        }
        .checkout-btn {
            background-color: red;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin-left: 4rem;
        }
    </style>
</head>
<body>

<div class="cart-container">
    <h1>Shopping Cart</h1>
    <div class="cart-header">
        <div>Image</div>
        <div class="description">Product Description</div>
        <div class="price">Price</div>
        <div class="qty">Qty</div>
        <div class="total">Total</div>
    </div>

    <?php if (!empty($_SESSION['cart'])): ?>
        <?php foreach ($_SESSION['cart'] as $item): ?>
        
            <form method="POST" action="chart.php">
                <div class="cart-item">
                    <div>
                        <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                    </div>
                    <div><img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>"></div>
                    <div class="description">
                    <p><strong><?php echo ($item['name']); ?></strong></p>
                    </div>
                    <div class="price">$<?php echo number_format($item['price'], 2); ?>  </div>
                    <div class="qty">
                        <input type="number" name="qty" value="<?php echo $item['qty']; ?>" min="1">
                    </div>
                    <div class="total">$<?php echo number_format($item['price'] * $item['qty'], 2); ?></div>
                </div>
                <div class="btn-container">
                    <button type="submit" name="update_qty" class="update-btn">UPDATE QTY</button>
                    <button type="submit" name="remove_item" class="remove-btn">REMOVE</button>
                </div>
            </form>

        <?php endforeach; ?>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>

<?php if (!empty($_SESSION['cart'])): ?>
    
<form method="POST" action="billing.php">
    <div class="checkout-container">
        <h3>Total: $<?php echo number_format(calculate_total(), 2); ?></h3>

        <!-- Hidden fields for each item in the cart -->
        <?php if (!empty($_SESSION['cart'])): ?>
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <input type="hidden" name="cart[<?php echo $item['id']; ?>][id]" value="<?php echo htmlspecialchars($item['id']); ?>">
                <input type="hidden" name="cart[<?php echo $item['id']; ?>][name]" value="<?php echo htmlspecialchars($item['name']); ?>">
                <input type="hidden" name="cart[<?php echo $item['id']; ?>][price]" value="<?php echo htmlspecialchars($item['price']); ?>">
                <input type="hidden" name="cart[<?php echo $item['id']; ?>][qty]" value="<?php echo htmlspecialchars($item['qty']); ?>">
                <input type="hidden" name="cart[<?php echo $item['id']; ?>][total]" value="<?php echo htmlspecialchars($item['price'] * $item['qty']); ?>">
            <?php endforeach; ?>
        <?php endif; ?>

        <button type="submit" class="checkout-btn">Check Out Now!!</button>
    </div>
</form>
<?php endif; ?>

</body>
</html>
