<aside class="side-bar d-flex flex-column justify-content-between">
    <div>
        <div class="user-name-box p-2">
            <div class="d-flex">
                <div class="image">
                    <div class="bg-primary" style="width: 40px; height: 40px; border-radius: 50%;"></div>
                </div>
                <div class="name">
                    <div class="px-2">
                        CYUZUZO J. Remy
                        <div class="authority">
                            Admin
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ul>
            <li><a href="<?= URL ?>/admin/dashboard.php">Dashboard</a></li>
            <li><a href="#">General report & exports</a></li>
            <li><a href="#">Weekly savings</a></li>
            <li><a href="#">Loans</a></li>
            <li class=""><a href="#">VLAS</a>
                <ul>
                    <li><a href="<?= URL ?>/admin/vsla.php">View VSLAS</a></li>
                    <li><a href="<?= URL ?>/admin/vsla-creation.php">Add a VSLA</a></li>
                    <li><a href="">VSLA properties</a></li>
                </ul>
            </li>
            <li><a href="#">Beneficiaries</a>
                <ul>
                    <li class=""><a href="">View beneficiaries</a></li>
                    <li><a href="<?= URL ?>/admin/beneficiary-registration-form.php">Add new beneficiaries</a></li>
                </ul>
            </li>
            <li><a href="users.php">System users</a>
                <ul>
                    <li><a href="users.php">Manage Users</a></li>
                    <li><a href="<?= URL ?>/admin/coaches/coaches.php">VSLA mentors</a></li>
                    <li><a href="<?= URL ?>/admin/admin-creation-form.php">System administrator</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <ul>
        <li><a href="#"><i class="fas fa-gear"></i> Change settings</a></li>
    </ul>
</aside>