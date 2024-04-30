<?php
// Connection details
include('database_connection.php');


// Check if Users_id is set
if(isset($_REQUEST['Users_id'])) {
    $Users_id = $_REQUEST['Users_id'];
    
    $stmt = $connection->prepare("SELECT * FROM Users WHERE Users_id=?");
    $stmt->bind_param("i", $Users_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['Username'];
        $z = $row['Password'];
        $w = $row['Email'];
        $x = $row['Phonenumber'];

    } else {
        echo "User not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update users</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update products form -->
    <h2><u>Update Form of users</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="Username">Username:</label>
        <input type="text" name="Username" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="Password">Password:</label>
        <input type="password" name="Password" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="Email">Email:</label>
        <input type="Email" name="Email" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="Phonenumber">Phonenumber:</label>
        <input type="text" name="Phonenumber" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $Email = $_POST['Email'];
    $Phonenumber = $_POST['Phonenumber'];

    // Update the user in the database
    $stmt = $connection->prepare("UPDATE Users SET Username=?, Password=?, Email=?, Phonenumber=? WHERE Users_id=?");
    $stmt->bind_param("ssssi", $Username, $Password, $Email, $Phonenumber, $Users_id);
    $stmt->execute();
    
    // Redirect to Users.php
    header('Location: Users.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
