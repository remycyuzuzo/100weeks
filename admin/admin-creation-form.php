<?php
require "./dependencies.php";
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
    <title>100Weeks - Admin Registration</title>
</head>

<body>
    <div id="root" class="h-100">
        <!-- top-nav -->
        <?php include "./includes/top-nav.php" ?>
        <!-- ./top-nav -->

        <!-- side-bar menu -->
        <?php include "./includes/side-bar.php"; ?>
        <!-- ./side-bar -->

        <!-- main-contents -->
        <main class="main-contents">
            <div class="container">
                <div class="title">
                    <h3>System Administrator creation form</h3>
                    <small class="text-muted bg-light px-2"><i class="fas fa-question-circle"></i> any field marked with <span class="text-danger">*</span> is required and must be filled</small>
                </div>
                <hr />
                <div class="form py-3">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="grouped-fields">
                                    <h3 class="title bg-primary"><i class="fas fa-user-circle"></i> Personal information</h3>
                                    <div class="form-group">
                                        <label for="fname">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="First name" name="fname" id="fname" data-required>
                                    </div>
                                    <div class="form-group">
                                        <label for="lname">Last name</label>
                                        <input type="text" class="form-control" placeholder="Last name" id="lname" name="lname">
                                    </div>
                                    <div class="form-group">
                                        <label for="idcard">ID card / Passport number</label>
                                        <input type="number" class="form-control" placeholder="ID card number" id="idcard" name="idcard">
                                    </div>
                                    <div class="form-group">
                                        <label for="tel">Telephone number <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" placeholder="Telephone number" id="tel" name="tel" data-required>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Gender <span class="text-danger">*</span></label>
                                        <fieldset class="py-2">
                                            <input type="radio" name="gender" value="F" id="radioFemale"> <label for="radioFemale">Female</label>
                                            <input type="radio" name="gender" id="radioMale" value="M"> <label for="radioMale">Male</label>
                                        </fieldset>
                                    </div>
                                </div>

                            </div>
                            <hr />
                            <div class="col-md-12 mb-2">
                                <div class="box grouped-fields bg-light p-2">
                                    <h3 class="title bg-primary"><i class="fas fa-lock"></i> Administrator's login cledentials</h3>
                                    <div class="form-group">
                                        <label for="email">Email address <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="email" placeholder="Email address of the administrator" data-required name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password <small class="text-muted bg-light px-2"><i class="fas fa-question-circle"></i> If you leave this empty, this user will receive a message for setting their password </small></label>
                                        <input type="password" class="form-control" id="password" placeholder="password" name="password">
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
        </main>
        <!-- ./main-contents -->

        <!-- footer -->
        <footer></footer>
        <!-- ./end of footer -->
    </div>

    <!-- JAVASCRIPT FILES -->
    <script src="<?= URL ?>/res/js/admin-sidebar.js"></script>
    <script src="<?= URL ?>/res/js/form-validators/mentor-validate.js" type="module"></script>
    <script src="<?= BOOTSTRAP_JS ?>"></script>
</body>

</html>