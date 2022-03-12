<?php
require $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
require DB_CONNECT;
require_once ROOT . "admin/backend/db_operations/classBeneficiary.php";
require_once ROOT . "admin/backend/db_operations/classZone.php";
require_once ROOT . "admin/backend/db_operations/classVsla.php";
require_once ROOT . "admin/beneficiaries/display_beneficiaries_data_functions.php";
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
    <link rel="stylesheet" href="<?= DATATABLES_CSS ?>">
    <link rel="stylesheet" href="<?= URL ?>/res/css/general-css.css">
    <link rel="stylesheet" href="<?= URL ?>/res/css/admin-styles.css">

    <script src="<?= AXIOS ?>"></script>

    <title>Beneficiary</title>
</head>

<body>
    <div id="root" class="h-100">
        <!-- top-nav -->
        <?php include $_SERVER["DOCUMENT_ROOT"] . "/admin/includes/top-nav.php" ?>
        <!-- ./top-nav -->

        <!-- side-bar menu -->
        <?php include $_SERVER["DOCUMENT_ROOT"] . "/admin/includes/side-bar.php"; ?>
        <!-- ./side-bar -->

        <!-- main-contents -->
        <main class="main-contents">
            <div class="container">
                <div class="card wrapper">
                    <div class="card-body">
                        <div class="results">
                            <?php if (isset($_GET['successfully-added'])) { ?>
                                <div class="alert alert-success">
                                    Beneficiary added successfully
                                    <span class="close"></span>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="title d-flex justify-content-between">
                            <h3 class="mb-0">Beneficiaries</h3>
                            <div class="d-inline-block float-right">
                                <a href="<?= URL ?>/admin/beneficiaries/new-beneficiary-form.php" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> new beneficiary</a>
                                <?php if (!isset($_GET["view-single"])) { ?>
                                    <button class="btn btn-light btn-sm"><i class="fas fa-download"></i> download</button>
                                <?php  } ?>
                            </div>
                        </div>
                        <hr />

                        <div class="tab-contents">

                            <?php


                            $beneficiary = new Beneficiary($conn);

                            if (isset($_GET["view-single"])) {
                                echo '<div class="mb-3"><a class="btn btn-light" href="' . URL . '/admin/beneficiaries/view-beneficiaries.php"><i class="fas fa-table"></i> view all</a></div>';
                                try {
                                    # redirect if there are some missing parameters in the URL
                                    if (!isset($_GET["beneficiary-id"])) {
                                        echo "<script>window.location=\"" . URL . "/admin/beneficiaries/view-beneficiaries.php\"</script>";
                                    }

                                    $beneficiary_id = $_GET["beneficiary-id"];
                                    $beneficiary_info = $beneficiary->getSingleBeneficiary($beneficiary_id);
                                    # check the given benficiary
                                    if ($beneficiary_info === null) throw new Error("<i class='fas fa-info-circle'></i> There is no such person registered in our systems", "warning");
                                    if ($beneficiary_info === false) throw new Error("Something went wrong", "danger");
                                    # if everything is okey, display the given beneficiary
                                    displaySingleBeneficiaryData($beneficiary_info);
                                } catch (Error $e) {
                                    echo  displayAlert("<i class='fas fa-exclamation-triangle'></i> Something went wrong", "warning");
                                }
                            } else {
                                # Display all beneficiaries if the specific GET parameter is not present in the URL
                                try {
                                    $res = $beneficiary->getAllBeneficiaries(array("showOnlyActiveBeneficiary" => true));

                                    // if (isset($_GET["show-only-active"])) {
                                    //     $res = $beneficiary->getAllBeneficiaries(array("showOnlyActiveBeneficiary" => true));
                                    //     if (isset($_GET["show-vsla-id"]))
                                    //         $res = $beneficiary->getAllBeneficiaries(array("showOnlyActiveBeneficiary" => true, "sortByVSLAId" => $_GET["show-vsla-id"]));
                                    // } else {
                                    //     if (isset($_GET["show-vsla-id"]))
                                    //         $res = $beneficiary->getAllBeneficiaries(array("sortByVSLAId" => $_GET["show-vsla-id"]));
                                    // }

                                    if ($res === false) throw new Exception("System error: " . $beneficiary->getErrors());
                                    if ($res !== null) {
                                        displayBeneficiaryData($res, $conn);
                                    } else echo displayAlert("There is no beneficiary registered", "info");
                                } catch (Error $e) {
                                    $error = $e->getMessage();
                                    displayAlert($error);
                                } catch (Exception $e) {
                                    $error = $e->getMessage();
                                    displayAlert($error);
                                }
                            }
                            ?>


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
    <script src="<?= URL ?>/res/js/admin-sidebar.js"></script>
    <script src="<?= BOOTSTRAP_JS ?>"></script>
    <script src="<?= DATATABLES_JS ?>"></script>
    <!-- activate the data-table -->
    <script>
        const dataTable = new DataTable("#beneficiariesTable");

        // const ch = document.querySelector("#showOnlyActive");
        // const vslaDrp = document.querySelector("#vslaDrp");
        // const formF = document.querySelector("[data-filterform]")
        // ch.onchange = () => {
        //     formF.submit()
        // }
        // vslaDrp.onchange = () => {
        //     formF.submit()
        // }
    </script>
</body>

</html>