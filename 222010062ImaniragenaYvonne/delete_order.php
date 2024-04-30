<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <script>
        function confirmDelete(Orders_id) {
            var confirmation = confirm("Are you sure you want to delete this record?");
            if (confirmation) {
                // Send AJAX request to delete record
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // If deletion is successful, redirect to order.php
                            window.location.href = "order.php";
                        } else {
                            // If there's an error, display error message
                            alert("Error deleting data: " + xhr.responseText);
                        }
                    }
                };
                xhr.open("POST", "delete_order.php", true); // Change "delete_order.php" to match your PHP delete script
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("Orders_id=" + Orders_id);
            }
            return false; // Prevent form submission
        }
    </script>
</head>
<body>
<?php
// Connection details
include('database_connection.php');

// Check if Orders_id is set
if(isset($_REQUEST['Orders_id'])) {
    $Orders_id = $_REQUEST['Orders_id'];
?>
    <form method="post" onsubmit="return confirmDelete(<?php echo $Orders_id; ?>);">
        <input type="submit" value="Delete">
    </form>
<?php
} else {
    echo "Orders_id is not set.";
}
?>
</body>
</html>
