<?php
require $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
require DB_CONNECT;
require_once ROOT . "admin/backend/db_operations/classBeneficiary.php";

function displayAlert($message, $type = "danger")
{
    return "<div class=\"alert alert-$type\">$message</div>";
}

function displayBeneficiaryData($res_data)
{
?>
    <table class="table table-hover" id="beneficiariesTable">
        <thead>
            <th>#</th>
            <th>name</th>
            <th>Parish</th>
            <th>VSLA</th>
            <th></th>
        </thead>
        <tbody>
            <?php
            $i = 0;
            while ($row = $res_data->fetch_assoc()) {
            ?>
                <tr data-beneficiary_id="<?= $row["beneficiary_id_card"] ?>">
                    <td><?= ++$i ?></td>
                    <td><a href=""><?= $row["lname"] . " " . $row["fname"] ?></a></td>
                    <td></td>
                    <td><?= $row["VSLA_id"] ?></td>
                    <td><button class="btn btn-sm btn-light"><i class="fas fa-edit"></i> edit</button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php
}
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
                                <button class="btn btn-light btn-sm"><i class="fas fa-download"></i> download</button>
                            </div>
                        </div>
                        <hr />

                        <div class="tab-contents">
                            <div class="table-responsive">
                                <?php

                                try {
                                    $beneficiary = new Beneficiary($conn);
                                    $res = $beneficiary->getAllBeneficiaries();
                                    if ($res === false) throw new Exception("System error: " . $beneficiary->getErrors());
                                    if ($res !== null) {
                                        displayBeneficiaryData($res);
                                    } else echo displayAlert("There is no beneficiary registered", "info");
                                } catch (Error $e) {
                                    $error = $e->getMessage();
                                    displayAlert($error);
                                } catch (Exception $e) {
                                    $error = $e->getMessage();
                                    displayAlert($error);
                                }
                                ?>

                            </div>
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
    </script>
</body>

</html>