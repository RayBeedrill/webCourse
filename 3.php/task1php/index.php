<?php
include('config.php');
include('lib/functions.php');


if($_SERVER['REQUEST_METHOD'] === 'GET'){
$errDel = deleteFile();
}

$errDown = uploadFile();

$data = showDir();
include('template/index.php');
