<?php

class Database
{
    public $con;
    public function __construct(){
    	//$link = mysqli_connect("127.0.0.1", "my_user", "my_password", "my_db");
        $this->con = mysqli_connect("localhost","root","","practice");
        if (!$this->con) {
            echo "Error in Connecting ".mysqli_connect_error();
        }
    }
}

?>