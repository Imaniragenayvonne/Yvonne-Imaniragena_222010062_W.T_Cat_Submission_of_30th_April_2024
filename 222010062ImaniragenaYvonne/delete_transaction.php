<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <script>
        // Function to confirm deletion
        function confirmDelete(Transaction_id) {
            // Display confirmation dialog
            var confirmation = confirm("Are you sure you want to delete this record?");
            // If user confirms, proceed with deletion
            if (confirmation) {
                // Send an AJAX request to delete the record
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // If deletion is successful, redirect to Transaction.php
                            window.location.href = "Transaction.php";
                        } else {
                            // If there's an error, display error message
                            alert("Error deleting data: " + xhr.responseText);
                        }
                    }
                };
                xhr.open("POST", "delete_transaction.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("Transaction_id=" + Transaction_id);
            }
            // Prevent form submission
            return false;
        }
    </script>
</head>
<body>
<?php
// Connection details
include('database_connection.php');

// Check if Transaction_id is set
if(isset($_REQUEST['Transaction_id'])) {
    $Transaction_id = $_REQUEST['Transaction_id'];
    
    // HTML form to confirm deletion
    ?>
    <form method="post" onsubmit="return confirmDelete(<?php echo $Transaction_id; ?>);">
        <input type="submit" value="Delete">
    </form>
<?php
} else {
    echo "Transaction_id is not set.";
}
?>
</body>
</html>
