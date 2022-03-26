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

    public function getSingleAdminInfo(int $adminID, $onlyActiveCoach = false)
    {
        $sql = "SELECT * from coaches where coach_id = $adminID ";

        if ($onlyActiveCoach)
            $sql .= "AND status='active'";

        $result = $this->db::selectFromDb($sql, $this->conn);
        if ($result === false) throw new DBError("there was an error while retrieving data. \nThe system thrown this error:\n" . $this->conn->error);
        if ($result == null) return NULL;
        else {
            return $result->fetch_assoc();
        }
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
