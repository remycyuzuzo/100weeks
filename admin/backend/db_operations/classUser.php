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

    public function getSingleUserInfo(int $user_id, string $user_type)
    {
        $sql = "SELECT * from system_users where user_id = $user_id AND user_type = '$user_type'";

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

    public function getAllUsersDetails($showOnlyActiveUsers = false, $only_this_user_role = null)
    {
        $users_data = array();
        $result = $this->getAllUsers();
        if ($result === null) return null;

        while ($row = $result->fetch_assoc()) {
            $user_role = $row["user_type"];
            if ($user_role === "admin") {
                if ($only_this_user_role !== null and $only_this_user_role !== "admin")
                    echo "";
                else {
                    $admin = new Admin();
                    $res = $admin->getSingleAdminInfo($row["user_id"], $showOnlyActiveUsers);
                    $res["user_type"] = $row["user_type"];
                    array_push($users_data, $res);
                }
            }
            if ($user_role === "coach") {
                if ($only_this_user_role !== null and $only_this_user_role !== "coach")
                    echo "";
                else {
                    $coach = new Coach();
                    $res = $coach->getSingleCoachInfo($row["user_id"], $showOnlyActiveUsers);
                    $res["user_type"] = $user_role;
                    array_push($users_data, $res);
                }
            }
        }
        return $users_data;
    }

    public function getSingleUserDetails(int $user_id, string $user_type)
    {
        $result = $this->getSingleUserInfo($user_id, $user_type);
        if ($result === NULL) return null;

        $row = $result;
        $user_role = $row["user_type"];
        if ($user_role == "admin") {
            $admin = new Admin();
            $res = $admin->getSingleAdminInfo($row["user_id"]);
            $user_data = $res;
            $user_data["user_type"] = $user_role;
        }
        if ($user_role == "coach") {
            $coach = new Coach();
            $res = $coach->getSingleCoachInfo($row["user_id"]);
            $user_data = $res;
            $user_data["user_type"] = $user_role;
        }
        return $user_data;
    }

    protected function updateSystemUser(array $data, int $user_id, string $user_type)
    {
        $this->result = $this->db->updateFromTable("system_users", $data, "user_id = $user_id AND user_type='$user_type'", $this->conn);
        if ($this->result) {
            return true;
        } else {
            throw new DBError($this->conn->error);
            return false;
        }
    }

    protected function deleteSystemUser(int $user_id)
    {
        $this->result = $this->db->deleteFromTable("system_users", $user_id, $this->conn);
        if ($this->result["result"]) {
            return true;
        } else {
            throw new DBError($this->result["errorMessage"]);
            return false;
        }
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
