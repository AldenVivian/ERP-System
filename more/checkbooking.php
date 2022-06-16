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
                <a href="../index-user.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Home</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="../index-user.php" class="nav-link align-middle px-0">
                             <span class="ms-1 d-none d-sm-inline color-light">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle link-warning">
                            <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Booking</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="booking.php" class="nav-link px-0"> <span class="d-none d-sm-inline">&ensp; -Book</span></a>
                            </li>
                            <li class="w-100">
                                <a href="checkbooking.php" class="nav-link px-0"> <span class="d-none d-sm-inline">&ensp; -Check Book</span></a>
                            </li>
        
                        </ul>
                    </li>
                    
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
</svg>
                        <span class="d-none d-sm-inline mx-1"><?php echo $_SESSION['username']; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        
                        
                        
                        
                        <li><a class="dropdown-item" href="../unset.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col py-3">
        
        <div class="col-7 container">
                <form class="row-cols-lg-auto g-3 align-items-center" method="post">
                    <div class="mb-3">
                        <label for="phonenumber" class="form-label">Phone Number</label>
                        <input type="text" name = "cphone"class="form-control" id="phonenumber" pattern="^[0-9]{10}$" title="Invalid Mobile Number" required/>
                        
                    </div>
                    <input type="submit" name = "checksub" class="btn btn-primary" value = "Check">
                </form>
                <?php
                    
                    require_once "config.php";
                    if(isset($_POST['checksub'])){
                    
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
                            
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    
                    mysqli_close($link);
                }
                    ?>
        </div>
  
          </div>
        </div>
    </div>
</div>    
    </body>
</html>
