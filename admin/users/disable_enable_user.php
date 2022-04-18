<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
require_once DB_CONNECT;
require_once ROOT . "/admin/DBError.php";
require_once ROOT . "admin/backend/db_operations/classCoach.php";
require_once ROOT . "admin/backend/db_operations/classAdmin.php";

try {
    // var_dump($_REQUEST);
    if (!isset($_POST['action']))
        throw new DBError("invalid request");

    if (!isset($_POST["user_id"]) || empty($_POST["user_id"]) || !isset($_POST["user_type"]) || empty($_POST["user_type"]))
        throw new DBError("some important parameters were not found in your request");

    $user_id = $conn->real_escape_string($_POST["user_id"]);
    $user_type = $conn->real_escape_string($_POST["user_type"]);
    $action = $conn->real_escape_string($_POST["action"]);

    // instantiate the User object
    if ($user_type === "admin")
        $user = new Admin();
    else if ($user_type === "coach")
        $user = new Coach();
    else throw new DBError(_("The user-group specified is not valid"));

    // check whether the user exists
    if ($user->getSingleUserDetails($user_id, $user_type) === NULL)
        throw new DBError(_("this user does not exists in our systems"));

    // write the new user status
    if ($action === "disable")
        $status = "disabled";
    elseif ($action === "enable")
        $status = "active";

    if ($user_type === "admin")
        $result = $user->updateAdmin(array("status" => $status), $user_id);
    elseif ($user_type === "coach")
        $result = $user->updateCoach($user_id, array("status" => $status));

    if ($result) {
        $response = array("result" => true, "message" => _("The user status has been changed to $status"), "status" => $status);
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
