<?php
// Connection details
include('database_connection.php');

// Check if Orders_id is set
if(isset($_REQUEST['Orders_id'])) {
    $Orders_id = $_REQUEST['Orders_id'];
    
    $stmt = $connection->prepare("SELECT * FROM orders WHERE Orders_id=?");
    $stmt->bind_param("i",$Orders_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['orderDate'];
        $z = $row['OrderStatus'];
        $w = $row['OrderProduct'];
        $o = $row['TotalPrice'];
        $p = $row['PaymentMethod'];
        $q = $row['Users_id'];
    } else {
        echo "Order not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update order</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update products form -->
    <h2><u>Update Form of order</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="odate">OrderDate:</label>
        <input type="date" name="OrderDate" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="ostatus">OrderStatus:</label>
        <input type="text" name="OrderStatus" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="oproduct">OrderProduct:</label>
        <input type="text" name="OrderProduct" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="tprice">TotalPrice:</label>
        <input type="number" name="TotalPrice" value="<?php echo isset($o) ? $o : ''; ?>">
        <br><br>

        <label for="pmethod">PaymentMethod:</label>
        <input type="text" name="PaymentMethod" value="<?php echo isset($p) ? $p : ''; ?>">
        <br><br>

        <label for="uid">Users_id:</label>
        <input type="number" name="Users_id" value="<?php echo isset($q) ? $q : ''; ?>">
        <br><br>
        <input type="hidden" name="Orders_id" value="<?php echo $Orders_id; ?>"> <!-- Add a hidden input field for Orders_id -->
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Orders_id = $_POST['Orders_id'];
    $orderdate = $_POST['OrderDate'];
    $OrderStatus = $_POST['OrderStatus'];
    $OrderProduct = $_POST['OrderProduct'];
    $TotalPrice = $_POST['TotalPrice'];
    $PaymentMethod = $_POST['PaymentMethod'];
    $Users_id = $_POST['Users_id'];
    
    // Update the order in the database
    $stmt = $connection->prepare("UPDATE orders SET orderDate=?, OrderStatus=?, OrderProduct=?, TotalPrice=?, PaymentMethod=?, Users_id=? WHERE Orders_id=?");
    $stmt->bind_param("ssssssi", $orderdate, $OrderStatus, $OrderProduct, $TotalPrice, $PaymentMethod, $Users_id, $Orders_id);
    $stmt->execute();
    
    // Redirect to order.php
    header('Location: order.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
