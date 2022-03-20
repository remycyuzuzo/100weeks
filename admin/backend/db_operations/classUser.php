<?php

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
        $password = ($password == "") ? md5($password) : "";
        return $password;
    }

    protected function getSingleUserInfo(int $user_id)
    {
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
