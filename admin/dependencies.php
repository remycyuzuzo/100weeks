<?php

/** db connection */
define("DB_CONNECT", $_SERVER["DOCUMENT_ROOT"] . "admin/backend/db_connection.php");

/** project url */
define('URL', 'http://100weeks.test', true);

/** path of bootstrap.min.css file, replace this during production with remote package */
define("BOOTSTRAP_CSS", URL . "/node_modules/bootstrap/dist/css/bootstrap.min.css", true);

/** path of bootstrap.min.js file, replace this during production with remote package */
define("BOOTSTRAP_JS", URL . "/node_modules/bootstrap/dist/js/bootstrap.min.js", true);

/** Font awesome */
define("FONTAWESOME", URL . "/node_modules/@fortawesome/fontawesome-free/css/all.min.css");

/** Website icon */
define('FAVICON', URL . '/images/metadata/100weeks-logo.jpg');

/** AXIOS libraly */
define('AXIOS', URL . '/node_modules/axios/dist/axios.min.js');

/** vanillaJS DataTables */
define("DATATABLES_JS", URL . "/node_modules/vanilla-datatables/dist/vanilla-datatables.min.js");
define("DATATABLES_CSS", URL . "/node_modules/vanilla-datatables/dist/vanilla-datatables.min.css");
