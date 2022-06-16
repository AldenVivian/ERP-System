<?php


session_start();


if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You have to log in first";
	header('location: ../login.php');
}


if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="popper/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
<div class="container-fluid rounded">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark border">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="../index.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none" style="pointer-events: none">
                    <span class="fs-5 d-none d-sm-inline">Home</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="../index.php" class="nav-link align-middle px-0">
                             <span class="ms-1 d-none d-sm-inline color-light">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="logger.php" class="nav-link px-0 align-middle link-warning active">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Log</span></a>
                    </li>
                    <li>
                        <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle link-warning">
                            <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">Staff</span></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="staffcrud.php" class="nav-link px-0"> <span class="d-none d-sm-inline">TableInfo</span></a>
                            </li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle link-warning">
                            <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Inventory</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">TableInfo</span></a>
                            </li>
        
                        </ul>
                    </li>
                    <li>
                        <a href="userinfo.php" class="nav-link px-0 align-middle link-warning">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Users</span> </a>
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
        <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Log Details</h2>
                        
                    </div>
                    <?php
                    
                    require_once "config.php";
                    
                    
                    $sql = "SELECT * FROM attendance2";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-warning table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        
                                        echo "<th>sno</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Clock in time</th>";
                                        echo "<th>Clock out time</th>";
                                        
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                $x = 1; 
                                while($row = mysqli_fetch_array($result)){

                                    echo "<tr class='table-active'>";
                                        
                                        echo "<td>" . $x . "</td>";
                                        echo "<td>" . $row['username'] . "</td>";
                                        echo "<td>" . $row['clockin'] . "</td>";
                                        echo "<td>" . $row['clockout'] . "</td>";
                                        
                                            
                                        echo "</td>";
                                    echo "</tr>";
                                    $x = $x+1;
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
                    ?>
                    
                </div>
            </div>        
        </div>
    </div>
        </div>
    </div>
</div>
   
</body>
</html>