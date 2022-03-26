<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/db_operations/classAdmin.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/db_operations/classCoach.php";

class User
{

    protected $conn;
    protected $db;
    protected $errors = "";
    private $result;

    public function __construct()
    {
        require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
        require DB_CONNECT;
        require_once ROOT . "admin/backend/db_operations/db_basic_functions.php";

        $this->conn = $conn;
        $this->db = new DB();
    }

    public function registerSystemUser(array $user_data)
    {
        $this->result = $this->db::insertIntoDb("system_users", $user_data, $this->conn);
        if ($this->result["result"]) {
            return true;
        } else {
            throw new DBError($this->result["errorMessage"]);
            return false;
        }
    }


    public function encryptPassword(string $password)
    {
        $password = ($password != "") ? md5($password) : "";
        return $password;
    }

    public function getSingleUserInfo(int $user_id)
    {
        $sql = "SELECT * from system_users where coach_id = $user_id ";

        $result = $this->db::selectFromDb($sql, $this->conn);
        if ($result === false) throw new DBError("there was an error while retrieving data. \nThe system thrown this error:\n" . $this->conn->error);
        if ($result == null) return NULL;
        else {
            return $result->fetch_assoc();
        }
    }

    public function getAllUsers()
    {
        $sql = "SELECT user_id, user_type, user_time_zone from system_users";

        $result = $this->db::selectFromDb($sql, $this->conn);
        if ($result === false) throw new DBError("there was an error while retrieving data. \nThe system thrown this error:\n" . $this->conn->error);
        if ($result == null) return NULL;
        else {
            return $result;
        }
    }

    public function getAllUsersDetails($showOnlyActiveUsers = false)
    {
        $users_data = array();
        $result = $this->getAllUsers();
        if ($result === NULL) return null;

        while ($row = $result->fetch_assoc()) {
            $user_role = $row["user_type"];
            if ($user_role == "admin") {
                $admin = new Admin();
                $res = $admin->getSingleAdminInfo($row["user_id"], $showOnlyActiveUsers);
                array_push($users_data, $res);
            }
            if ($user_role == "coach") {
                $coach = new Coach();
                $res = $coach->getSingleCoachInfo($row["user_id"], $showOnlyActiveUsers);
                array_push($users_data, $res);
            }
            return $users_data;
        }
    }

    public function getSingleUserDetails(int $user_id)
    {
        $result = $this->getSingleUserInfo($user_id);
        if ($result === NULL) return null;

        $row = $result;
        $user_role = $row["user_type"];
        if ($user_role == "admin") {
            $admin = new Admin();
            $res = $admin->getSingleAdminInfo($row["user_id"]);
            $user_data = $res;
        }
        if ($user_role == "coach") {
            $coach = new Coach();
            $res = $coach->getSingleCoachInfo($row["user_id"]);
            $user_data = $res;
        }
        return $user_data;
    }

    protected function updateSystemUser(int $user_id)
    {
    }

    protected function deleteSystemUser(int $user_id)
    {
    }

    public function getLastInsertId()
    {
        return $this->result["last_id"];
    }

    /**
     * @function  getErrors
     * @return string 
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
