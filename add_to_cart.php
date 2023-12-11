<?php
session_start();
include 'connect.php';

if (isset($_GET['isbn'])) {
    $isbn = $_GET['isbn'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (isset($_SESSION['cart'][$isbn])) {
        $_SESSION['cart'][$isbn]['quantity']++;
    } else {
        $bookDetails = fetchBookDetails($isbn, $connect);

        if ($bookDetails) {
            $_SESSION['cart'][$isbn] = array(
                'title' => $bookDetails['title'],
                'price' => $bookDetails['price'],
                'quantity' => 1
            );

            // Redirect back to the previous page display_books_by_category)
            if (isset($bookDetails['catID'])) {
                header('Location: display_books_by_category.php?category_id=' . $bookDetails['catID']);
                exit();
            } else {
                echo 'Category ID not found.';
            }
        } else {
            echo 'Book not found.';
        }
    }
} else {
    echo 'Invalid request.';
}

function fetchBookDetails($isbn, $connect) {
    $query = "SELECT title, price, catID FROM books WHERE isbn = :isbn";
    $statement = $connect->prepare($query);
    $statement->bindParam(':isbn', $isbn, PDO::PARAM_STR);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        return $statement->fetch(PDO::FETCH_ASSOC);
    } else {
        return null;
    }
}
?>
