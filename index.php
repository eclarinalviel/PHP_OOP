<?php include "action.php"; 
	$con = new Action();
	$message = '';
	$edit_data = '';
	  // print_r($results); exit;
		if(isset($_POST['add']))
		{
			$product_name = $_POST['product_name'];
			$amount = $_POST['amount'];
			$quantity = $_POST['quantity'];
			$alert = $con->add_product($product_name, $amount, $quantity);
			if($alert){ $message = "Successfully Added!"; }
		}

		if(isset($_GET['del_id']))
		{
			$product_id = $_GET['del_id'];
			$alert = $con->delete_product($product_id);
			if($alert){ $message = "Successfully Deleted!"; }
		}

		if(isset($_GET['select_id']))
		{
			$product_id = $_GET['select_id'];
			$results = $con->select_product($product_id);
			$edit_data = mysql_fetch_object($results);
		}

		if(isset($_POST['edit']))
		{
			$product_id = $_POST['edit_id'];
			$product_name = $_POST['product_name'];
			$amount = $_POST['amount'];
			$quantity = $_POST['quantity'];
			$alert = $con->edit_product($product_name, $quantity, $amount, $product_id);
			if($alert){ $message = "Successfully Updated!"; }
		}
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Meta tags here -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title> My Application </title>
	<!-- declarations here -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"/>
	<script type="text/javascript" href="assets/bootstrap/js/bootstrap.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container-fluid">
		<div class="row ">
			<div class="col-4">
				<form method="POST" role="form">
					<span>Product Name: </span>
					<input type="hidden" value="<?php if($edit_data) { echo $edit_data->id; }  ?>" name="edit_id"/>
					<input type="text" class="form-control" name="product_name" value="<?php if($edit_data) { echo $edit_data->product_name; }  ?>"/>
					<span>Amount: </span>
					<input type="text" class="form-control" name="amount" value="<?php if($edit_data) { echo $edit_data->amount; }  ?>"/>
					<span>Quantity: </span>
					<input type="text" class="form-control" name="quantity" value="<?php if($edit_data) { echo $edit_data->quantity; }  ?>"/>
					<hr/>
					<?php if(isset($_GET['select_id'])): ?>
						<button type="submit" class="btn btn-success" name="edit">Update</button>
					<?php else: ?>
						<button type="submit" class="btn btn-primary" name="add">Submit</button>
					<?php endif; ?>
					
				</form>
			</div>

			<div class="col-4">
				<?php 
				$cnt = 0;
				$results = $con->select_all();
				// var_dump($results); exit;
				if(mysql_num_rows($results)): ?>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Product Name</th>
							<th>Amount</th>
							<th>Quantity</th>
						</tr>
					</thead>
					<tbody>
						<?php while($row = mysql_fetch_object($results)): ?>
							<tr>
								<td><?= $row->id; ?></td>
								<td><?= $row->product_name; ?></td>
								<td><?= $row->amount; ?></td>
								<td><?= $row->quantity; ?></td>
								<td>
									<a href="index.php?select_id=<?php echo $row->id; ?>" class="btn btn-sm btn-outline-success">Edit</a>
									<a href="index.php?del_id=<?php echo $row->id; ?>" class="btn btn-sm btn-outline-danger">Delete</a>
								</td>
							</tr>
							<?php $cnt = $cnt +1; ?>
						<?php endwhile;?>
					</tbody>
				</table>
				<?php endif; ?>
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