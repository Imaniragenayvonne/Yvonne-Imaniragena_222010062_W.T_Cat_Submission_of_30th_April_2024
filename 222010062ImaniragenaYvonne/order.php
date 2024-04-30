<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Products</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: mango;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }

    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }

    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }

    /* Extend margin left for search button */
    input.form-control {
      margin-left: 15px; /* Adjust this value as needed */
      padding: 8px;
    }

    section {
      padding: 71px;
      border-bottom: 1px solid #ddd;
    }

    footer {
      text-align: center;
      padding: 15px;
      background-color: darkgray;
    }

  </style>
  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
</head>
<body style="background-color: skyblue;">
<header>
  <form class="d-flex" role="search" action="search.php">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
      <img src="./Images/store.AVIF" width="90" height="60" alt="Logo">
    </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./product.php">PRODUCT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./store.php">STORE</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./transaction.php">TRANSACTION</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Users.php">USER</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./order.php">ORDERS</a></li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li>
  </ul>
</header>
<section>
  <h1>Order Form</h1>

   <form method="post" onsubmit="return confirmInsert();">

  <form method="post">
    <label for="order_id">Order ID:</label>
    <input type="number" id="order_id" name="Orders_id" required><br><br>
    <label for="order_date">Order Date:</label>
    <input type="date" id="order_date" name="orderDate" required><br><br>
    <label for="order_status">Order Status:</label>
    <input type="text" id="order_status" name="OrderStatus" required><br><br>
    <label for="order_product">Order Product:</label>
    <input type="text" id="order_product" name="OrderProduct" required><br><br>
    <label for="total_price">Total Price:</label>
    <input type="number" id="total_price" name="TotalPrice" required><br><br>
    <label for="payment_method">Payment Method:</label>
    <input type="text" id="payment_method" name="PaymentMethod" required><br><br>
    <label for="user_id">User ID:</label>
    <input type="number" id="user_id" name="Users_id" required><br><br>

    <input type="submit" name="add" value="Insert">
    <a href="./home.html">Go Back to Home</a>
  </form>
</section>

<?php
// Connection details
include('database_connection.php');
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO orders (Orders_id,  orderDate, OrderStatus, orderProduct, TotalPrice, PaymentMethod, Users_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $Orders_id, $orderDate, $OrderStatus, $OrderProduct, $TotalPrice, $PaymentMethod, $Users_id);
  
    // Set parameters and execute
    $Orders_id = $_POST['Orders_id'];
    $orderDate = $_POST['orderDate'];
    $OrderStatus = $_POST['OrderStatus'];
    $OrderProduct = $_POST['OrderProduct'];
    $TotalPrice = $_POST['TotalPrice'];
    $PaymentMethod = $_POST['PaymentMethod'];
    $Users_id = $_POST['Users_id'];

    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>

<section>
  <center><h2>Table of Order</h2></center>
  <table border="5">
    <tr>
      <th>orders_id</th>
      <th>orderDate</th>
      <th>OrderStatus</th>
      <th>OrderProduct</th>
      <th>TotalPrice</th>
      <th>PaymentMethod</th>
      <th>users_id</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    // Define connection parameters
    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "online_store_management_system";

    // Establish a new connection
    $connection = new mysqli($host, $user, $pass, $database);

    // Check if connection was successful
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Prepare SQL query to retrieve all orders
    $sql = "SELECT * FROM Orders";
    $result = $connection->query($sql);

    // Check if there are any orders
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $Orders_id = $row['Orders_id']; // Fetch the ID
            echo "<tr>
                <td>" . $row['Orders_id'] . "</td>
                <td>" . $row['orderDate'] . "</td>
                <td>" . $row['OrderStatus'] . "</td>
                <td>" . $row['OrderProduct'] . "</td>
                <td>" . $row['TotalPrice'] . "</td>
                <td>" . $row['PaymentMethod'] . "</td>
                <td>" . $row['Users_id'] . "</td>
                <td><a style='padding:4px' href='delete_order.php?Orders_id=$Orders_id'>Delete</a></td> 
                <td><a style='padding:4px' href='update_order.php?Orders_id=$Orders_id'>Update</a></td> 
            </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No data found</td></tr>";
    }
    // Close the database connection
    $connection->close();
    ?>
  </table>
</section>

<footer>
  <center><b><h2>UR CBE BIT &copy; 2024 &reg; Designed by: @Yvonne Imaniragena</h2></b></center>
</footer>

</body>
</html>
