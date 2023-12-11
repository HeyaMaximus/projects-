<?php
session_start();

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $total = 0;

    echo '<!DOCTYPE html>
    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="main.css">
        <title>Your Cart</title>
    </head>
    <body>
    <div class="cart-container">';
    echo '<h1>Your Cart</h1>';
    echo '<table class="cart-table">';
    echo '<tr><th>Title</th><th>Price</th><th>Quantity</th></tr>';

    foreach ($_SESSION['cart'] as $isbn => $item) {
        echo '<tr>';
        echo '<td>' . $item['title'] . '</td>';
        echo '<td>$' . $item['price'] . '</td>';
        echo '<td>' . $item['quantity'] . '</td>';
        echo '</tr>';
        $total += ($item['price'] * $item['quantity']);
    }

    echo '</table>';
    echo '<p class="total">Total: $' . number_format($total, 2) . '</p>';
    echo '</div>';
    echo '</body>
    </html>';
} else {
    echo 'Your cart is empty.';
}
?>
