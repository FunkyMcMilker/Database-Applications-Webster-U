<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="#">Kaiah's Studio</a></li>
      <li><a href="?page1">Customers</a></li>
      <li><a href="?page2">Rooms</a></li>
      <li><a href="?page2">Staff</a></li>
      <li><a href="?page3">Instruments</a></li>
    </ul>
  </div>
</nav>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
	
	
  $db_host = 'localhost';
  $db_user = 'studio';
  $db_password = 'studio';
  $db_db = 'myStudio';
  $db_port = 8889;

  $mysqli = new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
  );
	
  if ($mysqli->connect_error) {
    echo 'Errno: '.$mysqli->connect_errno;
    echo '<br>';
    echo 'Error: '.$mysqli->connect_error;
    exit();
  }

  echo 'Success: A proper connection to MySQL was made.';
  echo '<br>';
  echo 'Host information: '.$mysqli->host_info;
  echo '<br>';
  echo 'Protocol version: '.$mysqli->protocol_version;


function customers($conn){
	$sql = "SELECT c_name FROM Customer";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
	    echo "Name: " . $row["c_name"];
	  }
	} else {
	  echo "0 results";
	}
}

echo '<h2>Customer Search</h2>';
echo '<form method=\"post\" action=\"$_SERVER[PHP_SELF]\">';
echo 'Enter Customer name : <input type=\"text\" name=\"cust_name\">';
echo '<br/>';
echo '<input type=\"submit\" value=\"Submit\">'; 
echo '</form>'; 

if($_POST['cust_name']) {
  $id = $_POST['cust_name'];
$stmt = $conn->prepare("SELECT * FROM Customer WHERE cust_name = ?");
$ok = $stmt->bind_param("is", $sid, $c_name);
if (!$ok) { 
      die("Bind param error"); 
      }  
      $ok=$stmt->execute();  
      if (!$ok) { 
        die("Exec error"); 
        } 
	$result = $stmt->get_result();
	}
	}

  while($row = $result->fetch_assoc()) {
    if($row["c_name = $id"]){
      print('Customer Name' . $row["c_name"].'<br>\n');
    }
  }

  $mysqli->close();
?>

</body>
</html>
