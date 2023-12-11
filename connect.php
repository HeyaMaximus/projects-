<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Connect to Database and Select a Category</title>
</head>
<body>
<?php
try {
    // Establish a database connection
    $datasource = 'mysql:host=localhost;dbname=books_sc';
    $id = 'root';
    $pwd = 'woop';

    // Create connection
    $connect = new PDO($datasource, $id, $pwd);

    // Provide a form to select a category
    echo '<h2>Select a Category</h2>';
    echo '<form action="display_books_by_category.php" method="get">';
    echo '  <select name="category_id">';
    echo '    <option value="1">Internet</option>';
    echo '    <option value="2">Self-Help</option>';
    echo '    <option value="3">Programming</option>';
    echo '    <option value="4">Gardening</option>';
    echo '    <option value="5">Fiction</option>';
    echo '  </select>';
    echo '  <input type="submit" value="Submit">';
    echo '</form>';

} catch (Exception $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
</body>
</html>
