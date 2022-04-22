<?php
require "../dependencies.php";

$db = new DB();

try {
    $sqlZone = "SELECT * from vsla_zones where vsla_zone_type = 'parish'";
    $res = $db->selectFromDb($sqlZone);

    if ($res === false) throw new Exception("Error while fetching parish data", 1);
    if ($res === null) throw new Exception("Nothing found", 1);

    $response = array();

    while ($row = $res->fetch_assoc()) {

        $total_savings_in_zone = 0;
        $total_social_funds_in_zone = 0;
        $total_zone_loan_amount = 0;
        $number_of_loans = 0;
        $total_zone_members = 0;
        $number_of_vsla = 0;
        $parish_name = $row["vsla_zone_name"];
        $parish_id = $row["vsla_zone_id"];
        $zone_assets_value = 0;
        $number_of_savings = 0;
        $total = 0;

        // check vslas that are in the current VSLA zone
        $sqlVSLA = "SELECT VSLA_id from vsla_groups where vsla_zone_id = $row[vsla_zone_id] AND status = 'active'";
        $res1 = $db->selectFromDb($sqlVSLA);

        if ($res1 === null) {
            $info_array = array(
                "parishID" => $parish_id, #v
                "parishName" => $parish_name, #v
                "totalSavings" => $total_savings_in_zone, #v
                "totalSocialFunds" => $total_social_funds_in_zone, #v
                "numberOfVSLAs" => $number_of_vsla, #v
                "totalMembersInZone" => $total_zone_members, #v
                "totalLoanAmount" => $total_zone_loan_amount, #v
                "numberOfLoans" => $number_of_loans,
                "numberOfSavings" => $number_of_savings,
                "valueOfVSLAAssets" => $zone_assets_value,
                "total" => $total
            );
            array_push($response, $info_array);
            continue;
        }

        // loop through the VSLA table looking for VSLAs that belong in the current VSLA zone
        while ($row1 = $res1->fetch_assoc()) {

            $number_of_vsla += 1;

            $sql_beneficiary = "SELECT beneficiary_id_card,number_of_shares from beneficiaries WHERE VSLA_id = $row1[VSLA_id] AND status='active'";
            $res_beneficiary = $db->selectFromDb($sql_beneficiary);
            if ($res_beneficiary === null) {
                continue;
            }
            if ($res_beneficiary === false) throw new Error("error: " . $conn->error);


            while ($row_beneficiary = $res_beneficiary->fetch_assoc()) {
                $total_zone_members += 1;
                # find beneficiary savings
                $sql_savings = "SELECT sum(amount) as total_savings from saving_records where beneficiary_id='$row_beneficiary[beneficiary_id_card]'";
                $res_savings = $db->selectFromDb($sql_savings);
                if ($res_savings !== null or $res_savings !== false) {
                    $row_savings = $res_savings->fetch_assoc();
                    $total_savings_in_zone += $row_savings["total_savings"];
                    $number_of_savings += $row_beneficiary["number_of_shares"];
                }
                # find all about social funds
                $sql_socialfunds = "SELECT sum(amount) as totalSs from social_funds_records where beneficiary_id='$row_beneficiary[beneficiary_id_card]'";
                $res_ss = $db->selectFromDb($sql_socialfunds);
                if ($res_ss !== null or $res_ss !== false) {
                    $row_ss = $res_ss->fetch_assoc();
                    $total_social_funds_in_zone += $row_ss["totalSs"];
                }
                # find about Loans
                $sql_loan = "SELECT sum(loan_amount) as total_loan, count(loan_amount) as loan_number from loan_information where beneficiary_id='$row_beneficiary[beneficiary_id_card]'";
                $res_loan = $db->selectFromDb($sql_loan);
                if ($res_loan !== null or $res_loan !== false) {
                    $row_loan = $res_loan->fetch_assoc();
                    $total_zone_loan_amount += $row_loan["total_loan"];
                    $number_of_loans += $row_loan["loan_number"];
                }
            } // Beneficiaries
        } // VSLA groups
        $total = $total_savings_in_zone + $total_social_funds_in_zone + $total_zone_loan_amount + $zone_assets_value;
        $info_array = array(
            "parishID" => $parish_id, #v
            "parishName" => $parish_name, #v
            "totalSavings" => $total_savings_in_zone, #v
            "totalSocialFunds" => $total_social_funds_in_zone, #v
            "numberOfVSLAs" => $number_of_vsla, #v
            "totalMembersInZone" => $total_zone_members, #v
            "totalLoanAmount" => $total_zone_loan_amount, #v
            "numberOfLoans" => $number_of_loans,
            "numberOfSavings" => $number_of_savings,
            "valueOfVSLAAssets" => $zone_assets_value,
            "total" => $total
        );
        array_push($response, $info_array);
    } // VSLAzone loop
    $response = array("result" => true, "parishes" => $response);
    echo json_encode($response);
} catch (Exception $e) {
    $response = array("result" => false, "message" => $e->getMessage() . ", on file: '" . __FILE__ . "'" . ", on line " . $e->getLine());
    echo json_encode($response);
} catch (Error $e) {
    $response = array("result" => false, "message" => $e->getMessage() . ", on file: '" . __FILE__ . "'" . ", on line " . $e->getLine());
    echo json_encode($response);
}
