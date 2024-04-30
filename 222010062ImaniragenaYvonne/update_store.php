<?php
// Connection details
include('database_connection.php');

// Check if Store_id is set
if(isset($_REQUEST['Store_id'])) {
    $Store_id = $_REQUEST['Store_id'];
    
    $stmt = $connection->prepare("SELECT * FROM store WHERE Store_id=?");
    $stmt->bind_param("i", $Store_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Store_id'];
        $y = $row['Storename'];
        $z = $row['Contactinformation']; // Corrected column name
        $w = $row['Storedescription'];
    } else {
        echo "Store not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update store</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update products form -->
    <h2><u>Update Form of store</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="storename">Storename:</label>
        <input type="text" name="Storename" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <label for="ContactInformation">Contactinformation:</label>
        <input type="text" name="Contactinformation" value="<?php echo isset($z) ? $z : ''; ?>"> <!-- Changed input type to text -->
        <br><br>

        <label for="sdescription">Storedescription:</label>
        <input type="text" name="Storedescription" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <input type="hidden" name="Store_id" value="<?php echo $Store_id; ?>"> <!-- Added hidden input for Store_id -->
        <input type="submit" name="up" value="Update">
    </form>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Storename = $_POST['Storename'];
    $ContactInformation = $_POST['Contactinformation'];
    $Storedescription = $_POST['Storedescription'];
    
    // Update the store in the database
    $stmt = $connection->prepare("UPDATE store SET Storename=?, Contactinformation=?, Storedescription=? WHERE Store_id=?");
    $stmt->bind_param("sssi", $Storename, $Contactinformation, $Storedescription, $Store_id);
    $stmt->execute();
    
    // Redirect to store.php
    header('Location: store.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
</body>
</html>
