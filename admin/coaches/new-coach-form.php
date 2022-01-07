<?php
require $_SERVER["DOCUMENT_ROOT"] . "admin/dependencies.php";
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

    <script src="<?= AXIOS ?>"></script>

    <title>Coaches</title>
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
                    <div class="card-body">
                        <div class="title">
                            <a href="<?= URL ?>/admin/coaches/coaches.php" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> back to the list</a>
                        </div>
                        <div class="tab-contents">
                            <span class="text-muted"><i class="fas fa-question-circle"></i> fill the form as required</span>
                            <div class="form py-3">
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="grouped-fields">
                                                <h3 class="title bg-primary"><i class="fas fa-user-circle"></i> Personal information</h3>
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
                                                    <label>Gender</label>
                                                    <fieldset class="py-2">
                                                        <input type="radio" name="gender" value="F" id="radioFemale"> <label for="radioFemale">Female</label>
                                                        <input type="radio" name="gender" id="radioMale" value="M"> <label for="radioMale">Male</label>
                                                    </fieldset>
                                                </div>
                                                <div class="form-group">
                                                    <input type="tel" class="form-control" placeholder="Telephone number" name="tel" data-required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <div class="grouped-fields box bg-light p-2">
                                                <h3 class="title bg-primary"><i class="fas fa-key"></i> mentor's login cledentials</h3>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="email" placeholder="Email address of the mentor" name="email">
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control" placeholder="password" name="password" data-required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="my-2 py-1">
                                                <label for="redirect">
                                                    <input type="checkbox" name="redirect" id="redirect">
                                                    stay on this page after inserting this mentor
                                                </label>
                                            </div>
                                            <div class="submit-btn">
                                                <button type="button" class="btn btn-secondary">Cancel</button>
                                                <button type="submit" class="btn btn-primary" name="send">Submit</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
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
    <script src="<?= URL ?>/res/js/form-validators/mentor-validate.js" type="module"></script>
    <script src="<?= BOOTSTRAP_JS ?>"></script>
</body>

</html>