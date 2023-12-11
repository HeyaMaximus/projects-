<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Books by Category</title>
</head>
<body>
<?php
include 'connect.php'; // Include the connection script

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    try {
        // Fetch books based on the selected category
        $query = "SELECT * FROM books WHERE catID = :category_id";
        $statement = $connect->prepare($query);
        $statement->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            echo '<h1>Books in this Category</h1>';
            echo '<div class="books-container">'; // Create a container for books

            while ($book = $statement->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="book">';
                echo '<h2><a href="show_book.php?isbn=' . $book['isbn'] . '">' . $book['title'] . '</a></h2>';
                echo '<p>Price: $' . $book['price'] . '</p>';
                echo '</div>';
            }

            echo '</div>';

            // Add View Cart button
            echo '<form action="view_cart.php" method="get">';
            echo '<input type="submit" value="View Cart">';
            echo '</form>';
        } else {
            echo 'No books found for this category.';
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Please select a category.';
}

$connect = null;
?>
</body>
</html>
