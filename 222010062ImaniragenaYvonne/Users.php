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
      background-color: skyblue;
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
      margin-left: 15px; /* Adjust this value as needed */
      padding: 8px;
    }
    section {
      padding: 71px;
      border-bottom: 1px solid #ddd;
    }
    footer {
      text-align: center;
      padding: 15px;
      background-color: darkgray;
    }

  </style>

  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
</head>
<body bgcolor="berge">
  <header>
    <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    <ul style="list-style-type: none; padding: 0;">
      <li style="display: inline; margin-right: 10px;">
        <img src="./Images/store.AVIF" width="90" height="60" alt="Logo">
      </li>
      <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./product.php">PRODUCT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./store.php">STORE</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./transaction.php">TRANSACTION</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./Users.php">USER</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./order.php">ORDERS</a></li>
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
    <h1><u> Users Form </u></h1>

    <form method="post" onsubmit="return confirmInsert();">
    <form method="post">
      <label for="Users_id">Users_id :</label>
      <input type="number" id="Users_id" name="Users_id"><br><br>

      <label for="Username"> Username:</label>
      <input type="text" id="Username" name="Username" required><br><br>

      <label for="Password"> Password:</label>
      <input type="password" id="Password" name="Password" required><br><br>

      <label for="Email"> Email:</label>
      <input type="email" id="Email" name="Email" required><br><br>

      <label for="Phonenumber">Phonenumber:</label>
      <input type="tel" id="Phonenumber" name="Phonenumber" required><br><br>

      <input type="submit" name="add" value="Insert">
      <a href="home.html">Go Back to Home</a>
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
        $stmt = $connection->prepare("INSERT INTO users(Users_id, Username, Password, Email, Phonenumber) VALUES (?,?,?,?,?)");
        $stmt->bind_param("issss", $Users_id, $Username, $Password, $Email, $Phonenumber);

        // Set parameters and execute
        $Users_id = $_POST['Users_id'];
        $Username = $_POST['Username'];
        $Password = $_POST['Password'];
        $Email = $_POST['Email'];
        $Phonenumber = $_POST['Phonenumber'];

        if ($stmt->execute()) {
            echo "New record has been added successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    $connection->close();
    ?>

    <center><h2>Table of Users</h2></center>
    <table border="5">
        <tr>
            <th>Users_id</th>
            <th>Username</th>
            <th>Password</th>
            <th>Email</th>
            <th>Phonenumber</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
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

        // Prepare SQL query to retrieve all users
        $sql = "SELECT * FROM Users";
        $result = $connection->query($sql);

        // Check if there are any users
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $Users_id = $row['Users_id']; // Fetch the Id
                echo "<tr>
                    <td>" . $row['Users_id'] . "</td>
                    <td>" . $row['Username'] . "</td>
                    <td>" . $row['Password'] . "</td>
                    <td>" . $row['Email'] . "</td>
                    <td>" . $row['Phonenumber'] . "</td>
                    <td><a style='padding:4px' href='delete_Users.php?Users_id=$Users_id'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_Users.php?Users_id=$Users_id'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
  </section>

  <footer>
    <center> 
      <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by: @Yvonne Imaniragena</h2></b>
    </center>
  </footer>
</body>
</html>
