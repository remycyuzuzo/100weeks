<?php
if (!isset($_GET['member_id'])) {
    exit("invalid request");
}

require_once $_SERVER["DOCUMENT_ROOT"] . "//admin/dependencies.php";
require_once DB_CONNECT;
require_once $_SERVER["DOCUMENT_ROOT"] . "//admin/backend/db_operations/classBeneficiary.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "//admin/backend/db_operations/BeneficiaryFinancialInformation.php";

try {
    $beneficiary = new Beneficiary($conn);
    $beneficiary_finances = new PaymentInfo();
    $res = $beneficiary->getSingleBeneficiary($_GET['member_id']);
    if ($res) {
        $row = $res;
    } else die("something is wrong");

    $beneficiary_finances = $beneficiary_finances->checkForPaymentInfo($_GET['member_id'], $row["VSLA_id"]);
    $name = $row["lname"] . " " . $row["fname"];
    $beneficiary_weekly_payment = $beneficiary_finances["weeklySavings"] * $row["number_of_shares"];
    $debt_left = $beneficiary_finances["loanLeftToPay"];
} catch (TypeError $e) {
    echo $e->getMessage();
}
?>

<div class="card">
    <div class="card-header d-flex  justify-content-between">
        <h3 class="m-0">Loan payment</h3>
        <span class="float-left close-btn" title="close" style="transform: scale(2); cursor: pointer;">&times;</span>
    </div>
    <div class="card-body">
        <div class="beneficiary-info">
            <h3>
                <?= $name ?>
            </h3>
            <div class="alert alert-dark">
                <strong><span id="debtLeft"><?= $debt_left ?></span></strong> Frw left to pay
            </div>
        </div>
        <form action="<?= URL ?>/admin/loans/submit_loan_payment.php" method="POST" id="payment-form">
            <div class="form-group mb-2">
                <input type="number" name="amount" placeholder="Amount of money (Rfw)" class="form-control" data-amount>
            </div>
            <div class="mt-1 mb-2">
                <label for="accept">
                    <input type="checkbox" name="iHaveRead" id="accept"> I have checked that information are correct
                </label>
            </div>
            <input type="hidden" name="submitting" value="loan_payment">
            <input type="hidden" name="beneficiary_id" value="<?= $_GET['member_id'] ?>">
            <div class="form-group">
                <button class="btn btn-primary">save <i class="fas fa-plus-square"></i></button>
            </div>
        </form>
    </div>
</div>