<?php
session_start();
if (isset($_REQUEST['beneficiary_insert'])) {
    include_once $_SERVER["DOCUMENT_ROOT"] . "admin/dependencies.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "admin/backend/db_connection.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "admin/backend/db_operations/db_basic_functions.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "admin/backend/db_operations/classBeneficiary.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "admin/backend/class_upload_image.php";

    /** First name */
    $fname = isset($_POST['fname']) ? $conn->real_escape_string($_POST["fname"]) : "";

    /** Last name */
    $lname = isset($_POST['lname']) ? $conn->real_escape_string($_POST["lname"]) : "";

    /** Identification number */
    $idcardnumber = isset($_POST['idcardnumber']) ? $conn->real_escape_string($_POST["idcardnumber"]) : "";

    /** Telephone number */
    $telnumber = isset($_POST['telnumber']) ? $conn->real_escape_string($_POST["telnumber"]) : "";

    /** Gender  */
    $gender = isset($_POST["gender"]) ? $conn->real_escape_string($_POST["gender"]) : "f";

    /** VSLA */
    $vsla_id = isset($_POST["vsla"]) ? $conn->real_escape_string($_POST["vsla"]) : "";

    /** Profile image */
    $image = new UploadImage($_FILES['image']);

    // if ($image["profileimage"]) {
    // Pass a custom name, or it will be auto-generated
    $image_name = $lname . " " . $fname . "_" . uniqid('', true);

    $folderName = $_SERVER["DOCUMENT_ROOT"] . "/images/vsla_$vsla_id/beneficiaries/";
    $image->setName($image_name);

    // pass name (and optional chmod) to create folder for storage
    $image->setLocation($folderName);

    // }


    $data = array('beneficiary_id_card' => $idcardnumber, 'fname' => $fname, 'lname' => $lname, "VSLA_id" => $vsla_id, "tel_number" => $telnumber, "gender" => $gender, "date_joined" => date("Y:m:d"), "date_registered" => date("Y:m:d"), "profile_picture" => $image->getName() . "." . $image->getMime(), "status" => "active");

    /** VSLA object */
    $beneficiary = new Beneficiary($conn);

    // initialize vsla properties
    $beneficiary->set_beneficiary_data($data);

    // register into the database
    $res = $beneficiary->insert_into_db();

    if ($res) {
        $upload = $image->upload();
        if (!$upload) {
            echo $image->getError();
            die();
        }
        if (isset($_POST["return"])) {
            echo '<script>window.location="' . URL . '/admin/beneficiaries/new-beneficiary-form.php/?successfully-added"</script>';
        } else {
            echo '<script>window.location="' . URL . '/admin/beneficiaries/view-beneficiaries.php/?successfully-added"</script>';
        }
    } else {
        $_SESSION["error"] =  $beneficiary->getErrors();
        echo '<script>window.location="' . URL . '/admin/beneficiaries/new-beneficiary-form.php/?error"</script>';
    }
}
