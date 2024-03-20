<?php

include '../db.php';

$db = new Database("127.0.0.1", "urls", "root", "");
$db = $db->connect();

$url = $_POST['long_url'];

$query = "INSERT INTO short (long_url) VALUES (:long_url)";
$stmt = $db->prepare($query);
$params = array(
"long_url" => $url
);
$stmt->execute($params);
$result = $db->lastInsertId();

echo json_encode($result);