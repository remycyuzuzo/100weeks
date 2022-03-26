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
            $this->error .= "The beneficiary already exists";
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

    /**
     * @param array $config
     */
    public function getAllBeneficiaries(array $config = array())
    {
        /* set this function's default parameters */
        if (!isset($config["showOnlyActiveBeneficiary"]))
            $config["showOnlyActiveBeneficiary"] = false;
        if (!isset($config["sortByVSLAId"]))
            $config["sortByVSLAId"] = 0;
        if (!isset($config["order"]))
            $config["order"] = "ASC";

        # query the database
        if ($config["showOnlyActiveBeneficiary"]) {
            $sql = "SELECT * from beneficiaries where status = 'active' ORDER BY lname $config[order]";
            if ($config["sortByVSLAId"] !== 0)
                $sql = "SELECT * from beneficiaries where status = 'active' AND VSLA_id = $config[sortByVSLAId] ORDER BY lname $config[order]";
        } else {
            $sql = "SELECT * from beneficiaries ORDER BY lname $config[order]";
            if ($config["sortByVSLAId"] !== 0)
                $sql = "SELECT * from beneficiaries where VSLA_id=$config[sortByVSLAId] ORDER BY lname $config[order]";
        }

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
        else return $res->fetch_assoc();
    }

    public function updateBeneficiary(array $data, string $beneficiary_id)
    {
        $res = $this->db->updateFromTable("beneficiaries", $data, "beneficiary_id_card = '$beneficiary_id'", $this->conn);
        if ($res['result']) {
            return true;
        } else {
            $this->error .= "\n" . $this->conn->error;
            throw new DBError("There was an error preventing the data to be updated\nthe system thrown this error: \n" . $this->conn->error);
            return false;
        }
    }

    public function getErrors()
    {
        return $this->error;
    }
}
