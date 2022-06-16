<?php
require_once "config.php";
// Starting the session, to use and
// store data in session variable
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
date_default_timezone_set('Asia/Kolkata'); 
$stringer = $_SESSION['username'];
$query = "SELECT * from attendance2 WHERE username = '$stringer' and logger = '0'";
$result = mysqli_query($link,$query);
if(mysqli_num_rows($result) > 0){
    $button_status = 0;
    
}
else{
    $button_status = 1;
}


//echo $button_status;

if(isset($_POST['clocker'])){
    echo $_SESSION['username'];
    $name = $_SESSION['username'];
    $query = "INSERT INTO attendance2 (username) VALUES('$name')";
    //$button_status = 0;
    if(mysqli_query($link,$query)){
        echo "inserted success";
        echo '<script type="text/javascript">';
        echo ' alert("JavaScript Alert Box by PHP")'; 
        //echo 'location.reload()';//not showing an alert box.
        echo '</script>';
        //$button_status = 0;

        if($_SESSION['role'] == 'admin'){
            header('location: index.php');
        }
        else if($_SESSION['role'] == 'user'){
            header('location: index-user.php');
        }
        else{
            header('location: index-staff.php');
        }
        //header("Refresh:0");
        
    }
    else{
        echo"error";
        echo mysqli_error($link);
    }
}

if(isset($_POST['clocker2'])){
    echo $_SESSION['username'];
    $name = $_SESSION['username'];
    $date = date("Y-m-d H:i:s");
    echo $date;
    $tempstring = strval($date);
    $query = "UPDATE attendance2 SET clockout='$tempstring', logger = '1' WHERE username='$name' and logger = '0'";
    
   // $button_status = 1;
    if(mysqli_query($link,$query)){
        echo "inserted success";
        echo '<script type="text/javascript">';
        echo ' alert("JavaScript Alert Box by PHP")'; 
        //echo 'location.reload()';//not showing an alert box.
        echo '</script>';
        //$button_status = 1;
        if($_SESSION['role'] == 'admin'){
            header('location: index.php');
        }
        else if($_SESSION['role'] == 'user'){
            header('location: index-user.php');
        }
        else{
            header('location: index-staff.php');
        }
        
        //header("Refresh:0");
        
    }
    else{
        echo"error";
        echo mysqli_error($link);
    }
}



?>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  
  
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="popper/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"><link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
<link rel="stylesheet" href="fonts/google.css">
<link rel="stylesheet" href="fonts/clock.css">
<link rel="stylesheet" href="fonts/font-awesome.min.css">

<script>
    
</script>
</head>

<body>
<div class="container-fluid rounded">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark border">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="index-staff.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Home</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="index-staff.php" class="nav-link align-middle px-0 ">
                             <span class="ms-1 d-none d-sm-inline color-light">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="timeclock.php" class="nav-link px-0 align-middle link-warning active">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Clock IN----</span></a>
                    </li>
                    <li>
                        <a href="more/bookingread.php" class="nav-link px-0 align-middle link-warning">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Bookings</span></a>
                    </li>
                    <li>
                        <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle link-warning">
                            <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">Staff</span></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="more/staffcrud-staff.php" class="nav-link px-0"> <span class="d-none d-sm-inline">TableInfo</span></a>
                            </li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle link-warning">
                            <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Inventory</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="more/invcrud-staff.php" class="nav-link px-0"> <span class="d-none d-sm-inline">TableInfo</span></a>
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
                        
                        
                       
                        <li><a class="dropdown-item" href="unset.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col py-3 ">
          <div class="container">

            <div id="DigitalCLOCK" class="clock" onload="showTime()"></div>
            
            <script  src="function.js"></script>
            <form action="timeclock.php" method ="POST">
                <input type="submit" class = "clockin" <?php if ($button_status == 0){ ?> disabled <?php   } ?> value = "Clock in" name = "clocker">
                <input type="submit" class = "clockout" <?php if ($button_status == 1){ ?> disabled <?php   } ?> value = "Clock out" name = "clocker2">
                

                
            </form>
        
        </div>
     
        </div>
    </div>
</div>


</body>



</html>
<?php
    /*require_once "config.php";
    if(isset($_POST['clocker'])){
        echo $_SESSION['username'];
        $name = $_SESSION['username'];
        $query = "INSERT INTO attendance (username) VALUES('$name')";
        $button_status = 0;
        if(mysqli_query($link,$query)){
            echo "inserted success";
            echo '<script type="text/javascript">';
            echo ' alert("JavaScript Alert Box by PHP")'; 
            //echo 'location.reload()';//not showing an alert box.
            echo '</script>';
            $button_status = 0;

            //header('location: index.php');
            //header("Refresh:0");
            
        }
        else{
            echo"error";
            echo mysqli_error($link);
        }
    }*/

    /*$query = "SELECT * from attendance";
    $result = mysqli_query($link,$query);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        echo"in2";
        $button_status = 0;
        while($row = mysqli_fetch_assoc($result)) {
            $temp = $row['username'];
            echo "username: ".$temp;
            if($temp = $_SESSION['username'])
            {
                $button_status = 0;//not active
            }
            else{
                $button_status = 1;//active
            }
            
        }
       // header('location: home.php');
        echo $button_status;
    } 
    else{
        $button_status = 1;
    }
*/
?>
