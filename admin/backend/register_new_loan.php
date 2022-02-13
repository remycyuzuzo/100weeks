<?php

// input --formData
// output --JSON data indicating the processing results
try {
    // 'require' all required scripts
    require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
    require DB_CONNECT;
    require_once ROOT . "admin/backend/db_operations/classLoans.php";
    require_once ROOT . "admin/backend/db_operations/BeneficiaryFinancialInformation.php";
    require_once ROOT . "admin/backend/db_operations/classBeneficiary.php";

    if (!isset($_POST["loan_registration"])) {
        throw new Exception("Invalid request");
    }

    $id_number = isset($_POST['id_number']) ? $conn->real_escape_string($_POST["id_number"]) : "";
    $amount = isset($_POST['amount']) ? $conn->real_escape_string($_POST["amount"]) : "";
    $dateApproved = isset($_POST['date_approved']) ? $conn->real_escape_string($_POST["date_approved"]) : "";
    $dueDate = isset($_POST['due_date']) ? $conn->real_escape_string($_POST["due_date"]) : "";
    $loanDesc = isset($_POST['loan_desc']) ? $conn->real_escape_string($_POST["loan_desc"]) : "";

    // default interest rate is 5%
    $interestRate = 5;
    $interest = $amount * $interestRate / 100;
    $debtLeft = $amount + $interest;
    $loanStatus = "active";
    $loan = new Loan();

    $data = array(
        "loan_amount" => $amount,
        "loan_description" => $loanDesc,
        "loan_due_date" => $dueDate,
        "approval_date" => $dateApproved,
        "beneficiary_id" => $id_number,
        "user_id" => 1, // Please update here!
        "interest_rate" => $interestRate,
        "debt_left" => $debtLeft,
        "loan_status" => $loanStatus

    );

    // before registering this loan, check whether this user is eligible to this loan
    $beneficiary_loan_info = new PaymentInfo();
    $beneficiary = new Beneficiary($conn);
    // check whether this beneficiary is valid // just in case..
    if (!$beneficiary->doesBeneficiaryExists($id_number)) {
        throw new Exception("beneficiary with ID number $id_number cannot be found in our systems");
    }
    // check whether the beneficiary has an unpaid loan
    if ($beneficiary_loan_info->hasActiveLoan($id_number)) {
        throw new Exception("this beneficiary has an unpaid loan");
    }

    $res = $loan->registerNewLoan($data);

    // check whether this loan was successfully registered
    if ($res === true) {
        $response = array(
            "result" => true,
            "message" => "successfully registered this loan",
            "deadline" => $dueDate,
            "amount" => $amount,
            "interest" => $interest,
            "interestRate" => $interestRate,
            "beneficiaryID" => $id_number,
            "totalDebt" => $debtLeft
        );
    } else {
        throw new Exception("there was an error while registering this loan, please contact the administrator");
    }

    echo json_encode($response);
} catch (\Exception $e) {
    $response = array("result" => false, "message" => $e->getMessage());
    echo json_encode($response);
} catch (ErrorException $e) {
    $response = array("result" => false, "message" => $e->getMessage());
}
