<?php
include __DIR__ . "/includes/head.php";
?>
<main class="main-contents">
    <div class="container">
        <div class="card wrapper">
            <div class="card-header">
                <h2 class="mb-0"><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
            </div>
            <div class="card-body">
                <div class="summary-cards">
                    <div class="title mb-3">
                        <h3>System Snapshot</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    $beneficiary = new Beneficiary();
                                    ?>
                                    <div><b><?= $beneficiary->countAllBeneficiaries("active") ?></b> beneficiaries registered</div>
                                    <span>
                                        <a href="#">view more <i class="fas fa-arrow-right"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    $zone = new VSLA_zone()
                                    ?>
                                    <div><b><?= $zone->countZones() ?></b> parishes</div>
                                    <span>
                                        <a href="#">view more <i class="fas fa-arrow-right"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    $vsla = new VSLA();
                                    ?>
                                    <div class=""><b><?= $vsla->countAllVSLAs() ?></b> VSLAs</div>
                                    <span>
                                        <a href="#">view more <i class="fas fa-arrow-right"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    $user = new User();
                                    ?>
                                    <div><b><?= $user->countAllUsers() ?></b> users</div>
                                    <span>
                                        <a href="#">view more <i class="fas fa-arrow-right"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div><!-- ./row -->
                </div><!-- ./summary-cards -->
                <hr />
                <div class="latest-reports">
                    <div class="title mb-2">
                        <h3>Latest Reports</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- ./main-contents -->

<?php include "./includes/foot.php" ?>