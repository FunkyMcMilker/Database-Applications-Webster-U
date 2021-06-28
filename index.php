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
	
<div>
	<form method="POST">
		<h2>Customer Search</h2>
		<label for="cust_name">Enter Customer Name</label>
		<input type="text" required maxlength="20" name="cust_name">
		<button type="submit" value="Submit">
	</form>
</div>
	
<br>
	
<div class="container">
  <form method="POST">
	  <h2>Input New Customers</h2>
    <div class="form-group">
      <label for="Customer_name">Customer Name</label>
      <input type="text" required min="1" maxlength="20" class="form-control" id="Customer_name" placeholder="Enter New Customer Name" name="Customer_name">
    </div>
    <div class="form-group">
      <label for="s_room">Studio Room</label>
      <input type="number" required maxlength="2" class="form-control" id="s_room" placeholder="Enter Requested Studio Room" name="s_room">
    </div>
    <div class="form-group">
      <label for="Staff_Name">Requested Staff</label>
      <input type="text" class="form-control" id="Staff_name" placeholder="Enter Requested Staff Name" name="Staff_name">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

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
	

  while($row = $result->fetch_assoc()) {
    if($row["c_name = $id"]){
      print('Customer Name' . $row["c_name"].'<br>\n');
    }
  }
	
#php handling  new customer input

if (isset($_POST['Customer_name'])) {
   $Customer_name = $_POST['Customer_name'];
   $s_room = $_POST['s_room'];
   $Staff_name = $_POST['Staff_name'];
   $sql = "insert into Customer (Customer_name,s_room,Staff_name) values (?,?,?)";
   // prepare statement
   $sta = mysqli_prepare($conn, $sql);
   echo $conn->errno;
   mysqli_stmt_bind_param($sta, 'iss', $Customer_name, $s_room, $Staff_name);
   echo $conn->errno;
   $sta->execute();
echo $conn->errno;
echo $sta;
}
	

  $mysqli->close();
?>

</body>
</html>
