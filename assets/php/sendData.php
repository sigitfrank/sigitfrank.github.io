<?php

if (isset($_POST)) {

    $host = 'localhost';
    $user = 'root';
    $db = 'rps';
    $pw = '';

    $conn = mysqli_connect($host, $user, $pw, $db);
    if ($conn) {
        // echo 'sukses';
    } else {
        echo 'fail';
    }

    $username = $_POST['userame'];

    $query = "INSERT INTO player ('username') VALUES ('$username')";
    $result = mysqli_query($conn, $username);

    if ($result) {
        echo json_encode(['code' => 200]);
        exit;
    } else {
        echo json_encode(['code' => 400]);
        exit;
    }
}
