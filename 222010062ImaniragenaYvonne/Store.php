<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Store</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: orange;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: orange;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */

      padding: 8px;
     
    }
    section{
    padding:71px;
    border-bottom: 1px solid #ddd;
    }
    footer{
    text-align: center;
    padding: 15px;
    background-color:darkgray;
    }

  </style>

  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
  </head>

  <header>

<body bgcolor="skyblue">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./Images/store.AVIF" width="90" height="60" alt="Logo">
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./product.php">PRODUCT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./store.php">STORE</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./transaction.php">TRANSACTION</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Users.php">USER</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./order.php">ORDERS</a>
  </li>
    
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>

 <h1><u>Store Form</u></h1>

 <form method="post" onsubmit="return confirmInsert();">
    <form method="post">
        
        <label for="">Store_id:</label>
        <input type="number" id="Store_id" name="Store_id" required><br><br>

        <label for="Storename">Storename:</label>
        <input type="text" id="Storename" name="Storename" required><br><br>

        <label for="Contactinformation">Contactinformation:</label>
        <input type="text" id="Contactinformation" name="Contactinformation" required><br><br>
        
        <label for="Storedescription">Storedescription:</label>
        <input type="text" id="Storedescription" name="Storedescription" required><br><br>

        <input type="submit" name="add" value="Insert">
        <a href="./home.html">Go Back to Home</a>
    </form>
    <?php
// Connection details

    include('database_connection.php');

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO Store (Store_id, Storename, Contactinformation, Storedescription) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $Store_id, $Storename, $Contactinformation, $Storedescription);
    // Set parameters and execute
    $Store_id = $_POST['Store_id'];
    $Storename = $_POST['Storename'];
    $Contactinformation = $_POST['Contactinformation'];
    $Storedescription = $_POST['Storedescription'];

    if ($stmt->execute() === TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>

<?php
// Connection details
$host = "localhost";
$user = "root";
$pass = "";
$database = "online_store_management_system";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
// SQL query to fetch data from the Product table
$sql = "SELECT * FROM Store";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Information of Store</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Table of Store Information</h2>
    <table>
        <tr>
            <th>Store_id</th>
            <th>Storename</th>
            <th>Contactinformation</th>
            <th>Storedescription</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Define connection parameters
        $host = "localhost";
        $user = "root";
        $pass = "";
        $database = "online_store_management_system";

        // Establish a new connection
        $connection = new mysqli($host, $user, $pass, $database);

        // Check if connection was successful
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Prepare SQL query to retrieve all stores
        $sql = "SELECT * FROM Store";
        $result = $connection->query($sql);

       if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $Store_id = $row['Store_id'];
            echo "<tr>
                <td>" . $row['Store_id'] . "</td>
                <td>" . $row['Storename'] . "</td>
                <td>" . $row['Storedescription'] . "</td>
                <td>" . $row['Storedescription'] . "</td>

                <td><a style='padding:4px' href='delete_Store.php?Store_id=$Store_id'>Delete</a></td> 
                <td><a style='padding:4px' href='update_Store.php?Store_id=$Store_id'>Update</a></td> 
            </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
</body>

    </section>


  
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by: @Yvonne Imaniragena</h2></b>
  </center>
</footer>
</body>
</html>