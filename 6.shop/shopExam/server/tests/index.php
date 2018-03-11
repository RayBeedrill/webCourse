<?php
include 'config.php';
require_once 'Autoloader.php';
spl_autoload_register(array('Autoloader', 'loadPackages'));