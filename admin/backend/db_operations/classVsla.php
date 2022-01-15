<?php

class VSLA
{
    public $error = "";
    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function set_vsla_data(array $data)
    {
        $this->data = $data;
    }
    public function insert_into_db()
    {
        require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/db_operations/db_basic_functions.php";

        $res = DB::insertIntoDb("vsla_groups", $this->data, $this->conn);

        if ($res['result']) {
            return true;
        } else {
            $this->error .= $this->conn->error;
            return false;
        };
    }
}
