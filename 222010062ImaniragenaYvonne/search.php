<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {
    // Connection details
    include('database_connection.php');


    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'product' => "SELECT Name FROM product WHERE Name LIKE '%$searchTerm%'",
        'users' => "SELECT Username FROM users WHERE Username LIKE '%$searchTerm%'",
        'store' => "SELECT Storename FROM store WHERE Storename LIKE '%$searchTerm%'",
        'transaction' => "SELECT PaymentStatus FROM transaction WHERE PaymentStatus LIKE'%$searchTerm%'",
        'orders' => "SELECT OrderStatus FROM orders WHERE OrderStatus LIKE '%$searchTerm%'",
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result=$connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
