<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <script>
        function confirmDelete(Store_id) {
            var confirmation = confirm("Are you sure you want to delete this record?");
            if (confirmation) {
                // Send AJAX request to delete record
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // If deletion is successful, redirect to store.php
                            window.location.href = "store.php";
                        } else {
                            // If there's an error, display error message
                            alert("Error deleting data: " + xhr.responseText);
                        }
                    }
                };
                xhr.open("POST", "delete_store.php", true); // Change "delete_store.php" to match your PHP delete script
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("Store_id=" + Store_id);
            }
            return false; // Prevent form submission
        }
    </script>
</head>
<body>
<?php
// Connection details
include('database_connection.php');

// Check if Store_id is set
if(isset($_REQUEST['Store_id'])) {
    $Store_id = $_REQUEST['Store_id'];
?>
    <form method="post" onsubmit="return confirmDelete(<?php echo $Store_id; ?>);">
        <input type="submit" value="Delete">
    </form>
<?php
} else {
    echo "Store_id is not set.";
}
?>
</body>
</html>
