<?php
session_start();
$dbName = 'salikhovar_dvasn';
$mysqli = new mysqli('localhost', 'salikhovar_dvasn', 'rfPcennR6iYvzCY@', 'salikhovar_dvasn');
mysqli_select_db($mysqli, $dbName);