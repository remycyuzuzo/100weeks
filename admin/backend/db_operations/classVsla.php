<?php

class VSLA extends DB
{
    public $error = "";

    public function set_vsla_data(array $data)
    {
        $this->data = $data;
    }

    public function insert_into_db()
    {
        $res = $this->insertIntoDb("vsla_groups", $this->data, $this->conn);

        if ($res['result']) {
            return true;
        } else {
            $this->error .= $this->conn->error;
            return false;
        }
    }

    public function getAllVSLAs(string $order = "asc")
    {
        $sql = "SELECT * from vsla_groups where status = 'active' ORDER BY vsla_name $order";
        $res = $this->selectFromDb($sql, $this->conn);
        if ($res === false) {
            $this->error .= $this->conn->error;
            return false;
        } elseif ($res->num_rows <= 0) return null;
        else return $res;
    }

    public function getSingleVSLAInfo(int $VSLAId)
    {
        $sql = "SELECT * from vsla_groups where VSLA_id = $VSLAId";
        $res = $this->selectFromDb($sql, $this->conn);
        if ($res === false) {
            $this->error .= $this->conn->error;
            return false;
        } elseif ($res->num_rows <= 0) return null;
        else return $res->fetch_assoc();
    }

    /**
     * this function will update the vsla group's information
     * @param int $VSLAId
     * @param array $data
     * @return bool
     */
    public function updateVSLAInfo(int $VSLAId, array $data)
    {
        $res = $this->updateFromTable("vsla_groups", $data, "VSLA_id = $VSLAId", $this->conn);
        if ($res['result']) {
            return true;
        } else {
            $this->error .= $this->conn->error;
            return false;
        }
    }


    public function countAllVSLAs($specific = "all")
    {
        $status = ($specific === "all") ? 1 : "status = '$specific'";
        $res = $this->selectFromDb("SELECT COUNT(VSLA_id) as number_of_VSLAs from vsla_groups where $status", $this->conn);
        if ($res) {
            return $res->fetch_assoc()["number_of_VSLAs"];
        } elseif ($res === null) return 0;
    }


    public function getErrors()
    {
        return ($this->error != "") ? $this->error : NULL;
    }
}
