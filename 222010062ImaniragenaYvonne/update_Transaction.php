<?php
// Connection details
include('database_connection.php');

// Check if Product_Id is set
if(isset($_REQUEST['Transaction_id'])) {
    $Transaction_id = $_REQUEST['Transaction_id'];
    
    $stmt = $connection->prepare("SELECT * FROM Transaction WHERE Transaction_id=?");
    $stmt->bind_param("i", $Transaction_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['PaymentAmount'];
        $z = $row['PaymentDate'];
        $w = $row['PaymentStatus'];
        $y = $row['Orders_id'];
    } else {
        echo "Transaction not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Transaction</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update products form -->
    <h2><u>Update Form of Transaction</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="pamount">PaymentAmount:</label>
        <input type="number" name="PaymentAmount" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="pdate">PaymentDate:</label>
        <input type="date" name="PaymentDate" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="pstatus">PaymentStatus:</label>
        <input type="text" name="PaymentStatus" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="oid">Orders_id:</label>
        <input type="number" name="Orders_id" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $PaymentAmount = $_POST['PaymentAmount'];
    $PaymentDate = $_POST['PaymentDate'];
    $PaymentStatus = $_POST['PaymentStatus'];
    $Orders_id = $_POST['Orders_id'];
    // Update the product in the database
    $stmt = $connection->prepare("UPDATE Transaction SET PaymentAmount=?, PaymentDate=?,  PaymentStatus=?, Orders_id=? WHERE Transaction_id =?");
    $stmt->bind_param("sssss", $PaymentAmount, $PaymentDate, $PaymentStatus, $Orders_id, $Transaction_id);
    $stmt->execute();
    
    // Redirect to product.php
    header('Location: Transaction.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
