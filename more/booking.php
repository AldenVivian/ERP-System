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
                        <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline link-warning">Booking</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="booking.php" class="nav-link px-0 active"> <span class="d-none d-sm-inline">&ensp; -Book</span></a>
                            </li>
                            <li class="w-100">
                                <a href="checkbooking.php" class="nav-link px-0"> <span class="d-none d-sm-inline link-warning">&ensp; -Check Book</span></a>
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
          <div class ="container p-5">
          <form class="row row-cols-lg-auto g-3 align-items-center" method="POST">

          <div class="col-8">
            <label class="" for="booking">Booking Name:</label>
            <div class="input-group">
              
              <input type="text" class="form-control" name = "bname"id="booking" pattern = "^[a-zA-Z]+$" title="Invalid Name(Alphanumeric not allowed)" placeholder="Name" required/>
            
            </div>
        </div>
          <div class="col-8">
            <label class="" for="email">Email:</label>
            <div class="input-group">
              <div class="input-group-text">@</div>
              <input type="email" class="form-control" name = "bmail"id="email" placeholder="Email" required/>
            </div>
          </div>
          
          <div class="col-8">
            <label class="" for="mobile">Mobile Number:</label>
            <div class="input-group">
              <div class="input-group-text">#</div>
              <input type="text" class="form-control" name ="bphone"id="mobile" pattern="^[0-9]{10}$" title="Invalid Mobile Number" required/>
            </div>
          </div>
           
          <div class="col-8">
            <label class="" for="date">Date:</label>
            <div class="input-group">
              <div class="input-group-text">^</div>
              <input type="date" class="form-control" name ="bdate"id="date" min="<?= date('Y-m-d'); ?>" required/>
            </div>
          </div>

          <div class="col-8">
            <label class="" for="num">Number:(Persons)</label>
            <div class="input-group">
              <div class="input-group-text">#</div>
              <input type="number" class="form-control" name = "bno" id="num" placeholder="0" required/>
            </div>
          </div>
      
          <div class="col-8">
            <label class="" for="drop">Preference</label>
            <select class="form-select" name = "bpref" id="drop" required>
              <option selected disabled>Choose...</option>
              <option value="breakfast">9am-12pm Breakfast</option>
              <option value="lunch">1pm-5pm Lunch</option>
              <option value="dinner">6p-10p Dinner</option>
            </select>
          </div>

          

          <div class="col-8">
            <input type="submit" name ="bsubmit"class="btn btn-primary">
          </div>
  </form>
          </div>
        </div>
    </div>
</div>
<div class="modal fade" id="thankyouModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Thank you for pre-registering!</h4>
            </div>
            <div class="modal-body">
                <p>Thanks for getting in touch!</p>                     
            </div>    
        </div>
    </div>
</div>
    
        
    </body>
</html>
<?php
  
  
  
  require_once "config.php";
   
  
  
  $name = $mail = $pref= $dates = "";
  $number =0;
  $phone= "";
  $name_err = $mail_err = $phone_err = $number_err = $pref_err =  "";
   
  
  
  if(isset($_POST['bsubmit'])){
      
    
      $input_name = trim($_POST["bname"]);
      if(empty($input_name)){
          $name_err = "Please enter a name.";
      } 
      elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
          $name_err = "Please enter a valid name.";
      } 
      else{
          $name = $input_name;
      }
      
      
      $input_mail = trim($_POST["bmail"]);
      if(empty($input_mail)){
          $mail_err = "Please enter an email.";     
      } else{
          $mail = $input_mail;
      }
      
      
      $input_phone= trim($_POST["bphone"]);
      if(empty($input_phone)){
          $phone_err = "Please enter the phone amount.";     
      } elseif(!ctype_digit($input_phone)){
          $phone_err = "Please enter a positive integer value.";
      } else{
          $phone = $input_phone;
      }
      $number = $_POST['bno'];
      $pref = $_POST['bpref'];
      $dates = $_POST['bdate'];
      $show = 0;
      
      $sql3 = "SELECT * FROM booking WHERE pref = '$pref' AND dates = '$dates'";
      $res = mysqli_query($link,$sql3);
      if($res)
      {
        $cnt_rows = mysqli_num_rows($res);
        if($cnt_rows>=5)
        {
          echo '<script>alert("Max number of bookings reached... Please Try again later with another date or time")</script>';
        }
        else{
          if(empty($name_err) && empty($mail_err) && empty($phone_err)){
          
            $sql = "INSERT INTO booking (name, mail, phone, num, pref, dates) VALUES (?, ?, ?, ?, ?, ?)";
             
            if($stmt = mysqli_prepare($link, $sql)){
               
                mysqli_stmt_bind_param($stmt, "sssiss", $param_name, $param_mail, $param_phone, $param_number, $param_pref, $param_dates);
                
               
                $param_name = $name;
                $param_mail = $mail;
                $param_phone = $phone;
                $param_number = $number;
                $param_pref = $pref;
                $param_dates = $dates;
                
                if(mysqli_stmt_execute($stmt)){
                    
                   $show = 1;
                   echo '<script>alert("Booking has been processed")</script>';
                  
                } else{
                  
                  echo '<script>alert("Oops! Something went wrong. Please try again later.")</script>';
                    
                }
            }
             mysqli_error($link);
           
            mysqli_stmt_close($stmt);
        }
        
        
        mysqli_close($link);
       
    }
   

        }
      }
      
?>