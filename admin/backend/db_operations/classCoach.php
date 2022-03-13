<?php

class Coach
{
    private $errors = "";

    public function __construct()
    {
        require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
        require DB_CONNECT;
        require_once ROOT . "/admin/backend/db_operations/db_basic_functions.php";

        $this->conn = $conn;
        $this->db = new DB();
    }

    public function registerNewCoach(array $data)
    {
        $result = $this->db::insertIntoDb("coaches", $data, $this->conn);
        if ($result["result"]) {
            return true;
        } else {
            throw new DBError($result["errorMessage"]);
        }
    }

    public function updateCoach(int $coachId)
    {
        # code...
    }

    public function deleteCoach(int $coachId)
    {
        # code...
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
