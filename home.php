<?php

include 'config.php';

session_start();

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if logout button has been clicked
if (isset($_POST['logout'])) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session.
    session_destroy();

    // Redirect to login page
    header('location: login.php');
    exit;
}

$sql = "SELECT ID, name, email, password, user_type FROM users";
$result = $conn->query($sql);

echo '<style>
/* Define the default table style */
table {
  width: 100%;
  border-collapse: collapse;
  font-family: Arial, sans-serif;
}

th {
  background-color: #4CAF50;
  color: white;
}

th, td {
  padding: 15px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

tr:hover {
  background-color: #ddd;
}

/* Make the table responsive */
@media screen and (max-width: 600px) {
  table, thead, tbody, th, td, tr {
    display: block;
  }

  thead tr {
    position: absolute;
    top: -9999px;
    left: -9999px;
  }

  tr {
    border: 1px solid #ccc;
  }

  td {
    border: none;
    border-bottom: 1px solid #eee;
    position: relative;
    padding-left: 50%;
  }

  td::before {
    position: absolute;
    top: 6px;
    left: 6px;
    width: 45%;
    padding-right: 10px;
    white-space: nowrap;
    content: attr(data-label);
    font-weight: bold;
  }
}

/* Define the style for the logout button */
button.logout {
  background-color: #4CAF50; /* Green background */
  border: none; /* No border */
  color: white; /* White text */
  padding: 15px 32px; /* Some padding */
  text-align: center; /* Centered text */
  text-decoration: none; /* No underline */
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer; /* Pointer/hand icon on hover */
  transition-duration: 0.4s; /* Transition effect on hover */
}

/* Change the background color on mouse-over (hover) */
button.logout:hover {
  background-color: #45a049;
}
</style>';

if ($result->num_rows > 0) {
  echo "<table><tr><th>ID</th><th>Name</th><th>Email</th><th>Password</th><th>User Type</th></tr>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["ID"]."</td><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["password"]."</td><td>".$row["user_type"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}

// HTML for logout button
echo '<form method="post">
    <button type="submit" name="logout" class="logout">Logout</button>
</form>';

$conn->close();
?>
