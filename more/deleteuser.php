<?php
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

if(isset($_POST["id"]) && !empty($_POST["id"])){
    
    require_once "config.php";
    
    
    $sql = "DELETE FROM users WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        
        $param_id = trim($_POST["id"]);
        
        
        if(mysqli_stmt_execute($stmt)){
            
            header("location: userinfo.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    
    mysqli_stmt_close($stmt);
    
  
    mysqli_close($link);
} else{
    
    if(empty(trim($_GET["id"]))){
       
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Record</title>
    <script src="popper/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="container-fluid rounded">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark border">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="index.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Home</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link align-middle px-0">
                             <span class="ms-1 d-none d-sm-inline color-light">Home</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="#timeread.php" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline link-warning">Clock IN----</span></a>
                    </li>
                    <li>
                        <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle link-warning">
                            <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">Staff</span></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="more/staffcrud.php" class="nav-link px-0"> <span class="d-none d-sm-inline">TableInfo</span></a>
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
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline link-warning">Users</span> </a>
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
                    <h2 class="mt-5 mb-3">Delete Record</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Are you sure you want to delete this user record?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a class="btn btn-secondary" onclick="history.back()">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
        </div>
    </div>
</div>
   
</body>
</html>