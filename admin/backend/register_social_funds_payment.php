<?php
// ALL SCRIPTS TO REGISTER SOCIAL FUNDS INTO THE DATABASE

if (isset($_POST["registering_social_funds"])) {
    // include required scripts
    require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
    require_once DB_CONNECT;
    require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/db_operations/db_basic_functions.php";

    // get POST data    
    /** The week */
    $week = isset($_POST['week']) ? $conn->real_escape_string($_POST["week"]) : "";

    /** Amount of money being saved */
    $amount = isset($_POST['amount']) ? $conn->real_escape_string($_POST["amount"]) : "";

    /** Beneficiary ID */
    $beneficiary_id = isset($_POST['beneficiary_id']) ? $conn->real_escape_string($_POST["beneficiary_id"]) : "";

    /** User ID */
    $user_id = isset($_POST['user_id']) ? $conn->real_escape_string($_POST["user_id"]) : "";

    $data = array("week" => $week, "amount" => $amount, "beneficiary_id" => $beneficiary_id);

    try {
        $res = DB::insertIntoDb("social_funds_records", $data, $conn);

        if ($res["result"] === false) {
            $response = array("dataStatus" => "error", "error" => $res["errorMessage"]);
        } else {
            $response = array("dataStatus" => "success", "message" => "social funds registered successfully");
        }
    } catch (Error $th) {
        $response = array("dataStatus" => "error", "error" => $th->getMessage());
    } catch (ParseError $e) {
        array("dataStatus" => "error", "error" => $th->getMessage());
    }

    echo json_encode($response);
} else {
    echo json_encode(array("dataStatus" => "error", "error" => "you don't have permission"));
}
