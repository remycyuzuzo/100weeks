<?php
require $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
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

    <title>Coaches</title>
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
                        <div class="title d-flex justify-content-between">
                            <h3>Mentors/coaches</h3>
                            <div class="d-inline-block float-right">
                                <a href="<?= URL ?>/admin/coaches/new-coach-form.php" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> new coach</a>
                                <button class="btn btn-light btn-sm"><i class="fas fa-download"></i> download</button>
                            </div>
                        </div>

                        <div class="tab-contents">
                            <div class="table-responsive">
                                <table class="table table-hover" id="coachesTable">
                                    <thead>
                                        <th>#</th>
                                        <th>name</th>
                                        <th>location</th>
                                        <th>action</th>
                                    </thead>
                                    <tbody>
                                        <td>1</td>
                                        <td>Mukandayambaje</td>
                                        <td>Musanze</td>
                                        <td><button class="btn btn-sm btn-light"><i class="fas fa-edit"></i> edit</button></td>
                                    </tbody>
                                </table>
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
        const dataTable = new DataTable("#coachesTable");
    </script>
</body>

</html>