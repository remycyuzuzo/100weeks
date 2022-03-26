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

    public function getSingleCoachInfo(int $coachId, $onlyActiveCoach = false)
    {
        $sql = "SELECT * from coaches where coach_id = $coachId ";

        if ($onlyActiveCoach)
            $sql .= "AND status='active'";

        $result = $this->db::selectFromDb($sql, $this->conn);
        if ($result === false) throw new DBError("there was an error while retrieving data. \nThe system thrown this error:\n" . $this->conn->error);
        if ($result == null) return NULL;
        else {
            return $result->fetch_assoc();
        }
    }

    public function getAllCoachInfo($onlyActiveCoach = false)
    {
        $sql = "SELECT * from coaches where coach_id ";

        if ($onlyActiveCoach)
            $sql .= "AND status='active'";

        $result = $this->db::selectFromDb($sql, $this->conn);
        if ($result === false) throw new DBError("there was an error while retrieving data. \nThe system thrown this error:\n" . $this->conn->error);
        if ($result == null) return NULL;
        else {
            return $result;
        }
    }

    public function updateCoach(int $coachId, $data)
    {
        if (empty($coachId) or count($data) === 0) {
            throw new DBError("Invalid update request\nthere is no ID or data specified");
        }

        $result = $this->db->updateFromTable("coaches", $data, "coach_id = $coachId", $this->conn);
        if ($result) {
            return true;
        }
    }

    public function deleteCoach(int $coachId)
    {
        # code...
    }
}
