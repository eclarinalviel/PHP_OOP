<?php
session_start(); 
if (isset($_SESSION['user'])) {
	header('Location: main.php'); exit;
} else {
	header('Location: login.php'); exit;
}

