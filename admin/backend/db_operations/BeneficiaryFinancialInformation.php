<?php


class PaymentInfo extends DB
{


    /**
     * @param string $beneficiary_id
     * @param string $VSLAId
     */
    public function checkForPaymentInfo($beneficiary_id, $VSLAId)
    {

        $this->vsla = new VSLA();
        $response = array();

        $sql = "SELECT * FROM loan_information where beneficiary_id = '$beneficiary_id' AND loan_status='active'";

        $vsla = $this->vsla->getSingleVSLAInfo($VSLAId);
        if (!$vsla || $vsla === null) {
            $response = array("result" => false, "error" => $this->vsla->getErrors(), "message" => "can't get a VSLA group");
            return $response;
        }

        /** @var MYSQLI_RESULT $res */
        $res = $this->selectFromDb($sql);
        if ($res === false) {
            $response = array("result" => false, "error" => $this->conn->error, "message" => "error while getting loan information");
            return $response;
        }
        if ($res === null) {
            $response = array("result" => true, "hasActiveLoan" => false, "weeklySavings" => $vsla["amount_per_share"], "social_funds" => $vsla["social_funds_amount"]);
            return $response;
        }

        $loan = $res->fetch_assoc();
        $response = array("result" => true, "hasActiveLoan" => true, "loanTotalAmount" => $loan["loan_amount"], "loanLeftToPay" => $loan["debt_left"], "weeklySavings" => $vsla["amount_per_share"], "social_funds" => $vsla["social_funds_amount"]);

        return $response;
    }

    public function hasActiveLoan(string $beneficiary_id)
    {
        $sql = "SELECT beneficiary_id, loan_status FROM loan_information where beneficiary_id = '$beneficiary_id' AND loan_status='active'";

        $res = $this->selectFromDb($sql, $this->conn);

        if ($res === false) throw new Exception("There is a processing error: " . $this->conn->error);
        if ($res === null) return false;
        else return true;
    }
}
