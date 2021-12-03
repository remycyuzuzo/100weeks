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
    <title>Sample page</title>
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
                    <h3>Register a new mentor/coach</h3>
                </div>
                <div class="form py-3">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Personal information</h3>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="First name" name="fname" data-required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Last name" name="lname">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" placeholder="ID card number" name="idcard" data-required>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="Telephone number" name="tel" data-required>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="gender" data-required>
                                        <option disabled selected>Select the gender</option>
                                        <option value="F">Female</option>
                                        <option value="M">Male</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="Telephone number" name="tel" data-required>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="box bg-light p-2">
                                    <h3>mentor's login cledentials</h3>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="email" placeholder="Email address of the mentor" name="email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="password" name="password" data-required>
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