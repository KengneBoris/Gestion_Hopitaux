<?php
session_start();
include 'securite.php';

session_destroy();
header("location:index.php");

?>