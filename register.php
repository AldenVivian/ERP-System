<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Registration
	</title>
	<link rel="stylesheet" type="text/css" href="style2.css">
	
</head>

<body>
	<div class="header2">
		<h2>Register</h2>
	</div>
	
	<form method="post" action="register.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Enter Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>" pattern ="^[A-Za-z]+$" title="Invalid Username" required/>
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>" title="Invalid Email" title="invalid email" required/>
		</div>
		<div class="input-group">
			<label class="" for="dropform">Role</label>
			<select class="drop-group-sel" name = "role"id="dropform" required>
			<option selected disabled>Choose...</option>
			<option value="admin">Admin</option>
			<option value="server">Server</option>
			<option value="chef">Chef</option>
			<option value="user">User</option>
			
			</select>
  		</div>
    
		<div class="input-group">
			<label>Enter Password</label>
			<input type="password" name="password_1" pattern = "{8}" title="Minimum 8 characters" required/>
		</div>
		<div class="input-group">
			<label>Confirm password</label>
			<input type="password" name="password_2" pattern = "{8}" title="Minimum 8 characters" required/>
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="reg_user">
				Register
			</button>
		</div>
		


<p>
			Already having an account?
			<a href="login.php">
				Login Here!
			</a>
		</p>



	</form>
</body>
</html>
<?php
        if(isset($_POST["reg_user"])){
            echo"in";

            
        }
        ?>
