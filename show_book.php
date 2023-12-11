<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Book Details</title>
</head>
<body>
<?php
session_start();
include 'connect.php';

if (isset($_GET['isbn'])) {
    $isbn = $_GET['isbn'];

    try {
        $query = "SELECT * FROM books WHERE isbn = :isbn";
        $statement = $connect->prepare($query);
        $statement->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            $book = $statement->fetch(PDO::FETCH_ASSOC);

            echo '<h1>' . $book['title'] . '</h1>';
            echo '<img src="images/' . $book['isbn'] . '.jpg" alt="' . $book['title'] . '">';
            echo '<p>Author: ' . $book['author'] . '</p>';
            echo '<p>Price: $' . $book['price'] . '</p>';

            //"Add to Cart" button for the selected book
            echo '<form action="add_to_cart.php" method="get">';
            echo '<input type="hidden" name="isbn" value="' . $isbn . '">';
            echo '<input type="submit" value="Add to Cart">';
            echo '</form>';
        } else {
            echo 'Book not found.';
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Please select a book.';
}

$connect = null;
?>
</body>
</html>
