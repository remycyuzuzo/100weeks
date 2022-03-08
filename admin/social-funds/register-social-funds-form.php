<?php
if (!isset($_GET['member_id'])) {
    exit();
}

require_once $_SERVER["DOCUMENT_ROOT"] . "//admin/dependencies.php";
require_once DB_CONNECT;
require_once $_SERVER["DOCUMENT_ROOT"] . "//admin/backend/db_operations/classBeneficiary.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "//admin/backend/db_operations/BeneficiaryFinancialInformation.php";

$beneficiary = new Beneficiary($conn);
$res = $beneficiary->getSingleBeneficiary($_GET['member_id']);
if ($res) {
    $row = $res->fetch_assoc();
} else die("something is wrong");

$beneficiary_finances = new PaymentInfo();
$beneficiary_finances = $beneficiary_finances->checkForPaymentInfo($_GET['member_id'], $row["VSLA_id"]);
$socialFunds = $beneficiary_finances["social_funds"];
$name = $row["lname"] . " " . $row["fname"];
?>

<div class="card">
    <div class="card-header d-flex  justify-content-between">
        <h3 class="m-0">Register social funds</h3>
        <span class="float-left close-btn" title="close" style="transform: scale(2); cursor: pointer;">&times;</span>
    </div>
    <div class="card-body">
        <div class="beneficiary-info">
            <h3><?= $name ?></h3>
        </div>
        <form action="<?= URL ?>/admin/backend/register_social_funds_payment.php" method="POST" enctype="multipart/form-data" id="payment-form">
            <input type="hidden" name="registering_social_funds">
            <input type="hidden" name="user_id" value="<?= isset($_REQUEST["logged_in"]) ? $_REQUEST["logged_in"] : "" ?>">
            <input type="hidden" name="beneficiary_id" value="<?= $_REQUEST["member_id"] ?>">

            <div class="form-group">
                <label for="week">Select week</label>
                <input type="week" name="week" id="week" class="form-control">
            </div>
            <div class="form-group">
                <label for="amount">amount</label>
                <input type="number" name="amount" value="<?= $socialFunds ?>" id="amount" class="form-control">
            </div>
            <div class="mt-1 mb-2">
                <label for="accept">
                    <input type="checkbox" name="iHaveRead" id="accept"> I have checked that information are correct
                </label>
            </div>
            <div class="form-group">
                <button type="button" class="close-btn btn btn-light">cancel</button>
                <button class="btn btn-primary">Save <i class="fas fa-check-circle"></i></button>
            </div>
        </form>
    </div>
</div>