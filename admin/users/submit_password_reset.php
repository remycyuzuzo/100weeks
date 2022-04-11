<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
require_once DB_CONNECT;
require_once ROOT . "/admin/DBError.php";
require_once ROOT . "admin/backend/db_operations/classUser.php";

try {

    if (!isset($_POST['password']) || !isset($_POST['password-retype']))
        throw new DBError("invalid request");

    if (!isset($_POST["user_id"]) || empty($_POST["user_id"]) || empty($_POST["password"]) || empty($_POST["password-retype"]))
        throw new DBError("some important parameters were not found in your request");

    $user_id = $conn->real_escape_string($_POST["user_id"]);
    $password = $conn->real_escape_string($_POST["password"]);
    $password_retype = $conn->real_escape_string($_POST["password-retype"]);
    $user_type = $conn->real_escape_string($_POST["user_type"]);

    if ($password !== $password_retype)
        throw new DBError("both passwords doesn't match");

    // instantiate the User object
    $user = new User();

    // check whether the user exists
    if ($user->getSingleUserInfo($user_id, $user_type) === NULL)
        throw new DBError("this user does not exists in our systems");

    // encrypt the password
    $password = $user->encryptPassword($password);

    // update the password
    $result = $user->updateSystemUser(array("password" => $password), $user_id, $user_type);

    if ($result) {
        $response = array("result" => true, "message" => _("the password has been changed successfully"));
    }
} catch (DBError $e) {
    $response = array("result" => false, "errMessage" => $e->getMessage() . " on line: " . $e->getLine() . "(" . $e->getFile() . ")");
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
