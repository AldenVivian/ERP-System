<?php
require_once "config.php";

session_start();


if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You have to log in first";
	header('location: login.php');
}


if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location: login.php");
}

?>
<html>
    <head>
    <script src="popper/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    </head>
  <body>
  <div class="container-fluid rounded">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark border">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="../index-staff.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Home</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="../index-staff.php" class="nav-link align-middle px-0">
                             <span class="ms-1 d-none d-sm-inline color-light">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="../timeclock.php" class="nav-link px-0 align-middle link-warning">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Clock IN----</span></a>
                    </li>
                    <li>
                        <a href="bookingread.php" class="nav-link px-0 align-middle link-warning active">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Bookings</span></a>
                    </li>
                    <li>
                        <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle link-warning">
                            <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">Staff</span></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="staffcrud-staff.php" class="nav-link px-0"> <span class="d-none d-sm-inline">TableInfo</span></a>
                            </li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle link-warning">
                            <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Inventory</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="invcrud-staff.php" class="nav-link px-0"> <span class="d-none d-sm-inline">TableInfo</span></a>
                            </li>
        
                        </ul>
                    </li>
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                       
</svg>
                        <span class="d-none d-sm-inline mx-1"><?php echo $_SESSION['username']; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        
                        
                        
                        <li><a class="dropdown-item" href="unset.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col py-3">
        
        <div class="col-7 container">
                <form class="row-cols-lg-auto g-3 align-items-center" method="post">
                    <div class="mb-3">
                        <label for="phonenumber" class="form-label">Phone Number</label>
                        <input type="number" name = "cphone"class="form-control" id="phonenumber">
                        
                    </div>
                    <input type="submit" name = "checksub" class="btn btn-primary" value = "Check">
                </form>
                <?php
                    // Include config file
                    require_once "config.php";
                    if(isset($_POST['checksub'])){
                    // Attempt select query execution
                    $input_phone= trim($_POST["cphone"]);
                    if(empty($input_phone)){
                        $phone_err = "Please enter the phone amount.";     
                    } elseif(!ctype_digit($input_phone)){
                        $phone_err = "Please enter a positive integer value.";
                    } else{
                        $phone = $input_phone;
                    }
                    $sql = "SELECT * FROM booking WHERE phone = '$phone'";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-info table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        
                                       
                                        echo "<th>Name</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>Phone Number</th>";
                                        echo "<th>Number Of Seats</th>";
                                        echo "<th>Preference</th>";
                                        echo "<th>Date</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                
                                while($row = mysqli_fetch_array($result)){

                                    echo "<tr class = table-active>";
                                        
                                        
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['mail'] . "</td>";
                                        echo "<td>" . $row['phone'] . "</td>";
                                        echo "<td>" . $row['num'] . "</td>";
                                        echo "<td>" . $row['pref'] . "</td>";
                                        echo "<td>" . $row['dates'] . "</td>";
                                            
                                        
                                    echo "</tr>";
                                    
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($link);
                }
                else{
                    $sql = "SELECT * FROM booking";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-info table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        
                                       
                                        echo "<th>Name</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>Phone Number</th>";
                                        echo "<th>Number Of Seats</th>";
                                        echo "<th>Preference</th>";
                                        echo "<th>Date</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                
                                while($row = mysqli_fetch_array($result)){

                                    echo "<tr class = table-active>";
                                        
                                        
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['mail'] . "</td>";
                                        echo "<td>" . $row['phone'] . "</td>";
                                        echo "<td>" . $row['num'] . "</td>";
                                        echo "<td>" . $row['pref'] . "</td>";
                                        echo "<td>" . $row['dates'] . "</td>";
                                            
                                        
                                    echo "</tr>";
                                    
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    }
                }
                    ?>
        </div>
  
          </div>
        </div>
    </div>
</div>    
    </body>
</html>
<?php
  require_once "config.php";
   
  // Define variables and initialize with empty values
  
  $phone= 0;
  
  $phone_err ="";
   
  
  if(isset($_POST['checksub'])){
      // Validate phone
      
     $input_phone= trim($_POST["cphone"]);
      if(empty($input_phone)){
          $phone_err = "Please enter the phone amount.";     
      } elseif(!ctype_digit($input_phone)){
          $phone_err = "Please enter a positive integer value.";
      } else{
          $phone = $input_phone;
      }
       //$phone = $_POST['cphone'];
      
      
      // Check input errors before inserting in database
      if(empty($phone_err)){//empty($phone_err)
          // Prepare an insert statement
          $sql = "SELECT * FROM booking WHERE phone = '$phone'";
           $res = mysqli_query($link,$sql);
          if(mysqli_num_rows($res)>0){
              // Bind variables to the prepared statement as parameters
             while($row = mysqli_fetch_assoc($res)){
                 echo $row['name'];
             }
              
          }
          else{
              echo"no";
            mysqli_error($link);
          }
           
          // Close statement
          
      }
      
      // Close connection
      mysqli_close($link);
     
  }
  
?>