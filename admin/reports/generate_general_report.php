<?php
require $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
require DB_CONNECT;
require ROOT . "admin/backend/db_operations/db_basic_functions.php";

try {
    $sql = "";

    $vsla_zone_type = VSLA_ZONE_TYPE;
    $sql_vsla_zone = "SELECT vsla_zone_id, vsla_zone_name from vsla_zones 
                        where vsla_zone_type='$vsla_zone_type'";
    $res = DB::selectFromDb($sql_vsla_zone, $conn);

    // check whether returned results are valid
    if ($res === false) {
        throw new Exception("Error in fetching $vsla_zone_type data");
    } else if ($res === null) {
        throw new Exception("can't find any $vsla_zone_type");
    }

    $response = array();

    while ($row = $res->fetch_assoc()) {
        $total_savings_in_zone = 0;
        $total_social_funds_in_zone = 0;
        $total_zone_loan_amount = 0;
        $number_of_loans = 0;
        $total_zone_members = 0;
        $number_of_vsla = 0;
        $parish_name = "";

        $sql_vsla = "SELECT count(vsla_id), vsla_id from vsla_groups
                        where status='active' AND vsla_zone_id=$row[vsla_zone_id]";
        $res = DB::selectFromDb($sql_vsla, $conn);
        if ($res === false) throw new Exception("Error in fetching member's financial data " . $conn->error);
        elseif ($res === null) continue;

        while ($row2 = $res->fetch_assoc()) {
            $sql_savings = "
                SELECT
                vsla_zones.vsla_zone_id AS vsla_parish_id,
                vsla_zones.vsla_zone_name AS vsla_zone_name,
                SUM(saving_records.amount) AS total_zone_savings_amount,
                COUNT(vsla_groups.VSLA_id) AS number_of_vsla,
                COUNT(
                    beneficiaries.beneficiary_id_card
                ) AS ben_number,
                SUM(loan_information.loan_amount) AS loan_amount,
                COUNT(loan_information.loan_id) AS number_of_loans,
                SUM(social_funds_records.amount) AS total_social_funds_amount
                FROM
                    saving_records
                LEFT JOIN beneficiaries ON
                    (
                        `saving_records`.`beneficiary_id` = `beneficiaries`.`beneficiary_id_card`
                    )
                LEFT JOIN loan_information ON
                    (
                        `loan_information`.`beneficiary_id` = `beneficiaries`.`beneficiary_id_card` AND `loan_information`.`loan_status` = 'active'
                    )
                LEFT JOIN social_funds_records ON(
                        `social_funds_records`.`beneficiary_id` = `beneficiaries`.`beneficiary_id_card`
                    )
                JOIN vsla_groups ON
                    (
                        `vsla_groups`.`VSLA_id` = `beneficiaries`.`vsla_id`
                    )
                INNER JOIN vsla_zones ON
                    (
                        `vsla_zones`.`vsla_zone_id` = `vsla_groups`.`vsla_zone_id`
                    )
                WHERE
                    vsla_groups.vsla_zone_id = $row[vsla_zone_id]
            ";

            $res = DB::selectFromDb($sql_savings, $conn);
            $row3 = $res->fetch_assoc();

            $parish_name = $row3["vsla_zone_name"];
            $total_savings_in_zone += $row3["total_zone_savings_amount"];
            $total_social_funds_in_zone += $row3["total_social_funds_amount"];
            $number_of_vsla += $row3["number_of_vsla"];
            $total_zone_members += $row3["ben_number"];
            $total_zone_loan_amount += $row3["loan_amount"];
            $number_of_loans = $row3["number_of_loans"];
            $parish_id = $row3["vsla_parish_id"];

            $info_array = array(
                "result" => true,
                "parishID" => $parish_id,
                "parishName" => $parish_name,
                "totalSavings" => $total_savings_in_zone,
                "totalSocialFunds" => $total_social_funds_in_zone,
                "numberOfVSLAs" => $number_of_vsla,
                "totalMembersInZone" => $total_zone_members,
                "totalLoanAmount" => $total_zone_loan_amount,
                "numberOfLoans" => $number_of_loans
            );
            array_push($response, $info_array);
        }
    }

    echo json_encode($response);

    // if (isset($_GET["lifetime_report"])) {
    //     #
    // } elseif (isset($_GET["monthly_report"])) {
    //     #
    // } elseif (isset($_GET["current_month_report"])) {
    //     # code...
    // } else {
    //     throw new Exception("incomplete request parameters");
    // }
} catch (Exception $e) {
    $response = array("result" => false, "message" => $e->getMessage());
    echo json_encode($response);
}
