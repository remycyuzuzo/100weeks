<?php
session_start();
class DBError extends Exception
{
}


$response = array();
try {
    if (!isset($_REQUEST['submit_new_coach'])) {
        throw new DBError("invalid request");
    }

    include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
    include_once ROOT . "/admin/backend/db_connection.php";
    require_once ROOT . "admin/backend/db_operations/classCoach.php";


    /** @var string $fname First name */
    $fname = isset($_POST['fname']) ? $conn->real_escape_string($_POST["fname"]) : "";

    /** @var string $lname Last name */
    $lname = isset($_POST['lname']) ? $conn->real_escape_string($_POST["lname"]) : "";

    /** @var string $idcardnumber Identification number */
    $idcardnumber = isset($_POST['idcard']) ? $conn->real_escape_string($_POST["idcard"]) : "";

    /** @var string $telnumber Telephone number */
    $telnumber = isset($_POST['tel']) ? $conn->real_escape_string($_POST["tel"]) : "";

    /** @var string $gender Gender  */
    $gender = isset($_POST["gender"]) ? $conn->real_escape_string($_POST["gender"]) : "";

    /** @var string $email Email address */
    $email = isset($_POST["email"]) ? $conn->real_escape_string($_POST["email"]) : "";

    /** @var string $password - Password */
    $password = isset($_POST["password"]) ? $conn->real_escape_string($_POST["password"]) : "";

    /** @var string $address - Coach address */
    $address = isset($_POST["address"]) ? $conn->real_escape_string($_POST["address"]) : "";

    /** @var array $data an array cntaining all data to be submitted */
    $data = array(
        'id_card_number' => $idcardnumber,
        'fname' => $fname,
        'lname' => $lname,
        "tel_number" => $telnumber,
        "gender" => $gender,
        "email" => $email,
        "address" => $address,
        "status" => "active"
    );

    /** VSLA object */
    $coach = new Coach();

    // register into the database
    $res = $coach->registerNewCoach($data);

    if ($res) {
        // Immediatelly, store this info into the "users table"
        // after registering this user, send an email to set the password or to notify the user
        $response = array("dataStatus" => "success", "message" => "the new coach has been registered successfully");
    } else {
        throw new DBError($coach->getErrors());
    }
} catch (DBError $e) {
    $response = array(
        "dataStatus" => "dbError",
        "errorMessage" => $e->getMessage(),
        "file" => $e->getFile(),
        "line" => $e->getLine(),
        "message" => "something went wrong"
    );
} catch (Exception $e) {
    $response = array(
        "dataStatus" => "error",
        "errorMessage" => $e->getMessage(),
        "file" => $e->getFile(),
        "line" => $e->getLine(),
        "message" => "something went wrong"
    );
} catch (Error $e) {
    $response = array(
        "dataStatus" => "error",
        "errorMessage" => $e->getMessage(),
        "file" => $e->getFile(),
        "line" => $e->getLine(),
        "message" => "something went wrong"
    );
} catch (Exception $e) {
    $response = array(
        "dataStatus" => "error",
        "errorMessage" => $e->getMessage(),
        "file" => $e->getFile(),
        "line" => $e->getLine(),
        "message" => "something went wrong"
    );
} catch (TypeError $e) {
    $response = array(
        "dataStatus" => "error",
        "errorMessage" => $e->getMessage(),
        "file" => $e->getFile(),
        "line" => $e->getLine(),
        "message" => "Type error"
    );
} catch (ParseError $e) {
    $response = array(
        "dataStatus" => "parseError",
        "errorMessage" => $e->getMessage(),
        "file" => $e->getFile(),
        "line" => $e->getLine(),
        "message" => "something went wrong"
    );
}

echo json_encode($response);
