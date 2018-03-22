<?php include "controls/action.php"; 
	$con = new Action();
	$message = '';
	$edit_data = '';
	session_start(); 
	if (!isset($_SESSION['user'])) {
		header('Location: login.php'); exit;
	}

	if(isset($_GET['logout']))
	{
		$con->logout();
	}

	if(isset($_POST['add']))
	{
		$message = $con->add_product($_POST['product_name'], $_POST['amount'], $_POST['quantity']);
	}

	if(isset($_GET['del_id']))
	{
		$message = $con->delete_product($_GET['del_id']);
	}

	if(isset($_GET['select_id']))
	{
		$results = $con->select_product($_GET['select_id']);
		$edit_data = mysql_fetch_object($results);
	}

	if(isset($_POST['edit']))
	{
		$message = $con->edit_product($_POST['product_name'], $_POST['quantity'], $_POST['amount'], $_POST['edit_id']);
	}
?>
<?php include 'header.php'; ?>
	<div class="container-fluid">
		<div class="row ">
			<div class="col-12" style="margin-top: 50px; margin-bottom: 50px; text-align: right;">
				<a href="main.php?logout=1">Logout</a>
			</div>
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