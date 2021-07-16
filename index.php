<!DOCTYPE html>
<html lang="en">
<head>
  <title>Kaiah's Studio</title>
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
      <a class="navbar-brand" href="?page=homePage">Kaiah's Recording Studio</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="?page=customers">Customers</a></li>
      <li><a href="?page=rooms">Rooms</a></li>
      <li><a href="?page=staff">Staff</a></li>
      <li><a href="?page=gear">Gear</a></li>
      <li><a href="https://github.com/FunkyMcMilker/Database-Applications-Webster-U/wiki">Help</a></li>
    </ul>
  </div>
</nav>

<?php

#database connection

#error_reporting(E_ALL);
#ini_set('display_errors', 1);


  $db_host = 'localhost';
  $db_user = 'studio';
  $db_password = 'studio';
  $db_db = 'myStudio';
  $db_port = 8889;

#functions

function homePage($mysqli){
  $sql = "SELECT * FROM Customer";
  $result = $mysqli->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "Name: " . $row["customer_name"];
    }
  }
  else {
    echo "0 results";
  }
}

function customers($mysqli){
  echo '
  <div>
    <form method="POST">
      <h2>Customer Search</h2>
      <label for="cust_name">Enter Customer Name</label>
      <input type="text" required maxlength="20" name="customer_name">
      <button type="submit" class="btn btn-default">Submit</button>
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

        ';

  #print customer info
	$sql = "SELECT customer_name FROM Customer";
	$result = $mysqli->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
	    echo "Name: " . $row["customer_name"];
	  }
	}
  else {
	  echo "0 results";
	}
  #database functionality

  if($_POST['cust_name']) {
    $id = $_POST['cust_name'];
  $stmt = $mysqli->prepare("SELECT * FROM Customer WHERE customer_name = ?");
  $ok = $stmt->bind_param("is", $id, $customer_name);
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
      if($row["customer_name = $id"]){
        print('Customer Name' . $row["customer_name"].'<br>\n');
      }
    }

  #php handling  new customer input

  if (isset($_POST['Customer_name'])) {
     $Customer_name = $_POST['Customer_name'];
     $s_room = $_POST['s_room'];
     $Staff_name = $_POST['Staff_name'];
     $sql = "insert into Customer (customer_name, studio_id, employee_name) values (?,?,?)";
     // prepare statement
     $sta = mysqli_prepare($mysqli, $sql);
     echo $mysqli->errno;
     mysqli_stmt_bind_param($sta, 'isss', $Customer_name, $s_room, $Staff_name);
     echo $mysqli->errno;
     $sta->execute();
  echo $mysqli->errno;
  echo $sta;
  }

}

function gear($mysqli){
  echo '
  <div>
    <form method="POST">
      <h2>Gear Info</h2>
      <label for="gear_id">Enter Gear ID</label>
      <input type="number" required maxlength="20" name="gear_id">
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
  </div>
  ';

  if($_POST['gear_id']) {
    $id = $_POST['gear_id'];
  $stmt = $mysqli->prepare("SELECT customer_name FROM Customer WHERE instrument_id = ?");
  $stmt1 = $mysqli->prepare("SELECT * FROM Equipment WHERE equipment_id = ?");
  $ok = $stmt->bind_param("is", $id, $instrument_id);
  $ok1 = $stmt1->bind_param("is", $id, $equipment_id);
  if (!$ok) {
        die("Bind param error");
        }
        $ok=$stmt->execute();
        if (!$ok) {
          die("Exec error");
          }
    $result = $stmt->get_result();


    if (!$ok1) {
          die("Bind param error");
          }
          $ok=$stmt1->execute();
          if (!$ok1) {
            die("Exec error");
            }
      $result1 = $stmt1->get_result();

    }

    echo '<h3>Cusomers that have used this : </h3>';
    while($row = $result->fetch_assoc()) {
      if($row["instrument_id = $id"]){
        print('Customers Name : ' . $row["customer_name"].'<br>\n');
      }
    }

    echo '<h3>Gear in Room : </h3>';
    while($row = $result1->fetch_assoc()) {
      if($row["equipment_id = $id"]){
        print('Equipment Name' . $row["equipment_id"].'<br>\n');
      }
    }
}

function rooms($mysqli){
    echo '<h2>Room Info</h2>;
    <div>
      <form method="POST">
        <h2>Room Info</h2>
        <label for="room_id">Enter Room ID</label>
        <input type="number" required maxlength="20" name="room_id">
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
    ';

    if($_POST['room_id']) {
        $id = $_POST['room_id'];
      $stmt = $mysqli->prepare("SELECT customer_name FROM Customer WHERE studio_id = ?");
      $ok = $stmt->bind_param("is", $id, $studio_id);
      $stmt1 = $mysqli->prepare("SELECT equipment_name FROM Equipment WHERE studio_id = ?");
      $ok1 = $stmt->bind_param("is", $id, $studio_id);
      $stmt2 = $mysqli->prepare("SELECT employee_name FROM Employees WHERE studio_id = ?");
      $ok2 = $stmt->bind_param("is", $id, $studio_id);
      if (!$ok) {
            die("Bind param error");
            }
            $ok=$stmt->execute();
            if (!$ok) {
              die("Exec error");
              }
        $result = $stmt->get_result();


    if (!$ok1) {
          die("Bind param error");
          }
          $ok=$stmt->execute();
          if (!$ok) {
            die("Exec error");
            }
      $result1 = $stmt->get_result();


      if (!$ok2) {
            die("Bind param error");
            }
            $ok=$stmt->execute();
            if (!$ok) {
              die("Exec error");
              }
        $result2 = $stmt->get_result();
    }

    echo '<h3>Cusomers that have used this Room : </h3>';
    while($row = $result->fetch_assoc()) {
      if($row["studio_id = $id"]){
        print('Customer Name : ' . $row["customer_name"].'<br>\n');
      }
    }

    echo '<h3>Gear this Room : </h3>';
    while($row = $result1->fetch_assoc()) {
      if($row["studio_id = $id"]){
        print('Gear Name : ' . $row["equipment_name"].'<br>\n');
      }
    }

    echo '<h3>Staff in this Room : </h3>';
    while($row = $result2->fetch_assoc()) {
      if($row["studio_id = $id"]){
        print('Employee Name : ' . $row["employee_name"].'<br>\n');
      }
    }

}


function staff($mysqli){
  echo '
  <div>
    <form method="POST">
      <h2>Staff Info</h2>
      <label for="staff_id">Enter Staff ID</label>
      <input type="number" required maxlength="20" name="room_id">
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
  </div>
  ';

  $sql = "SELECT employee_id FROM Employees";
  $result = $mysqli->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "Name: " . $row["customer_name"];
    }
  }
  else {
    echo "0 results";
  }


  #database functionality

  if($_POST['staff_id']) {
    $id = $_POST['staff_id'];
  $stmt = $mysqli->prepare("SELECT employee_name FROM Employees WHERE employee_id = ?");
  $ok = $stmt->bind_param("is", $sid, $employee_name);
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
      if($row["employee_id = $id"]){
        print('Staff Name' . $row["employee_name"].'<br>\n');
      }
    }


}

//page contraints and display and connection to db

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

$page = $_GET['page'];
if ($page == "homePage" || $page == "") {
  homePage($mysqli);
}
if ($page == "customers") {
    customers($mysqli);
    }
elseif ($page == "rooms") {
    rooms($mysqli);
    }
elseif ($page == "staff") {
    staff($mysqli);
    }
elseif ($page == "gear") {
    gear($mysqli);
    }


  $mysqli->close();
?>

</body>
</html>
