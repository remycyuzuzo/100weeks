<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/db_operations/classUser.php";
class Admin extends User
{

    public function registerNewAdmin(array $data)
    {
        $this->result = $this->db::insertIntoDb("administrator", $data, $this->conn);
        if ($this->result["result"]) {
            return true;
        } else {
            throw new DBError($this->result["errorMessage"]);
        }
    }

    public function getLastInsertId()
    {
        return $this->result["last_id"];
    }

    public function updateAdmin(int $coachId)
    {
        # code...
    }

    public function deleteAdmin(int $coachId)
    {
        # code...
    }
}
