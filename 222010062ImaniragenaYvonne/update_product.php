<?php
include('database_connection.php');


// Check if Product_id is set
if(isset($_REQUEST['Product_id'])) {
    $Product_id = $_REQUEST['Product_id'];
    
    $stmt = $connection->prepare("SELECT * FROM product WHERE Product_id=?");
    $stmt->bind_param("i", $Product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['Name'];
        $z = $row['Description'];
        $w = $row['Price'];
        $o = $row['StockQuantity'];
        $p = $row['ProductImage'];
        $q = $row['SuppierInformation'];
    } else {
        echo "Product not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update products</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update products form -->
    <h2><u>Update Form of products</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="pname">Name:</label>
        <input type="text" name="Name" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="pdescription">Description:</label>
        <input type="text" name="Description" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="pprice">Price:</label>
        <input type="number" name="Price" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="qty">StockQuantity:</label>
        <input type="number" name="StockQuantity" value="<?php echo isset($o) ? $o : ''; ?>">
        <br><br>

        <label for="pimage">ProductImage:</label>
        <input type="text" name="ProductImage" value="<?php echo isset($p) ? $p : ''; ?>">
        <br><br>

        <label for="supinfo">SuppierInformation:</label>
        <input type="text" name="SuppierInformation" value="<?php echo isset($q) ? $q : ''; ?>">
        <br><br>
        <input type="hidden" name="Product_id" value="<?php echo isset($Product_id) ? $Product_id : ''; ?>"> <!-- Added hidden input for Product_id -->
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Product_id = $_POST['Product_id']; // Retrieve Product_id
    $Name = $_POST['Name'];
    $Description = $_POST['Description'];
    $Price = $_POST['Price'];
    $StockQuantity = $_POST['StockQuantity'];
    $ProductImage = $_POST['ProductImage'];
    $SuppierInformation = $_POST['SuppierInformation'];
    
    // Update the product in the database
    $stmt = $connection->prepare("UPDATE product SET Name=?, Description=?, Price=?, StockQuantity=?, ProductImage=?, SuppierInformation=? WHERE Product_id=?");
    $stmt->bind_param("ssssssi", $Name, $Description, $Price, $StockQuantity, $ProductImage, $SuppierInformation, $Product_id);
    $stmt->execute();
    
    // Redirect to Product.php
    header('Location: Product.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
