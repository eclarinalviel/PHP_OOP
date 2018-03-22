<?php include 'db/connection.php';
class Connect
{
	public function connect()
	{
		mysql_connect("localhost","root");
		mysql_select_db("practice");
	}
	public function setdata($sql)
	{
		mysql_query($sql);
	}
	public function getdata($sql)
	{
		return mysql_query($sql);
	}
	public function delete($sql)
	{
	mysql_query($sql);
	}
}
?>