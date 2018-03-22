<?php
include 'controls/auth.php';

$con = new Auth();
$message = '';
	if(isset($_POST['register'])) {
		$con->register($_POST['username'],md5($_POST['password']), md5($_POST['confirm_password']) );
	}
?>
<?php include 'header.php'; ?>
	<div class="container-fluid">
		<div class="row ">
			<div class="col-4">
				<form method="POST" role="form">
					<span>Username: </span>
					<input type="text" class="form-control" name="username"/>
					<span>Password: </span>
					<input type="password" class="form-control" name="password"/>
					<span>Retype Password: </span>
					<input type="password" class="form-control" name="confirm_password"/>
					<hr/>
					<button type="submit" class="btn btn-success" name="register">Register</button>
					<hr/>
					<span>Already have an account? Click here to login.</span>
					<a href="login.php" class="btn btn-primary">Login</a>
					
				</form>
			</div>

		</div>
	</div>
</body>

</html>