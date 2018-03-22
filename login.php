<?php
include 'controls/auth.php';
// session_start(); 
// if (isset($_SESSION['user'])) {
// 	header('Location: main.php'); exit;
// }

$con = new Auth();
$message = '';
if(isset($_POST['login'])) {
	$message = $con->login($_POST['username'], $_POST['password']);
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
					<hr/>
					<button type="submit" class="btn btn-success" name="login">Login</button>
					<hr/>
					<span>Don't have account yet? Click here to Register.</span>
					<a href="register.php" class="btn btn-primary">Register</a>
				</form>
			</div>

		</div>
	</div>

	<?php if($message): ?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
		  <strong>Message:</strong> <?= $message; ?>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	<?php endif; ?>
</body>

</html>