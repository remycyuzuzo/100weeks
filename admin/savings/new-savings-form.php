<?php
if (!isset($_GET['member_id'])) {
    exit();
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
} catch (TypeError $e) {
    echo $e->getMessage();
}
?>

<div class="card">
    <div class="card-header d-flex  justify-content-between">
        <h3 class="m-0">new saving</h3>
        <span class="float-left close-btn" title="close" style="transform: scale(2); cursor: pointer;">&times;</span>
    </div>
    <div class="card-body">
        <div class="beneficiary-info">
            <h3><?= $name ?></h3>
        </div>
        <form action="<?= URL ?>/admin/backend/register_savings.php" method="POST" enctype="multipart/form-data" id="payment-form">
            <input type="hidden" name="registering_weekly_saving">
            <input type="hidden" name="user_id" value="<?= isset($_REQUEST["logged_in"]) ? $_REQUEST["logged_in"] : "" ?>">
            <input type="hidden" name="beneficiary_id" value="<?= $_REQUEST["member_id"] ?>">
            <div class="form-group">
                <label for="week">Select week</label>
                <input type="week" id="week" name="week" class="form-control" data-required>
            </div>
            <div class="form-group">
                <label for="amount">amount</label>
                <input type="number" id="amount" value="<?= $beneficiary_weekly_payment ?>" name="amount" class="form-control" data-required>
            </div>
            <div class="mt-1 mb-2">
                <label for="accept">
                    <input type="checkbox" name="iHaveRead" id="accept"> I have checked that information are correct
                </label>
            </div>
            <div class="form-group">
                <button type="button" class="close-btn btn btn-secondary"><i class="fas fa-times-circle"></i> cancel</button>
                <button class="btn btn-primary"><i class="fas fa-check-circle"></i> Save</button>
            </div>
        </form>
    </div>
</div>