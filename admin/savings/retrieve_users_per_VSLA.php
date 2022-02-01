<?php
// import all required files

require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/db_connection.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/db_operations/db_basic_functions.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/db_operations/classBeneficiary.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/db_operations/classZone.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/db_operations/classVsla.php";

if (isset($_GET['getBeneficiaryVSLA'])) {
    try {
        $vsla = new VSLA($conn);
        $parish = new VSLA_zone();
        $beneficiary = new Beneficiary($conn);

        $sqlVSLA = "SELECT distinct beneficiaries.VSLA_id,beneficiaries.VSLA_id,vsla_groups.VSLA_name from beneficiaries inner join vsla_groups on (beneficiaries.VSLA_id = vsla_groups.VSLA_id) WHERE vsla_groups.status='active' order by VSLA_name ASC";

        $res = DB::selectFromDb($sqlVSLA, $conn);
        $results = array();
        $ben = array();

        if ($res === null) {
            $results = array("dataStatus" => "nodata");
        } else if ($res === false) {
            $results = array("dataStatus" => "error");
            array_push($results, array("error" => $conn->error));
        } else {
            while ($row = $res->fetch_assoc()) {
                $ben = array();
                $sqlBeneficiary = "SELECT beneficiaries.fname, beneficiaries.lname, beneficiaries.VSLA_id, beneficiaries.beneficiary_id_card from beneficiaries where beneficiaries.VSLA_id = $row[VSLA_id] order by lname asc";
                $rowBen = DB::selectFromDb($sqlBeneficiary, $conn);

                if ($rowBen === null) array_push($results, array("dataStatus" => "nodata"));
                elseif ($rowBen === false) array_push($results, array("dataStatus" => "error", "error" => $conn->error));

                // fetch the detailed beneficiary information
                while ($fetchBen = $rowBen->fetch_assoc()) {
                    array_push($ben, array("fname" => $fetchBen["fname"], "lname" => $fetchBen["lname"], "beneficiary_id_card" => $fetchBen["beneficiary_id_card"]));
                }

                // fetch the beneficiary financial information

                array_push($results, array("VSLA_id" => $row["VSLA_id"], "VSLA_name" => $row["VSLA_name"], "members" => $ben));
            }
        }
    } catch (Exception $e) {
        array_push($results, array("errorEsception" => $e->getMessage()));
    }

    echo json_encode($results);
}
