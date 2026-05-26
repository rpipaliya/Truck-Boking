
<?php
/**
 * Database Configuration
 * NOTE: Use config.php in root directory with actual credentials
 */

// Placeholder - DO NOT COMMIT WITH REAL CREDENTIALS
$servername = getenv('DB_HOST') ?: 'YOUR_DATABASE_HOST';
$username = getenv('DB_USER') ?: 'YOUR_DATABASE_USER';
$password = getenv('DB_PASS') ?: 'YOUR_DATABASE_PASSWORD';
$dbname = getenv('DB_NAME') ?: 'YOUR_DATABASE_NAME';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    error_log('Database connection failed: ' . mysqli_connect_error());
    die('Database connection error');
}
?>