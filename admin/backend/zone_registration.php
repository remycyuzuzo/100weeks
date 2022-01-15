<?php

if (isset($_REQUEST["insert_zone"])) {

    require_once $_SERVER["DOCUMENT_ROOT"] . "admin/dependencies.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "admin/backend/db_connection.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "admin/backend/db_operations/db_basic_functions.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "admin/backend/db_operations/classZone.php";

    $zone_name = isset($_POST['zone_name']) ? $conn->real_escape_string($_POST["zone_name"]) : "";
    $zone_address = isset($_POST['zone_address']) ? $conn->real_escape_string($_POST["zone_address"]) : "";
    $zone_type = VSLA_ZONE_TYPE;

    $zone = new VSLA_zone();
    $data = array('vsla_zone_name' => $zone_name, 'vsla_zone_type' => $zone_type, 'vsla_zone_address' => $zone_address);
    $res = $zone->insertZone($data);

    if ($res === false) {
        echo "error: " . $zone->error;
    } else {
        echo "success";
    }
}
