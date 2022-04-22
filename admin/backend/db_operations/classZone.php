<?php

class VSLA_zone extends DB
{
    public $error = "";

    /** 
     * @return array|null|MYSQLI_RESULT  if true or an array of errors
     * @param string $zone_type
     */
    public function getAllZones(string $zone_type = "parish")
    {

        $sql = "SELECT * from vsla_zones where vsla_zone_type = '$zone_type'";
        $res = $this->selectFromDb($sql, $this->conn);
        if ($res === false) {
            $this->error .= $this->conn->error;
            return false;
        } elseif ($res->num_rows <= 0) return null;
        else return $res;
    }

    public function getSingleZoneInfo(int $zone_id)
    {
        $sql = "SELECT * from vsla_zones where vsla_zone_id = $zone_id";
        $res = $this->selectFromDb($sql, $this->conn);

        if ($res === false) {
            $this->error .= $this->conn->error;
            return false;
        } elseif ($res === null) return null;
        else return $res->fetch_assoc();
    }

    public function insertZone(array $data)
    {
        $res = $this->insertIntoDb("vsla_zones", $data, $this->conn);
        if ($res["result"] === false) {
            $this->error .= $this->conn->error;
            return false;
        } else return true;
    }

    public function countZones()
    {
        $res = $this->selectFromDb("SELECT COUNT(vsla_zone_id) as number_of_zones from vsla_zones", $this->conn);
        if ($res) {
            return $res->fetch_assoc()["number_of_zones"];
        } elseif ($res === null) return 0;
    }
}
