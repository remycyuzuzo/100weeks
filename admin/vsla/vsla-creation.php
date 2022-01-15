<?php
require $_SERVER["DOCUMENT_ROOT"] . "admin/dependencies.php";
require $_SERVER["DOCUMENT_ROOT"] . "admin/backend/db_operations/classZone.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= FAVICON ?>" type="image/x-icon">

    <link rel="stylesheet" href="<?= BOOTSTRAP_CSS ?>">
    <link rel="stylesheet" href="<?= FONTAWESOME ?>">
    <link rel="stylesheet" href="<?= URL ?>/res/css/general-css.css">
    <link rel="stylesheet" href="<?= URL ?>/res/css/admin-styles.css">
    <title>Create new VSLA group</title>
</head>

<body>
    <div id="root" class="h-100">
        <!-- top-nav -->
        <?php include $_SERVER["DOCUMENT_ROOT"] . "admin/includes/top-nav.php" ?>
        <!-- ./top-nav -->

        <!-- side-bar menu -->
        <?php include $_SERVER["DOCUMENT_ROOT"] . "admin/includes/side-bar.php"; ?>
        <!-- ./side-bar -->

        <!-- main-contents -->
        <main class="main-contents">
            <div class="container">
                <div class="card wrapper">
                    <div class="card-header">
                        <h3 class="mb-0">VSLAs</h3>
                    </div>
                    <div class="card-body">

                        <div class="results">
                            <?php if (isset($_GET['successfully-added'])) { ?>
                                <div class="alert alert-success">
                                    The VSLA group was added
                                    <span class="close"></span>
                                </div>
                            <?php } ?>
                        </div>

                        <h3>New VSLA</h3>
                        <i class="fas fa-question-circle"></i> any field marked with <span class="text-danger">*</span> is required

                        <div class="form py-3">
                            <form action="<?= URL ?>/admin/backend/vsla_registration.php" enctype="multipart/form-data" method="post" id="form">
                                <input type="hidden" name="vsla">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="grouped-fields">
                                            <h3 class="title"><i class="fas fa-user-circle"></i> basic VSLA information</h3>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="name">VSLA Name <span class="text-danger">*</span> <small class="text-muted bg-light px-2"><i class="fas fa-question-circle"></i> any name that the group is reffered to as </small></label>
                                                    <input type="text" class="form-control" placeholder="VSLA name" name="name" id="name" data-required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="founding_date">Founding date <small class="text-muted bg-light px-2"><i class="fas fa-question-circle"></i> when was the group originally founded [optional]</small></label>
                                                    <input type="date" class="form-control" value="" placeholder="Founding date" id="founding_date" name="founding_date">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="date_joined_program">Date joined the 100Weeks program</label>
                                                    <input type="date" class="form-control" value="" placeholder="ID card number" id="date_joined_program" name="date_joined_program">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="paying_frequency">times that members give Savings and social funds <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="paying_frequency" name="paying_frequency" data-required disabled>
                                                        <option>Weekly</option>
                                                        <option>Monthly</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="paying_frequency">Select the VSLA <?= VSLA_ZONE_TYPE  ?> <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="paying_frequency" name="paying_frequency" data-required>
                                                        <option value="" selected disabled>Select</option>
                                                        <?php
                                                        $zone = new VSLA_zone();
                                                        $zone_type = VSLA_ZONE_TYPE;
                                                        $res = $zone->getAllZones($zone_type);
                                                        if ($res === false) {
                                                            echo "error";
                                                        } else if ($res === null) {
                                                            echo "nothing";
                                                        } else {
                                                            while ($row = $res->fetch_assoc()) {
                                                                echo "<option value='" . $row['vsla_zone_id'] . "'>" . $row['vsla_zone_name'] . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="box grouped-fields p-2">
                                            <h3 class="title"><i class="fas fa-lock"></i> VSLA default values [optional]</h3>
                                            <div class=" mb-3">
                                                <small class="text-muted bg-light px-2"><i class="fas fa-question-circle"></i> fill necessary information, but these values will help the mentor to not always enter the same information everytime [not required]</small>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="saving_amount">Saving amount per 1 share </label>
                                                    <input type="number" class="form-control money" placeholder="Saving amount" value="1000" name="saving_amount" id="saving_amount" data-required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="social_funds">Social funds per person</label>
                                                    <input type="number" class="form-control money" placeholder="Social funds amount" value="100" id="social_funds" name="social_funds">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="maximum_loan">Maximum loan amount allowed per person at time</label>
                                                    <input type="number" class="form-control money" placeholder="Maximum Amount allowed" value="15000" id="maximum_loan" name="maximum_loan">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="loan_interest">Loan interest rate<span class="text-danger">*</span></label>
                                                    <input type="number" name="loan_interest" value="15" id="loan_interest" class="form-control money" data-rate>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="loan_overdue_rate">Loan overdue fine rate<span class="text-danger">*</span></label>
                                                    <input type="number" name="loan_overdue_rate" value="10" id="loan_overdue_rate" class="form-control money" data-rate>
                                                </div>
                                                <div class="form-group">
                                                    <label for="return"><input type="checkbox" name="return" id="return"> Stay on this page after registration</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="submit-btn">
                                        <button type="button" class="btn btn-outline-danger">Cancel</button>
                                        <button type="submit" class="btn btn-primary" name="send">Submit</button>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </main>
        <!-- ./main-contents -->

        <!-- footer -->
        <footer></footer>
        <!-- ./end of footer -->
    </div>

    <!-- JAVASCRIPT FILES -->
    <script src="<?= URL ?>/res/js/money-field-design.js"></script>
    <script src="<?= AXIOS ?>"></script>
    <script src="<?= URL ?>/res/js/admin-sidebar.js"></script>
    <script src="<?= BOOTSTRAP_JS ?>"></script>

</body>

</html>