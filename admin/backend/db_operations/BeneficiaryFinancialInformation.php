<?php


class PaymentInfo
{
    public function __construct()
    {
        require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
        require DB_CONNECT;
        require_once ROOT . "admin/backend/db_operations/db_basic_functions.php";
        require_once ROOT . "admin/backend/db_operations/classVsla.php";

        $this->conn = $conn;
        $this->db = new DB();
        $this->vsla = new VSLA($this->conn);
    }

    /**
     * @param string $beneficiary_id
     * @param string $VSLAId
     */
    public function checkForPaymentInfo($beneficiary_id, $VSLAId)
    {

        $response = array();

        $sql = "SELECT * FROM loan_information where beneficiary_id = $beneficiary_id AND loan_status='active'";

        $vsla = $this->vsla->getSingleVSLAInfo($VSLAId);
        if (!$vsla || $vsla === null) {
            array_push($response, array("result" => false, "error" => $this->vsla->getErrors(), "message" => "can't get a VSLA group"));
            return $response;
        }

        /** @var MYSQLI_RESULT $res */
        $res = $this->db::selectFromDb($sql, $this->conn);
        if ($res === false) {
            array_push($response, array("result" => false, "error" => $this->conn->error, "message" => "error while getting loan information"));
            return $response;
        }
        if ($res === null) {
            array_push($response, array("result" => true, "hasActiveLoan" => false, "weeklySavings" => $vsla["amount_per_share"], "social_funds" => $vsla["social_funds_amount"]));
            return $response;
        }

        $loan = $res->fetch_assoc();
        array_push($response, array("result" => true, "hasActiveLoan" => true, "loanTotalAmount" => $loan["loan_amount"], "loanLeftToPay" => $loan["debt_left"], "weeklySavings" => $vsla["amount_per_share"], "social_funds" => $vsla["social_funds_amount"]));

        return $response;
    }
}
