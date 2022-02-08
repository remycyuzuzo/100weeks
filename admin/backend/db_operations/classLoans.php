<?php

class Loan
{
    /** @var string $errors this will keep the string representation of all generated errors  */
    private $errors = "";

    public function __construct()
    {
        require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
        require DB_CONNECT;
        require_once ROOT . "admin/backend/db_operations/db_basic_functions.php";

        $this->conn = $conn;
        $this->db = new DB();
    }

    public function registerNewLoan()
    {
        # code...
    }

    public function getAllActiveLoans()
    {
        $sql = "SELECT * FROM loan_information where loan_status='active'";

        $res = $this->db::selectFromDb($sql, $this->conn);

        if ($res) {
            if ($res->num_rows > 0) {
                return $res;
            } else {
                return null;
            }
        } else {
            $this->errors .= $this->conn->error;
            return false;
        }
    }

    /**
     * @param integer $beneficiaryID
     * @return array|bool|null
     */
    public function getpersonalLoanInfo($beneficiaryID)
    {
        $sql = "SELECT * FROM loan_information where beneficiary_id = $beneficiaryID AND loan_status='active'";

        $res = $this->db::selectFromDb($sql, $this->conn);

        if ($res) {
            if ($res->num_rows > 0) {
                return $res->fetch_assoc();
            } else {
                return null;
            }
        } else {
            $this->errors .= $this->conn->error;
            return false;
        }
    }

    public function hasLoan($beneficiaryID)
    {
        $sql = "SELECT * FROM loan_information where beneficiary_id = $beneficiaryID AND loan_status='active'";

        $res = $this->db::selectFromDb($sql, $this->conn);

        if ($res) {
            if ($res->num_rows > 0) {
                return false;
            } else {
                return true;
            }
        } else {
            $this->errors .= $this->conn->error;
            die();
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
