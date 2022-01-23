<?php
session_start();
// condition to make sure the login request was made
if (isset($_POST["email"])) {

    // import required files
    require $_SERVER["DOCUMENT_ROOT"] . "admin/backend/db_connection.php";
    include $_SERVER["DOCUMENT_ROOT"] . "admin/dependencies.php";
    include $_SERVER["DOCUMENT_ROOT"] . "admin/backend/db_operations/db_basic_functions.php";

    /** Email address entered by the user through the form */
    $email = $conn->real_escape_string($_POST['email']);

    /** Password obtained through the form */
    $password = $conn->real_escape_string($_POST['password']);

    $result = array();

    $url = URL;
    $user_type = "";
    $sql_coach = "SELECT coaches.email, coaches.status, coaches.coach_id, system_users.user_id, system_users.user_type, system_users.password 
                    from coaches inner join system_users on (coaches.coach_id = system_users.user_id) 
                where system_users.password = '$password' AND coaches.email = '$email'
    ";
    $sql_admin = "SELECT administrator.email, administrator.status, administrator.admin_id, 
                system_users.user_id, system_users.user_type, system_users.password 
                from administrator inner join system_users on (administrator.admin_id = system_users.user_id) 
                where system_users.password = '$password' AND administrator.email = '$email'
                ";

    $result_coach = DB::selectFromDb($sql_coach, $conn);
    $result_admin = DB::selectFromDb($sql_admin, $conn);

    if ($result_coach === false || $result_admin === false) {
        $result = array("result" => false, "message" => "error: " . $conn->error);
    } else if ($result_coach !== null) {
        $result = array("result" => false, "message" => "error: This user does not have any autholity");
    } else if ($result_admin !== null) {
        // add a session
        $_SESSION["logged_in"] = $result_admin;
        $result = array("result" => true, "message" => "Login success, Redirecting... ", "redirectURL" => URL . "/admin/dashboard.php");
    } else {
        $result = array("result" => false, "message" => "Incorrect email or password");
    }

    echo json_encode($result);

    exit();


    // $sql = "SELECT administrator.email, system_users.password, system_users.user_type,coaches.status, administrator.status 
    // from system_users 
    //     case system_users.user_type
    //         when 'admin'
    //             then JOIN administrator ON (administrator.admin_id=system_users.user_id) 
    //         when 'coach'
    //             then JOIN coaches ON (coaches.coach_id=system_users.user_id) 
    //         end
    //         WHERE system_users.user_id = 1
    // ";

    // $result = DB::selectFromDb($sql, $conn);

    // if ($result === false) {
    //     $result["res"] = false;
    //     $result["message"] = "there was an error: " . $conn->error;
    // } elseif ($result === null) {
    //     $result["res"] = false;
    //     $result["message"] =  "wrong password or username";
    // } elseif ($result) {
    //     $result["res"] = true;
    //     $result["message"] = "login success";
    // }
    // echo json_encode($result);
}
