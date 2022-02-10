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

    /**
     * @return MYSQLI_RESULT|null|bool
     */
    public function getAllActiveLoans()
    {
        $sql = "SELECT loan_id, beneficiary_id_card, loan_amount, loan_approved, approval_date,loan_due_date, loan_status, debt_left, interest_rate, fname, lname, tel_number, profile_picture FROM loan_information INNER JOIN beneficiaries ON (beneficiary_id_card = beneficiary_id) where loan_status='active'";

        $res = $this->db::selectFromDb($sql, $this->conn);

        if ($res === null) {
            return null;
        } elseif ($res === false) {
            $this->errors .= $this->conn->error;
            return false;
        } else {
            return $res;
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

        if ($res === null) {
            return null;
        } elseif ($res === false) {
            $this->errors .= $this->conn->error;
            return false;
        } else {
            return $res->fetch_assoc();
        }
    }

    public function totalLoanPaid($loanID, $beneficiaryID)
    {
        $sql = "SELECT sum(amount) from loan_payments WHERE loan_id = $loanID AND beneficiary_id='$beneficiaryID'";

        $res = $this->db::selectFromDb($sql, $this->conn);

        if ($res === null) {
            return null;
        } elseif ($res === false) {
            $this->errors .= $this->conn->error;
            return false;
        } else {
            return $res->fetch_assoc();
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
