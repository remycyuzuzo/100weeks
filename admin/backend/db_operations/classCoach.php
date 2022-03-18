<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/db_operations/classUser.php";
class Coach extends User
{

    public function registerNewCoach(array $data)
    {
        $this->result = $this->db::insertIntoDb("coaches", $data, $this->conn);
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

    public function updateCoach(int $coachId)
    {
        # code...
    }

    public function deleteCoach(int $coachId)
    {
        # code...
    }
}
