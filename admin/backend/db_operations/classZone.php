<?php

class VSLA_zone
{
    public $error = "";

    public function __construct()
    {
        require $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/db_connection.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/db_operations/db_basic_functions.php";

        $this->conn = $conn;
        $this->db = new DB();
    }

    /** 
     * @return array|null|MYSQLI_RESULT  if true or an array of errors
     * @param string $zone_type
     */
    public function getAllZones(string $zone_type = "parish")
    {

        $sql = "SELECT * from vsla_zones where vsla_zone_type = '$zone_type'";
        $res = $this->db::selectFromDb($sql, $this->conn);
        if ($res === false) {
            $this->error .= $this->conn->error;
            return false;
        } elseif ($res->num_rows <= 0) return null;
        else return $res;
    }

    public function getSingleZoneInfo(int $zone_id)
    {
        $sql = "SELECT * from vsla_zones where vsla_zone_id = $zone_id";
        $res = $this->db::selectFromDb($sql, $this->conn);

        if ($res === false) {
            $this->error .= $this->conn->error;
            return false;
        } elseif ($res === null) return null;
        else return $res->fetch_assoc();
    }

    public function insertZone(array $data)
    {
        $res = $this->db::insertIntoDb("vsla_zones", $data, $this->conn);
        if ($res["result"] === false) {
            $this->error .= $this->conn->error;
            return false;
        } else return true;
    }
}
