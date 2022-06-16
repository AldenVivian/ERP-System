<?php
// Starting the session, to use and
// store data in session variable
session_start();


if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You have to log in first";
	header('location: ../login.php');
}


if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location: ../login.php");
}

require_once "config.php";
 

$name = $price = $quantity = "";
$name_err = $price_err = $quantity_err = "";
 

if(isset($_POST["id"]) && !empty($_POST["id"])){
    
    $id = $_POST["id"];
    
    
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    
    $input_price = trim($_POST["price"]);
    if(empty($input_price)){
        $price_err = "Please enter an price.";     
    } else{
        $price = $input_price;
    }
    
    
    $input_quantity = trim($_POST["quantity"]);
    if(empty($input_quantity)){
        $quantity_err = "Please enter the quantity amount.";     
    } elseif(!ctype_digit($input_quantity)){
        $quantity_err = "Please enter a positive integer value.";
    } else{
        $quantity = $input_quantity;
    }
    $lastupdate = $_SESSION['username'];
    
    if(empty($name_err) && empty($price_err) && empty($quantity_err)){
    
        $sql = "UPDATE inventory SET name=?, price=?, quantity=?, last_updated=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ssssi", $param_name, $param_price, $param_quantity, $param_last, $param_id);
            
            
            $param_name = $name;
            $param_price = $price;
            $param_quantity = $quantity;
            $param_id = $id;
            $param_last = $lastupdate;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: invcrud.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
      
        mysqli_stmt_close($stmt);
    }
    
   
    mysqli_close($link);
} else{
   
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
       
        $id =  trim($_GET["id"]);
        
       
        $sql = "SELECT * FROM inventory WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
           
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            
            $param_id = $id;
            
          
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                   
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    
                    $name = $row["name"];
                    $price = $row["price"];
                    $quantity = $row["quantity"];
                } else{
                    
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
       
        mysqli_stmt_close($stmt);
        
       
        mysqli_close($link);
    }  else{
        
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                        <a href="logger.php" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Log</span></a>
                    </li>
                    <li>
                        <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                            <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">Staff</span></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="staffcrud.php" class="nav-link px-0"> <span class="d-none d-sm-inline">TableInfo</span></a>
                            </li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Inventory</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">TableInfo</span></a>
                            </li>
        
                        </ul>
                    </li>
                    <li>
                        <a href="userinfo.php" class="nav-link px-0 align-middle">
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
                        
                        
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
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
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>price</label>
                            <textarea name="price" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>"><?php echo $price; ?></textarea>
                            <span class="invalid-feedback"><?php echo $price_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>quantity</label>
                            <input type="text" name="quantity" class="form-control <?php echo (!empty($quantity_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $quantity; ?>">
                            <span class="invalid-feedback"><?php echo $quantity_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a class="btn btn-secondary ml-2"onclick="history.back()">Cancel</a>
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