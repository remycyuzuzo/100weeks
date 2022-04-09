<?php

session_start();
try {
    if (!isset($_REQUEST['update_coach_info'])) {
        throw new DBError("invalid request");
    }

    include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
    include_once DB_CONNECT;
    require_once ROOT . "/admin/backend/db_operations/classCoach.php";

    $response = array();

    /** coach object */
    $coach = new Coach();

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
    $user_id = $conn->real_escape_string($_POST["user-id"]);

    $password = $coach->encryptPassword($password);
    /** @var array $data an array cntaining all data to be submitted */
    $data = array(
        'id_card_number' => $idcardnumber,
        'fname' => $fname,
        'lname' => $lname,
        "tel_number" => $telnumber,
        "gender" => $gender,
        "email" => $email
    );

    // register into the database
    $res = $coach->updateCoach($user_id, $data);

    if ($res) {
        $response = array("result" => true);
    } else {
        throw new DBError($coach->getErrors());
    }
} catch (DBError $e) {
    $response = array("result" => false, "errMessage" => $e->getMessage(), "line: " . $e->getLine() . " File" . $e->getFile());
} catch (Exception $e) {
    $response = array("result" => false, "errMessage" => $e->getMessage() . " on line: " . $e->getLine() . "(" . $e->getFile() . ")");
} catch (Error $e) {
    $response = array("result" => false, "errMessage" => $e->getMessage() . " on line: " . $e->getLine() . "(" . $e->getFile() . ")");
} catch (Exception $e) {
    $response = array("result" => false, "errMessage" => $e->getMessage() . " on line: " . $e->getLine() . "(" . $e->getFile() . ")");
} catch (TypeError $e) {
    $response = array("result" => false, "errMessage" => $e->getMessage() . " on line: " . $e->getLine() . "(" . $e->getFile() . ")");
} catch (ParseError $e) {
    $response = array("result" => false, "errMessage" => $e->getMessage() . " on line: " . $e->getLine() . "(" . $e->getFile() . ")");
}

echo json_encode($response);
