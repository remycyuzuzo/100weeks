<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
require DB_CONNECT;
require_once ROOT . "admin/backend/db_operations/classLoans.php";

$response = array();

$loans = new Loan();

$res = $loans->getAllActiveLoans();

if ($res === null) {
    $response = array(
        "result" => null,
        "message" => "No active loans found"
    );
} elseif ($res === false) {
    $response = array(
        "result" => false,
        "message" => $loans->getErrors()
    );
} else {
    while ($row = $res->fetch_assoc()) {
        $totalLoanPaid = $loans->totalLoanPaid($row["loan_id"], $row["beneficiary_id_card"])["sum(amount)"];
        array_push($response, array(
            "fname" => $row["fname"],
            "lname" => $row["lname"],
            "beneficiary_id_card" => $row["beneficiary_id_card"],
            "approval_date" => $row["approval_date"],
            "loan_amount" => $row["loan_amount"] + ($row["loan_amount"] * $row["interest_rate"] / 100),
            "loan_due_date" => $row["loan_due_date"],
            "debt_left" => $row["debt_left"],
            "total_loan_paid" => ($totalLoanPaid !== null) ? $totalLoanPaid : 0
        ));
    }
    $response = array(
        "result" => true,
        "loanHolders" => $response
    );
}

echo json_encode($response);
