<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "admin/dependencies.php");

class User
{

    public static function getCurrentUser()
    {
        include_once DB_CONNECT;

        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $sqlQuery = "SELECT email, password, user_type,status from  system_users
                    LEFT JOIN administrator ON (admin_id=user_id) 
                    LEFT JOIN coaches ON (coach_id=user_id)
                    WHERE user_id = $userId";

        $result = DB::selectFromDb($sqlQuery, $conn);

        if ($result === false) echo "there was an error: " . $conn->error;
        elseif ($result === null) echo "wrong password or username";
        elseif ($result) {
            echo '<script>window.location = "' . URL . '/admin/dashboard.php"</script>';
        }
    }
}
