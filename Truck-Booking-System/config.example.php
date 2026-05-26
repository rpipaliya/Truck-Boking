<?php
/**
 * 🔐 Configuration File - Truck Booking System
 * 
 * HOW TO USE THIS FILE:
 * 1. Copy this file and name it: config.php
 * 2. Update all YOUR_* values with your actual credentials
 * 3. NEVER commit config.php to Git (it's in .gitignore for safety)
 * 4. Keep this file safe - it contains sensitive information
 */

// ===================================
// DATABASE CONNECTION SETTINGS
// ===================================
define('DB_HOST', 'YOUR_DATABASE_HOST');      // Usually: localhost
define('DB_USER', 'YOUR_DATABASE_USER');      // Usually: root (XAMPP)
define('DB_PASS', 'YOUR_DATABASE_PASSWORD');  // Your MySQL password
define('DB_NAME', 'YOUR_DATABASE_NAME');      // Database name: truckbooking

// ===================================
// EXTERNAL APIs
// ===================================
define('API_KEY', 'YOUR_API_KEY');            // Your custom API key
define('API_SECRET', 'YOUR_API_SECRET');      // Your API secret key

// ===================================
// EMAIL CONFIGURATION
// ===================================
define('MAIL_HOST', 'YOUR_MAIL_HOST');        // SMTP server (e.g., smtp.gmail.com)
define('MAIL_USER', 'YOUR_EMAIL_ADDRESS');    // Your email address
define('MAIL_PASS', 'YOUR_EMAIL_PASSWORD');   // Your email password (or app password)

// ===================================
// PAYMENT GATEWAY (Optional)
// ===================================
define('PAYMENT_KEY', 'YOUR_PAYMENT_API_KEY');      // Stripe/PayPal API key
define('PAYMENT_SECRET', 'YOUR_PAYMENT_SECRET');    // Stripe/PayPal secret key

// ===================================
// GOOGLE MAPS (For Real-time Tracking)
// ===================================
define('GOOGLE_MAPS_API_KEY', 'YOUR_GOOGLE_MAPS_API_KEY');

// ===================================
// APPLICATION SETTINGS
// ===================================
define('APP_NAME', 'Truck Booking System');
define('APP_VERSION', '1.0.0');
define('APP_URL', 'http://localhost/truck-booking');
define('DEBUG', false);  // Set to true for development, false for production

// ===================================
// 💡 HELPFUL LINKS
// ===================================
// Get Google Maps API Key: https://console.cloud.google.com/
// Get Stripe API Key: https://stripe.com/
// Setup Gmail: https://myaccount.google.com/apppasswords
// MySQL Setup: Use XAMPP/WAMP/Local server
?>
