<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Products</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: darkgray;
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
      background-color: red;
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

<body bgcolor="green">
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

    <h1><u> Product Form </u></h1>
   <form method="post" onsubmit="return confirmInsert();">
            
        <label for="id">ID:</label>
        <input type="number" id="id" name="id"><br><br>

        <label for="name"> Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="description"> Description:</label>
        <input type="text" id="description" name="description" required><br><br>

        <label for="price"> Price:</label>
        <input type="number" id="price" name="price" required><br><br>

        <label for="stockquantity"> Stockquantity:</label>
        <input type="number" id="stockquantity" name="stockquantity" required><br><br>


        <label for="Productimage"> Productimage:</label>
        <input type="text" id="Productimage" name="Productimage" required><br><br>

        <label for="Suppierinformation"> Suppierinformation:</label>
        <input type="text" id="Suppierinformation" name="Suppierinformation" required><br><br>
        

        <input type="submit" name="add" value="Insert">
        <a href="./home.html">Go Back to Home</a>
   </form>


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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO product(Product_id, Name, Description, Price, StockQuantity, ProductImage, SuppierInformation) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $Product_id, $Name, $Description, $Price,$StockQuantity,$ProductImage,$SuppierInformation);

    // Set parameters and execute
    $Product_id= $_POST['id'];
    $Name = $_POST['name'];
    $Description = $_POST['description'];
    $Price = $_POST['price'];
    $StockQuantity = $_POST['stockquantity'];
    $ProductImage= $_POST['Productimage'];
    $SuppierInformation= $_POST['Suppierinformation'];
   
    if ($stmt->execute() == TRUE) {
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
include('database_connection.php');


// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
// SQL query to fetch data from the Product table
$sql = "SELECT * FROM Product";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of Product</title>
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
    <center><h2>Table of Products</h2></center>
    <table border="5">
        <tr>
            <th>id</th>
            <th> Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>stockquantity</th>
            <th> productimage</th>
            <th>suppierinformation</th>
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

        // Prepare SQL query to retrieve all products
        $sql = "SELECT * FROM Product";
        $result = $connection->query($sql);

        // Check if there are any products
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $Product_id = $row['Product_id']; // Fetch the Id
                echo "<tr>
                    <td>" . $row['Product_id'] . "</td>
                    <td>" . $row['Name'] . "</td>
                    <td>" . $row['Description'] . "</td>
                    <td>" . $row['Price'] . "</td>
                    <td>" . $row['StockQuantity'] . "</td>
                    <td>" . $row['ProductImage'] . "</td>
                    <td>" . $row['SuppierInformation'] . "</td>
                
                    <td><a style='padding:4px' href='delete_product.php?Product_id=$Product_id'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_product.php?Product_id=$Product_id'>Update</a></td> 
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

z
  
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by: @Yvonne Imaniragena</h2></b>
  </center>
</footer>
</body>
</html>