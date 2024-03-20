<?php
include '../db.php';

$db = new Database("127.0.0.1", "urls", "root", "");
$db = $db->connect();

$id = $_GET['o'];

$query = "SELECT * FROM short WHERE ID = :ID LIMIT 1";
$stmt = $db->prepare($query);

$params = array(
    "ID" => $id
);

$stmt->execute($params);

$url = $stmt->fetch();

header("location: " . $url['long_url']);
