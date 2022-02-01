<?php

if (isset($_POST['idcard'])) {
    include "./db_connection.php";
    include "./db_operations/db_basic_functions.php";
    // get inputs
    $idnumber = $conn->real_escape_string($_POST['idcard']);
    $fname = $conn->real_escape_string($_POST['fname']);
    $lname = $conn->real_escape_string($_POST['lname']);

    $data = array("idnumber" => $idnumber, "fname" => $fname, "lname" => $lname);

    $res = DB::insertIntoDb("coaches", $data, $conn);

    if ($res['result'] === true) {
        echo "success";
    } else {
        echo $res['errorMessage'];
    }
}
