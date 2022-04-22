<?php
include "../includes/head.php";
?>
<!-- main-contents -->
<main class="main-contents">
    <div class="container">
        <div class="card wrapper">
            <div class="card-header">
                <h3 class="mb-0">Beneficiaries</h3>
            </div>
            <div class="card-body">

                <div class="results">
                    <?php if (isset($_GET['successfully-added'])) { ?>
                        <div class="alert alert-success">
                            Beneficiary added successfully
                            <span class="close"></span>
                        </div>
                    <?php } else if (isset($_GET['error']) || isset($_SESSION["error"])) {
                    ?>
                        <div class="alert alert-danger">
                            <?= $_SESSION["error"] ?>
                            <span class="close"></span>
                        </div>
                    <?php
                        unset($_SESSION["error"]);
                    } ?>
                </div>

                <h3>Beneficiaries registration</h3>
                <i class="fas fa-question-circle"></i> any field marked with <span class="text-danger">*</span> is required

                <div class="form py-3">
                    <form action="<?= URL ?>/admin/backend/beneficiary_registration.php" enctype="multipart/form-data" method="post" id="form">
                        <input type="hidden" name="beneficiary_insert">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="grouped-fields">
                                    <h3 class="title"><i class="fas fa-user-circle"></i> Personal information</h3>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="fname">First name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder=":. Eg: Jane" name="fname" id="fname" data-required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="lname">Last name</label>
                                            <input type="text" class="form-control" value="" placeholder=":. Eg: Uwineza" id="lname" name="lname">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="idcardnumber">ID card number <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" value="" placeholder=":. ID card number" id="idcardnumber" name="idcardnumber">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="telnumber">Telephone number <span class="text-danger">*</span> <small class="text-muted px-2 bg-light"><i class="fas fa-question-circle"></i> add country code but without the plus(+) sign</small></label>
                                            <input type="number" class="form-control" value="" placeholder=":. Eg: 250788888555" id="telnumber" name="telnumber">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="gender">Gender<span class="text-danger">*</span></label>
                                            <select class="form-control" id="gender" name="gender" data-required disabled>
                                                <option>Female</option>
                                                <option>Male</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="vsla">VSLA<span class="text-danger">*</span></label>
                                            <select class="form-control" id="vsla" name="vsla" data-required>
                                                <option disabled selected>Select</option>
                                                <?php
                                                $vsla = new VSLA();
                                                $res = $vsla->getAllVSLAs();
                                                try {
                                                    if ($res === null) {
                                                    } else if ($vsla === false)
                                                        throw new Exception("There was an error in db", 1);
                                                    else {
                                                        while ($row = $res->fetch_assoc()) {
                                                            echo '<option value="' . $row["VSLA_id"] . '">' . $row["VSLA_name"] . '</option>';
                                                        }
                                                    }
                                                } catch (\Throwable $th) {
                                                    echo "error";
                                                }

                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="profileimage">Profile image</label>
                                            <input type="file" accept="jpg" class="form-control" value="" placeholder=":. Eg: 250788888555" id="profileimage" name="image">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <label for="checked"><input type="checkbox" name="" id="checked"> I have checked that all information are corrected</label>
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