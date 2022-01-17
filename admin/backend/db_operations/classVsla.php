<?php

class VSLA
{
    public $error = "";
    function __construct($conn)
    {
        require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/db_operations/db_basic_functions.php";
        $this->conn = $conn;
        $this->db = new DB();
    }

    public function set_vsla_data(array $data)
    {
        $this->data = $data;
    }
    public function insert_into_db()
    {
        $res = $this->db::insertIntoDb("vsla_groups", $this->data, $this->conn);

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
        $res = $this->db::selectFromDb($sql, $this->conn);
        if ($res === false) {
            $this->error .= $this->conn->error;
            return false;
        } elseif ($res->num_rows <= 0) return null;
        else return $res;
    }
}
