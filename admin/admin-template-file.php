<?php
require "./dependencies.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= BOOTSTRAP_CSS ?>">
    <link rel="stylesheet" href="<?= FONTAWESOME ?>">
    <link rel="stylesheet" href="<?= URL ?>/res/css/admin-styles.css">
    <title>Sample page</title>
</head>

<body>
    <div id="root" class="h-100">
        <!-- top-nav -->
        <div class="top-nav bg-white d-flex justify-content-between align-items-center px-2">
            <div class="logo">
                <div class="sidebar-toggler logo d-flex ">
                    <div class="toggler d-flex justify-content-center align-items-center">
                        <button class="btn border" data-toggler><i class="fas fa-bars"></i></button>
                    </div>
                    <div class="logo-img">
                        <a href="<?= URL ?>/admin/dashboard.php">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 568 94">
                                <g fill="#001955">
                                    <path d="M287.9 72.6C287 73.4 286 74.1 285.1 74.8 280.6 77.9 275.5 79.3 270.1 79 260 78.4 250.8 71 248.3 60 247.9 58.1 247.7 56.1 247.7 54.2 247.6 44.6 247.6 35 247.6 25.5 247.6 24.3 247.6 23.1 247.8 21.9 248.6 17.7 252.4 14.6 256.5 14.8 260.8 15 264.3 18.3 264.7 22.7 264.8 23.6 264.8 24.5 264.8 25.4 264.8 35.1 264.8 46 264.8 55.6 264.8 59.4 267.2 62.4 270.8 63.1 274.5 63.9 278.6 61.1 279.2 57.2 279.3 56.6 279.3 56 279.3 55.5 279.3 45.3 279.3 33.9 279.3 23.7 279.3 19.4 282.1 15.9 286.2 15 290.8 13.9 295.7 17.4 296.3 22.2 296.5 23.3 296.5 24.3 296.5 25.4 296.5 35 296.5 45.9 296.5 55.6 296.5 59.4 298.9 62.4 302.5 63.2 306.5 64 310.7 60.7 310.9 56.5 311 54.1 311 50.6 311 48.2 311 40.6 310.9 33 311 25.4 311 23.7 310.9 22 311.6 20.3 313.1 16.8 316.7 14.4 320.2 14.8 324.3 15.3 327.4 18.3 328 22.3 328.2 23.4 328.2 24.4 328.2 25.4 328.2 35 328.2 44.6 328.1 54.2 328.1 66 320.5 75.9 309.2 78.5 301.5 80.2 294.6 78.2 288.5 73.1 288.3 72.9 288.1 72.8 287.9 72.6"></path>
                                    <path d="M413.3 29.3L413.3 39.2 414.1 39.2C421.4 39.2 428.7 39.2 436 39.2 439.8 39.2 442.7 41.6 443.4 45.3 444.2 49.4 440.9 53.7 436.6 53.7 429.2 53.8 421.7 53.7 414.3 53.7 414 53.7 413.7 53.7 413.4 53.7L413.4 64.5 414.1 64.5C421.7 64.5 429.3 64.5 436.9 64.5 440.4 64.5 443.4 66.8 444 70.1 445 74.5 441.8 78.6 437.3 78.9 437 78.9 436.7 78.9 436.4 78.9 426.2 78.9 416.1 79 405.9 78.9 404.5 78.9 403 78.7 401.6 78.3 398.6 77.4 397 75.2 396.5 72.2 396.4 71.4 396.3 70.6 396.3 69.8 396.3 54.5 396.3 39.3 396.3 24 396.3 22.9 396.4 21.8 396.7 20.8 397.5 17.4 400.1 15.3 403.7 15 404.5 14.9 405.4 14.9 406.3 14.9 416.4 14.9 426.6 14.9 436.7 14.9 440.4 14.9 443.3 17.2 444.1 20.8 444.9 25.1 441.5 29.3 437.2 29.3 429.5 29.3 421.8 29.3 414.2 29.3L413.3 29.3Z"></path>
                                    <path d="M355.8 29.3L355.8 39.2 356.6 39.2C363.9 39.2 371.2 39.2 378.5 39.2 382.3 39.2 385.2 41.6 385.9 45.3 386.7 49.5 383.3 53.7 379.1 53.7 371.6 53.8 364.2 53.7 356.7 53.7L355.8 53.7 355.8 64.5 356.6 64.5C364.2 64.5 371.8 64.5 379.4 64.5 382.9 64.5 385.9 66.9 386.5 70.1 387.4 74.6 384.3 78.6 379.7 78.9 379.5 78.9 379.2 78.9 378.9 78.9 368.7 78.9 358.6 79 348.4 78.9 346.9 78.9 345.4 78.7 344 78.3 341 77.4 339.5 75.2 339 72.2 338.8 71.4 338.8 70.5 338.8 69.7 338.8 54.5 338.8 39.3 338.8 24.1 338.8 22.6 338.9 21.1 339.5 19.7 340.7 16.7 343.1 15.3 346.2 15 347 14.9 348 14.9 348.9 14.9 359 14.9 369.1 14.9 379.2 14.9 382.9 14.9 385.8 17.3 386.6 20.9 387.4 25.1 384 29.3 379.7 29.3 372 29.4 364.4 29.3 356.8 29.3L355.8 29.3Z"></path>
                                    <path d="M541.3 13.8C548.3 13.8 554.9 15.4 561.1 18.5 564.1 20 565.8 23.1 565.4 26.3 564.9 29.6 562.6 32.2 559.3 32.9 557.4 33.4 555.6 33 553.9 32.2 550.9 30.8 547.8 29.6 544.5 29 541.7 28.4 538.8 28.3 535.9 29.1 535.1 29.3 534.3 29.7 533.6 30.1 532 31.1 531.2 34.4 533.7 35.9 535.4 37 537.2 37.4 539.1 37.9 543.1 38.8 547.2 39.6 551.2 40.7 554.2 41.4 557.1 42.6 559.8 44.2 563.8 46.7 566.7 50 567.6 54.7 569.2 63.7 565.7 73.1 555.5 77.5 552.1 78.9 548.6 79.6 545 79.9 539.5 80.3 534.1 79.9 528.7 78.5 525.1 77.6 521.7 76.1 518.5 74.1 515.6 72.3 514.4 69.5 515 66.2 515.4 63.2 517.8 60.6 520.8 59.9 522.9 59.4 524.9 59.7 526.8 60.9 530.4 63.2 534.3 64.7 538.5 65.2 541.2 65.5 544 65.7 546.6 64.7 547.6 64.3 548.5 63.9 549.3 63.2 551.3 61.5 551.1 58.8 549 57.2 547.5 56.1 545.8 55.5 544 55.1 540.4 54.3 536.8 53.6 533.3 52.7 529.8 51.9 526.4 50.8 523.2 49 519 46.5 516.1 43 515.1 38.1 513.6 30.5 516.6 23.2 523.1 18.8 526.5 16.4 530.4 15.1 534.6 14.5 536.8 14.1 538.6 13.8 541.3 13.8"></path>
                                    <path d="M504.2 64.8C498.6 59.2 487 47.8 486.7 47.5 487 47.2 498.4 35.9 504 30.4 506 28.3 506.9 25.8 506.5 22.9 506 18.9 502.4 15.8 498.4 15.8 495.8 15.7 493.8 16.7 492 18.5 485.1 25.4 477.6 32.7 470.7 39.6L470.7 38.9C470.7 33.6 470.7 28.4 470.7 23.1 470.7 22.4 470.7 21.7 470.6 21.1 469.8 16.6 465.4 13.5 460.9 14.3 456.8 15 453.8 18.5 453.8 22.7 453.8 29.9 453.8 37.1 453.8 44.3 453.8 53.3 453.8 62.3 453.8 71.3 453.9 76.8 459.1 80.7 464.4 79.4 468.1 78.4 470.7 75 470.7 71.1 470.7 66.1 470.7 61 470.7 56L470.7 55.2C471 55.5 471.2 55.6 471.4 55.8 476 60.4 480.5 64.9 485.1 69.5 487.6 72 490 74.4 492.4 76.8 496 80.3 501.6 79.9 504.7 76.1 507.5 72.7 507.3 67.9 504.2 64.8"></path>
                                    <path d="M118 27.9C110.1 27.9 106.9 35.2 106.9 46.9 106.9 58.5 110.1 66 118 66 125.9 66 129.1 58.5 129.1 46.9 129.1 35.2 125.9 27.9 118 27.9"></path>
                                    <path d="M118 81C98.7 81 89.7 64.3 89.7 46.9 89.7 29.5 98.7 12.8 118 12.8 137.3 12.8 146.3 29.5 146.3 46.9 146.3 64.3 137.3 81 118 81L118 81ZM82.1 93.8L154.5 93.8 154.5 0 82.1 0 82.1 93.8Z"></path>
                                    <path d="M188.9 19.2C188.9 30.8 192.1 38.2 200 38.2 207.9 38.2 211.1 30.8 211.1 19.2 211.1 7.5 207.9 0.2 200 0.2 192.1 0.2 188.9 7.5 188.9 19.2"></path>
                                    <path d="M224.1 0C226.9 5.6 228.3 12.3 228.3 19.2 228.3 36.6 219.3 53.3 200 53.3 180.7 53.3 171.7 36.6 171.7 19.2 171.7 12.3 173.1 5.6 176 0L164.1 0 164.1 93.8 175.9 93.8C180.3 85 188.2 78.8 200 78.8 211.8 78.8 219.8 85 224.1 93.8L236.6 93.8 236.6 0 224.1 0Z"></path>
                                    <path d="M49.4 71.3C49.4 75.8 45.7 79.6 41 79.6 36.3 79.6 32.5 75.8 32.5 71.3L32.5 31.1 29.8 31.1C25.3 31.1 21.5 27.4 21.5 22.6 21.5 17.9 25.3 14.2 29.8 14.2L41.1 14.2C43.4 14.2 45.5 15.1 47 16.7 48.5 18.2 49.4 20.3 49.4 22.5L49.4 71.3ZM0 93.8L72.4 93.8 72.4 0 0 0 0 93.8Z"></path>
                                </g>
                            </svg>
                        </a>

                    </div>
                </div>
            </div>
            <div class="user-menu">
                <button class="btn btn-light"><i class="fas fa-user"></i></button>
            </div>
        </div>
        <!-- ./top-nav -->

        <!-- side-bar menu -->
        <aside class="side-bar">
            <ul class="side-bar-menu">
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Reports</a></li>
                <li><a href="#"><i class="fas fa-plus"></i> Weekly savings</a></li>
                <li><a href="#">VLTS properties</a></li>
                <li><a href="#">VLTS</a></li>
                <li><a href="#">VLTS Coach info</a></li>
                <li><a href="#">System users</a></li>
                <li><a href="#">Change settings</a></li>
            </ul>
        </aside>
        <!-- ./side-bar -->

        <!-- main-contents -->
        <main class="main-contents">hell no</main>
        <!-- ./main-contents -->

        <!-- footer -->
        <footer></footer>
        <!-- ./end of footer -->
    </div>

    <!-- JAVASCRIPT FILES -->
    <script src="<?= URL ?>/res/js/admin-sidebar.js"></script>
    <script src="<?= BOOTSTRAP_JS ?>"></script>
</body>

</html>