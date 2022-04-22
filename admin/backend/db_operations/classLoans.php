<?php

class Loan extends DB
{
    /** @var string $errors this will keep the string representation of all generated errors  */

    public function registerNewLoan($data)
    {
        $res = $this->insertIntoDb("loan_information", $data, $this->conn);
        if ($res["result"] === true) {
            return true;
        } else {
            $this->errors .= $res["errorMessage"];
            return false;
        }
    }

    /**
     * @return MYSQLI_RESULT|null|bool
     */
    public function getAllActiveLoans()
    {
        $sql = "SELECT loan_id, beneficiary_id_card, loan_amount, loan_approved, approval_date,loan_due_date, loan_status, debt_left, interest_rate, fname, lname, tel_number, profile_picture FROM loan_information INNER JOIN beneficiaries ON (beneficiary_id_card = beneficiary_id) where loan_status='active'";

        $res = $this->selectFromDb($sql, $this->conn);

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

        $res = $this->selectFromDb($sql, $this->conn);

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

        $res = $this->selectFromDb($sql, $this->conn);

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
        $sql = "SELECT beneficiary_id FROM loan_information where beneficiary_id = $beneficiaryID AND loan_status='active'";

        $res = $this->selectFromDb($sql, $this->conn);

        if ($res === null) {
            return false;
        } else {
            return true;
        }
    }

    public function registerLoanPayment(array $payment_data)
    {
        $res = $this->insertIntoDb("loan_payments", $payment_data, $this->conn);
        if ($res["result"] === true) {
            return true;
        } else {
            $this->errors .= $res["errorMessage"];
            return false;
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
