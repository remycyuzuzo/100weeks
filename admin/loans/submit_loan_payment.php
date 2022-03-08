<?php

try {
    if (!isset($_POST['submitting']) && ($_POST['submitting'] === "")) {
        new Error("invalid request");
    }
    if (!isset($_POST['iHaveRead'])) {
        exit('"dataStatus":"doNothing"');
    }

    # import all required data
    require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
    require_once DB_CONNECT;
    require_once ROOT . "admin/backend/db_operations/db_basic_functions.php";
    require_once ROOT . "admin/backend/db_operations/classLoans.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/db_operations/BeneficiaryFinancialInformation.php";

    # get submitted data
    $beneficiary_id = $conn->real_escape_string($_POST['beneficiary_id']);
    $amount = $conn->real_escape_string($_POST['amount']);
    $user_id = 1; // CHANGE HERE
    # check where given amount is not negative or invalid
    if (!is_numeric($amount) || $amount <= 0)
        throw new Exception("Invalid input");
    # instantiate the Loan object
    $loans = new Loan();
    # verify whether he/she has anactive loan and get more info about the loan 
    if (!$loans->hasLoan($beneficiary_id))
        throw new Exception("this member doesn't have an active loan");

    # get more loan info
    $loan_info = $loans->getpersonalLoanInfo($beneficiary_id);
    $loan_id = $loan_info["loan_id"];
    # put all required data into an array
    $payment_data = array(
        "amount" => $amount,
        "loan_id" => $loan_id,
        "beneficiary_id" => $beneficiary_id,
        "user_id" => $user_id
    );
    $res = $loans->registerLoanPayment($payment_data);
    if ($res)
        $response = array("dataStatus" => "success", "message" => "payment registered successfully");
    else
        throw new Exception("error in processing");

    # then, update the table to write amount left to pay
    $debt_left = $loan_info["debt_left"] - $amount;
    if ($debt_left <= 0) {
        $sql = "UPDATE `loan_information` SET `loan_status` = 'paid' WHERE `loan_information`.`loan_id` = $loan_info[loan_id]";
        $res = DB::executeStandardQuery($sql, $conn);
        if (!$res["result"]) die("Error in updating loan status: " . $conn->error);
    }
    $sql = "UPDATE `loan_information` SET `debt_left` = $debt_left WHERE `loan_information`.`loan_id` = $loan_info[loan_id]";
    $res = DB::executeStandardQuery($sql, $conn);
    if (!$res["result"]) die("Error in updating loan debt left: " . $conn->error);

    echo json_encode($response);
} catch (Exception $e) {
    $response = array("dataStatus" => false, "message" => $e->getMessage());
    echo json_encode($response);
} catch (TypeError $e) {
    $response = array("dataStatus" => false, "message" => $e->getMessage());
    echo json_encode($response);
} catch (Error $e) {
    $response = array("dataStatus" => false, "message" => $e->getMessage());
    echo json_encode($response);
}
