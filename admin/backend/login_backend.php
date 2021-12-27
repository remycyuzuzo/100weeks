<?php
// condition to make sure the login request was made
if (isset($_POST['email'])) {

    // import required files
    require "./db_connection.php";
    include "../dependencies.php";
    include $_SERVER["DOCUMENT_ROOT"] . "admin/backend/db_operations/db_basic_functions.php";

    /** Email address entered by the user through the form */
    $email = $conn->real_escape_string($_POST['email']);
    /** Password obtained through the form */
    $password = $conn->real_escape_string($_POST['password']);

    $url = URL;

    $sql = "SELECT email, password, user_type,status from  system_users
            INNER JOIN administrator ON (admin_id=user_id) 
            WHERE email='$email' and password = '$password' and status = 'active'";

    $result = DB::selectFromDb($sql, $conn);

    if ($result === false) echo "there was an error: " . $conn->error;
    elseif ($result === null) echo "wrong password or username";
    elseif ($result) {
        echo '<script>window.location = "' . URL . '/admin/dashboard.php"</script>';
    }
}
