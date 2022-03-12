<?php

function displayAlert($message, $type = "danger")
{
    return "<div class=\"alert alert-$type\">$message</div>";
}

function displayBeneficiaryData($res_data, $conn)
{
?>
    <div class="table-responsive">
        <table class="table table-hover" id="beneficiariesTable">
            <thead>
                <th>#</th>
                <th>name</th>
                <th>Parish</th>
                <th>VSLA</th>
                <th></th>
            </thead>
            <tbody>

                <?php
                $i = 0;
                $vsla_zone = new VSLA_zone();
                $vsla = new VSLA($conn);

                while ($row = $res_data->fetch_assoc()) {
                    $vsla_info = $vsla->getSingleVSLAInfo($row["VSLA_id"]);
                    $zone_info = $vsla_zone->getSingleZoneInfo($vsla_info["vsla_zone_id"]);
                ?>
                    <tr data-beneficiary_id="<?= $row["beneficiary_id_card"] ?>">
                        <td><?= ++$i ?></td>
                        <td><a href="<?= URL ?>/admin/beneficiaries/view-beneficiaries.php?view-single=true&beneficiary-id=<?= $row["beneficiary_id_card"] ?>"><?= $row["lname"] . " " . $row["fname"] ?></a></td>
                        <td><?= $zone_info["vsla_zone_name"] ?></td>
                        <td><?= $vsla_info["VSLA_name"] ?></td>
                        <td><button class="btn btn-sm btn-light"><i class="fas fa-edit"></i> edit</button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php
}

function displaySingleBeneficiaryData($beneficiary_info)
{
?>
    <div class="row">
        <div class="col-md-6">
            <h3><?= "$beneficiary_info[fname] $beneficiary_info[lname]" ?></h3>
        </div>
        <div class="col-md-4">
            <div class="image">
                <img src="<?= URL ?>/images/vsla_<?= $beneficiary_info["VSLA_id"] ?>/beneficiaries/<?= $beneficiary_info["profile_picture"] ?>" alt="<?= $beneficiary_info["fname"] . " " . $beneficiary_info["lname"] ?>" class="w-100">
            </div>
        </div>
    </div>
<?php
}
?>