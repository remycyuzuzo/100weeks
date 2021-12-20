<aside class="side-bar d-flex flex-column justify-content-between">
    <ul>
        <li><a href="<?= URL ?>/admin/dashboard.php">Dashboard</a></li>
        <li><a href="#">Reports</a></li>
        <li><a href="#">Weekly savings</a>
            <ul>
                <li><a href="">This week's savings</a></li>
                <li><a href="">Social funds</a></li>
            </ul>
        </li>
        <li class=""><a href="#">VLAS</a>
            <ul>
                <li><a href="<?= URL ?>/admin/vsla.php">View VSLAS</a></li>
                <li><a href="<?= URL ?>/admin/vsla-creation.php">Add a VSLA</a></li>
                <li><a href="">VSLA properties</a></li>
            </ul>
        </li>
        <li><a href="#">Beneficiaries</a>
            <ul>
                <li><a href="">View beneficiaries</a></li>
                <li><a href="<?= URL ?>/admin/beneficiary-registration-form.php">Add new beneficiaries</a></li>
            </ul>
        </li>
        <li><a href="<?= URL ?>/admin/coach-registration-form.php">VSLA mentors</a></li>
        <li><a href="#">System users</a>
            <ul>
                <li><a href="users.php">Manage Users</a></li>
                <li><a href="<?= URL ?>/admin/admin-creation-form.php">System administrator</a></li>
            </ul>
        </li>
    </ul>
    <ul>
        <li><a href="#"><i class="fas fa-gear"></i> Change settings</a></li>
    </ul>
</aside>