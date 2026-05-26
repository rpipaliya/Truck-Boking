<?php
header("Content-Type: application/json");

require_once('conection.php');

// if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
//     parse_str(file_get_contents("php://input"), $_PUT);
    if (isset($_POST["email"]) && isset($_POST["old_password"]) && isset($_POST["new_password"]) && isset($_POST["confirm_password"])) {
        $email = $_POST["email"];
        $oldPassword = $_POST["old_password"];
        $newPassword = $_POST["new_password"];
        $confirmPassword = $_POST["confirm_password"];

        // Validate and sanitize user input
        $email = mysqli_real_escape_string($conn, $email);
        $oldPassword = mysqli_real_escape_string($conn, $oldPassword);
        $newPassword = mysqli_real_escape_string($conn, $newPassword);
        $confirmPassword = mysqli_real_escape_string($conn, $confirmPassword);

        // Fetch the user's current hashed password from the database
        $query = "SELECT *  FROM truck_driver WHERE driver_email='$email'";
        $result = mysqli_query($conn, $query);
        $oldpassword=md5($oldPassword);

        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $currentPassword = $row["driver_password"];
            // echo $currentPassword;
            // Verify the old password against the stored hashed password
            if ($oldpassword === $currentPassword) {
                // Check if new and confirm passwords match
                if ($newPassword === $confirmPassword) {
                    // Hash the new password for security
                    // $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                    // Update the password with the new hashed password
                    $newPassword=md5($newPassword);
                    echo$newPassword;
                    $updateQuery = "UPDATE truck_driver SET driver_password='$newPassword' WHERE driver_email='$email'";
                    $updateResult = mysqli_query($conn, $updateQuery);

                    if ($updateResult) {
                        $code = "password_changed";
                        $mess = "Password updated successfully";
                        $response["code"] = $code;
                        $response["message"] = $mess;
                    } else {
                        $code = "database_error";
                        $mess = "Failed to update password";
                        $response["code"] = $code;
                        $response["message"] = $mess;
                    }
                } else {
                    $code = "password_mismatch";
                    $mess = "New passwords do not match";
                    $response["code"] = $code;
                    $response["message"] = $mess;
                }
            } else {
                $code = "invalid_password";
                $mess = "Incorrect old password";
                $response["code"] = $code;
                $response["message"] = $mess;
            }
        } else {
            $code = "database_error";
            $mess = "Error retrieving current password";
            $response["code"] = $code;
            $response["message"] = $mess;
        }

        echo json_encode($response);
    } else {
        echo json_encode(["code" => "invalid_input", "message" => "Missing email, old_password, new_password, or confirm_password"]);
    }
// } 
// else {
//     echo json_encode(["code" => "invalid_request", "message" => "Invalid HTTP request method"]);
// }

mysqli_close($conn);
?>