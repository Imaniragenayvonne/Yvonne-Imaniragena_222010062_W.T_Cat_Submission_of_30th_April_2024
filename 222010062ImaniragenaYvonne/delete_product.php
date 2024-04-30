<?php
// Connection details
include('database_connection.php');
// Check connection


// Check if Product_Id is set
if(isset($_REQUEST['Product_id'])) {
    $Product_id = $_REQUEST['Product_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM product WHERE Product_id=?");
    $stmt->bind_param("i",$Product_id);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="Product_id" value="<?php echo $Product_id; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        //echo "Record deleted successfully.";
         header('Location: product.php');
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
}
?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "id is not set.";
}

$connection->close();
?>
