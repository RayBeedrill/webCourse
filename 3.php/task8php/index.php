<?php
/*
 *
 * index.php need to create objects get or give data and get results
 *
 */
include('config.php');
include('lib/SearchBot.php');

if($_SERVER['REQUEST_METHOD'] === 'GET' && strlen($_GET['query']) > 0)
{
$query = $_GET['query'];
$query = str_replace(' ', '+', $query);
$search = new SearchBot();
$searchResult = $search->getContentByUrl($query);
unset($search);
}

include('template/index.php');


