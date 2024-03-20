<?php
include '../db.php';

$db = new Database("127.0.0.1", "urls", "root", "");
$db = $db->connect();

if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']) ) {
    $username = $_SERVER['PHP_AUTH_USER'];
    $password = $_SERVER['PHP_AUTH_PW'];

    $queryForVal = "SELECT id FROM users WHERE username = :username AND password = :password";

    $stmtForVal = $db->prepare($queryForVal);

    $params = array(
        "username" => $username,
        "password" => $password,
    );

    $stmtForVal->execute($params);

    $user = $stmtForVal->fetch();

    if (!$user) {
        echo "no access";
        exit();
    }
} else {
    echo "no access";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $link = $_GET['link'];

    $query = "SELECT * FROM short WHERE ID = :ID LIMIT 1";
    $stmt = $db->prepare($query);

    $params = array(
        "ID" => $link
    );

    $stmt->execute($params);

    $url = $stmt->fetch();

    echo json_encode($url);
}

elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $linkID = $_GET['link'];
    $linkLong = $_GET['to'];

    $query = "UPDATE short SET long_url = :long_url WHERE ID = :ID ";
    $stmt = $db->prepare($query);

    $params = array(
        "ID" => $linkID,
        "long_url" => $linkLong,
    );

    $stmt->execute($params);

    echo "updated";
}

elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $link = $_GET['link'];

    $query = "DELETE FROM short WHERE ID = :ID LIMIT 1";
    $stmt = $db->prepare($query);

    $params = array(
        "ID" => $link
    );

    $stmt->execute($params);

    echo "deleted";
}