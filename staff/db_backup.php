<?php

/**
 *   Project : "simriti" project-4
 *   File: staff/db_backup.php
 *   Description: save database as data backup in json file
 */

session_start();

# script enforcement

if (!isset($_SESSION['username']) || !isset($_SESSION['user_id']) || !($_SESSION['user_role'] === 1)) {

    header('Location:logout.php');
    exit('ERROR : 404 | NOT FOUND ');
}

# load database connection

require_once("db.php");

$db_tables = ['user', 'categories', 'post'];

$database = [];     // empty

# fetch data from all table every row and each column

foreach ($db_tables as $table) {

    # execute query and get output

    $return_output = mysqli_query($connect, "SELECT * FROM $table");

    # enforce return output is required

    if (!$return_output or (mysqli_num_rows($return_output) === 0)) {

        header('Location:logout.php');
        exit('ERROR : query return output is failed or empty');
    }
    $data_set = [];

    # fetch every row as associative arry

    while ($fetch_data = mysqli_fetch_assoc($return_output)) {

        $data_set[] = $fetch_data;
    }
    $database[$table] = $data_set;
}

# if backup data exist then append new else store

$folder = '../backup/';

# make directory if folder is notexist

if (!file_exists($folder)) {

    mkdir($folder, 0777, true);
}

$source = $folder . 'data.json';

if (file_exists($source)) {

    $exist_data = json_decode(file_get_contents($source), true);

    if (is_array($exist_data)) {

        $new_data = array($exist_data['message'] => $exist_data['data']);

        unset($exist_data['status']);
        unset($exist_data['message']);

        $exist_data = array_merge($exist_data, $new_data);
    }
    $new_backup = array(
        'status' => 1,
        'message' => date('Y-m-d-H-i-s') . '_' . $_SESSION['username'],
        'data' => $database
    );

    $data = json_encode(array_merge(
        $new_backup, 
        $exist_data
    ), JSON_PRETTY_PRINT);

} else {
    
    # backup data is set

    $data = json_encode(array(
        'status' => 1,
        'message' => date('Y-m-d-H-i-s') . '_' . $_SESSION['username'],
        'data' => $database
    ), JSON_PRETTY_PRINT);
}

# save data as source in json file

if (file_put_contents($source, $data)) {

    mysqli_close($connect);
}
include('../main.php');

header('Location:'.BASE_URL);

exit('backup store successfully!');

/* Developer: Mayank Devil | https://mayankdevil.github.io/MayankDevil */

?>