<h1>loan form</h1>
<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";


?>
<h3>Add new VSLA</h3>
<div class="form py-3">
    <form action="<?= URL ?>/admin/backend/register_new_loan.php" enctype="multipart/form-data" method="post" id="form">
        <div class="grouped-fields">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="id_number">Beneficiary ID number <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" placeholder="ID Number of the beneficiary requesting loan" name="id_number" id="id_number" data-fetchbeneficiarydata data-required autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                    <label for="amount">Amount <span class="text-danger">*</span></label>
                    <input type="number" class="form-control money" placeholder="Amount of money" name="amount" id="amount" data-fetchbeneficiarydata data-required autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                    <label for="date_approved">Date approved <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" value="" placeholder="ID card number" id="date_approved" name="date_approved" data-required>
                </div>
                <div class="form-group col-md-6">
                    <label for="due_date">Due date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" value="" placeholder="ID card number" id="due_date" name="due_date" data-required>
                </div>
                <div class="form-group col-md-6">
                    <label for="interest_rate">Interest rate</label>
                    <input type="text" name="interest_rate" value="5" id="interest_rate" class="form-control" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="loan_desc">Loan description <small class="text-muted bg-light px-2"><i class="fas fa-question-circle"></i> (optional) reasons for this loan</small></label>
                    <textarea name="loan_desc" class="form-control" id="loan_desc"></textarea>
                </div>
                <input type="hidden" name="loan_registration">
            </div>
        </div>
        <div data-response class="my-3"></div>
        <div class="submit-btn">
            <button type="submit" class="btn btn-primary" name="send" data-submitbtn><i class="fas fa-check-circle"></i> Submit</button>
        </div>
    </form>
</div>