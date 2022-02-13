<?php

class Beneficiary
{
    private $error = "";
    function __construct($conn)
    {
        require_once $_SERVER["DOCUMENT_ROOT"] . "//admin/backend/db_operations/db_basic_functions.php";
        $this->conn = $conn;
        $this->db = new DB();
    }

    public function set_beneficiary_data(array $data)
    {
        $this->data = $data;
    }

    public function insert_into_db()
    {
        if ($this->doesBeneficiaryExists($this->data["beneficiary_id_card"])) {
            $this->error .= "The beneficiary arleady exists";
            return false;
        }
        $res = $this->db::insertIntoDb("beneficiaries", $this->data, $this->conn);

        if ($res['result']) {
            return true;
        } else {
            $this->error .= $this->conn->error;
            return false;
        }
    }

    public function getAllBeneficiaries(string $order = "asc")
    {
        $sql = "SELECT * from beneficiaries where status = 'active' ORDER BY lname $order";
        $res = $this->db::selectFromDb($sql, $this->conn);
        if ($res === false) {
            $this->error .= $this->conn->error;
            return false;
        } elseif ($res->num_rows <= 0) return null;
        else return $res;
    }

    public function doesBeneficiaryExists(string $beneficiary_id)
    {
        $sql = "SELECT beneficiary_id_card from beneficiaries where beneficiary_id_card = '$beneficiary_id'";
        $res = $this->db::selectFromDb($sql, $this->conn);
        if ($res === false) {
            throw new Exception("there is an error: " . $this->conn->error);
        } elseif ($res === null) {
            return false;
        } else return true;
    }

    public function getSingleBeneficiary(int $beneficiary_id, $order = "asc")
    {
        $sql = "SELECT * from beneficiaries where beneficiary_id_card = '$beneficiary_id' ORDER BY lname $order";
        $res = $this->db::selectFromDb($sql, $this->conn);

        if ($res === false) {
            $this->error .= $this->conn->error;
            return false;
        } elseif ($res === null) return null;
        else return $res;
    }

    public function getErrors()
    {
        return $this->error;
    }
}
