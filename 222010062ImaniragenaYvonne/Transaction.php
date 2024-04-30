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
    /* CSS styles */
    a {
      padding: 10px;
      color: white;
      background-color: skyblue;
      text-decoration: none;
      margin-right: 15px;
    }

    a:visited {
      color: purple;
    }

    a:link {
      color: brown; /* Changed to lowercase */
    }

    a:hover {
      background-color: white;
    }

    a:active {
      background-color: red;
    }

    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }

    input.form-control {
      /* Adjusted margin-left value */
      margin-left: 15px;
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

<body style="background-color: orange;">
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
  <h1><u>Transaction Form</u></h1>

  <form method="post" onsubmit="return confirmInsert();">
  <form method="post">
    <label for="Transaction_id">Transaction_id :</label>
    <input type="number" id="Transaction_id" name="Transaction_id"><br><br>
    <label for="PaymentAmount">PaymentAmount:</label>
    <input type="number" id="PaymentAmount" name="PaymentAmount" required><br><br>
    <label for="PaymentDate">PaymentDate :</label>
    <input type="date" id="PaymentDate" name="PaymentDate" required><br><br>
    <label for="PaymentStatus">PaymentStatus:</label>
    <input type="text" id="PaymentStatus" name="PaymentStatus" required><br><br>
    <label for="Orders_id">Orders_id:</label>
    <input type="number" id="Orders_id" name="Orders_id" required><br><br>
    <input type="submit" name="add" value="Insert">
    <a href="./home.html">Go Back to Home</a>
  </form>
</section>

<?php
// PHP code for database insertion

include('database_connection.php');

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $connection->prepare("INSERT INTO Transaction (Transaction_id, PaymentAmount, PaymentDate, PaymentStatus, Orders_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $Transaction_id, $PaymentAmount, $PaymentDate, $PaymentStatus, $Orders_id);

    $Transaction_id = $_POST['Transaction_id'];
    $PaymentAmount = $_POST['PaymentAmount'];
    $PaymentDate = $_POST['PaymentDate'];
    $PaymentStatus = $_POST['PaymentStatus'];
    $Orders_id = $_POST['Orders_id'];

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
  <center><h2>Table of Transaction</h2></center>
  <table border="5">
    <tr>
      <th>Transaction ID</th>
      <th>Payment Amount</th>
      <th>Payment Date</th>
      <th>Payment Status</th>
      <th>Order ID</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "online_store_management_system";

    $connection = new mysqli($host, $user, $pass, $database);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $sql = "SELECT * FROM Transaction";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $trans = $row['Transaction_id'];
            echo "<tr>
                <td>" . $row['Transaction_id'] . "</td>
                <td>" . $row['PaymentAmount'] . "</td>
                <td>" . $row['PaymentDate'] . "</td>
                <td>" . $row['PaymentStatus'] . "</td>
                <td>" . $row['Orders_id'] . "</td>
                <td><a style='padding:4px' href='delete_Transaction.php?Transaction_id=$trans'>Delete</a></td> 
                <td><a style='padding:4px' href='update_Transaction.php?Transaction_id=$trans'>Update</a></td> 
            </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No data found</td></tr>";
    }
    $connection->close();
    ?>
  </table>
</section>

<footer>
  <center><b><h2>UR CBE BIT &copy; 2024 &reg; Designed by: @Yvonne Imaniragena</h2></b></center>
</footer>

</body>
</html>
