<?php
/**
 * Database Configuration
 * IMPORTANT: Never commit actual credentials to version control
 * Copy this file to config.php and update with your actual values
 */

// Database credentials
define('DB_HOST', 'YOUR_DATABASE_HOST');      // localhost
define('DB_USER', 'YOUR_DATABASE_USER');      // root
define('DB_PASS', 'YOUR_DATABASE_PASSWORD');  // your_password
define('DB_NAME', 'YOUR_DATABASE_NAME');      // truckbooking

// API Configuration
define('API_KEY', 'YOUR_API_KEY');
define('API_SECRET', 'YOUR_API_SECRET');

// Email Configuration
define('MAIL_HOST', 'YOUR_MAIL_HOST');
define('MAIL_USER', 'YOUR_EMAIL_ADDRESS');
define('MAIL_PASS', 'YOUR_EMAIL_PASSWORD');

// Payment Gateway (if applicable)
define('PAYMENT_KEY', 'YOUR_PAYMENT_API_KEY');
define('PAYMENT_SECRET', 'YOUR_PAYMENT_SECRET');

// Google Maps API
define('GOOGLE_MAPS_API_KEY', 'YOUR_GOOGLE_MAPS_API_KEY');

// Application Settings
define('APP_NAME', 'Truck Booking System');
define('APP_VERSION', '1.0.0');
define('APP_URL', 'http://localhost/truck-booking');
?>
