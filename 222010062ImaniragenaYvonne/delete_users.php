<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <script>
        function confirmDelete(Users_id) {
            var confirmation = confirm("Are you sure you want to delete this record?");
            if (confirmation) {
                // Send AJAX request to delete record
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // If deletion is successful, reload the page
                            window.location.reload();
                        } else {
                            // If there's an error, display error message
                            alert("Error deleting data: " + xhr.responseText);
                        }
                    }
                };
                xhr.open("POST", "delete_user.php", true); // Change "delete_user.php" to match your PHP delete script
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("Users_id=" + Users_id);
            }
            return false; // Prevent form submission
        }
    </script>
</head>
<body>
<?php
// Connection details
include('database_connection.php');

// Check if Users_id is set
if(isset($_REQUEST['Users_id'])) {
    $Users_id = $_REQUEST['Users_id'];
?>
    <form method="post" onsubmit="return confirmDelete(<?php echo $Users_id; ?>);">
        <input type="submit" value="Delete">
    </form>
<?php
} else {
    echo "Users_id is not set.";
}
?>
</body>
</html>
