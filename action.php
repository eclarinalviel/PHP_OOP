<?php include_once "dbcrud.php";

class Action extends Connect {
	// public function __construct()
	// {
	// 	$con = new Connect();
	// }
	public function select_all(){
		$con = new Connect();
		$res = $con->getdata("SELECT * FROM tbl_products");
		return $res;

	}

	public function select_product($product_id){
		$con = new Connect();
		$res = $con->getdata("SELECT * FROM tbl_products WHERE id='$product_id'");
		return $res;

	}
	public function add_product($product_name, $quantity, $amount){
		$result = mysql_query("INSERT INTO tbl_products(product_name,quantity,amount) VALUES('$product_name','$quantity','$amount')");
		return $result;
	}
	public function edit_product($product_name, $quantity, $amount, $product_id){
		$result = mysql_query("UPDATE tbl_products SET product_name='$product_name',quantity='$quantity',amount='$amount' WHERE id='$product_id'");
		return $result;
	}
	public function delete_product($product_id){
		$result = mysql_query("DELETE FROM tbl_products WHERE id='$product_id'");
		return $result;
	}
}
