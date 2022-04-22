<?php
include "../includes/head.php";
?>
<!-- main-contents -->
<main class="main-contents">
    <div class="container">
        <div class="card wrapper">
            <div class="card-header">
                <h3>VSLAs</h3>
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
                <div class="tab-nav">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" data-vslaTab="view-vsla" href="#">All VSLAs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-vslaTab="new-vsla" href="#">New VSLA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-vslaTab="vsla-property" href="#">VSLA Properties</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-vslaTab="vsla-reports" href="#">VSLA Reports</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-contents"></div>
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
<script src="<?= AXIOS ?>"></script>
<script src="<?= URL ?>/res/js/admin-sidebar.js"></script>
<script src="<?= BOOTSTRAP_JS ?>"></script>

<script src="/res/js/vsla-tab-switching.js" type="module">

</script>

</body>

</html>