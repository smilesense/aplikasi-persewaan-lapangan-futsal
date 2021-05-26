<?php
session_start();
include "connect_db.php";
unset($_SESSION["id"]);
unset($_SESSION["id_admin"]);
unset($_SESSION["name"]);
header("Location:login_form.php");
?>