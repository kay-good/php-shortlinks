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


if (isset($_GET['getlinks'])) {
    $linksAmount = $_GET['getlinks'];

    $query = "SELECT long_url, short_url FROM short LIMIT :linklimit";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':linklimit', $linksAmount, PDO::PARAM_INT);
    
    $stmt->execute();
    
    $results = $stmt->fetchAll();

    echo json_encode($results);
};

if (isset($_GET['getclicks'])) {
    $linksAmount = $_GET['getclicks'];

    $query = "SELECT long_url, clicked FROM short LIMIT :linklimit";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':linklimit', $linksAmount, PDO::PARAM_INT);
    
    $stmt->execute();
    
    $results = $stmt->fetchAll();

    echo json_encode($results);
};
