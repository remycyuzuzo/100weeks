<?php
// condition to make sure the login request was made
if (isset($_POST['email'])) {
    require "./db_connection.php";
    include "../dependencies.php";
    /** Email address entered by the user through the form */
    $email = $conn->real_escape_string($_POST['email']);
    /** Password obtained through the form */
    $password = $conn->real_escape_string($_POST['password']);

    $url = URL;

    $sql = "SELECT email, password, user_type,status from  system_users
            INNER JOIN administrator ON (admin_id=user_id) 
            WHERE email='$email' and password = '$password' and status = 'active'";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<script>window.location = '$url/admin/dashboard.php'</script>";
    } else {
        echo "you got it wrong dude";
    }
}
