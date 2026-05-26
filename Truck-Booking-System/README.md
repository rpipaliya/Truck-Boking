# Truck Booking System

This repository contains a complete PHP + JavaScript web application for managing truck bookings, driver assignments, customer orders, and transporter operations.

Whether you are running a small logistics company or building a transport management tool, this project brings together the key workflows needed to manage bookings, fleets, drivers, and reporting.

## What this project includes

- Admin dashboard for reporting, booking oversight, and user management
- Customer portal for browsing trucks, creating bookings, and tracking deliveries
- Driver portal for viewing assigned orders, updating status, and completing jobs
- Transporter module for managing fleet vehicles and operational details
- REST API endpoints for booking and truck data
- Structured assets and database setup files for a quick start

## Main features

- Admin dashboard with analytics and reporting
- Customer booking flow with order tracking
- Driver order acceptance, rejection, and completion
- Transporter fleet management and revenue reports
- Responsive UI for desktop and mobile
- Notifications and status updates for live order tracking
- Daily, monthly, and yearly performance reports

## Project structure

```
Truck-Booking-System/
├── admin/              # Admin dashboard and management tools
├── customer/           # Customer-facing interface
├── driver/             # Driver portal and order handling
├── transporter/        # Transporter fleet and operations tools
├── api/                # Backend endpoints for bookings and data
├── assets/             # Frontend assets and resources
│   ├── css/            # Stylesheets
│   ├── js/             # JavaScript files
│   │   └── custom/     # Custom application scripts
│   └── images/         # Static image assets
├── database/           # SQL schema and import files
│   └── truckbooking.sql
├── config.example.php  # Configuration template
└── README.md           # Project documentation
```

## Getting started

### Requirements

- PHP 7.4 or newer
- MySQL 5.7 or MariaDB
- Apache or Nginx web server
- Optionally Composer for dependencies

### Basic setup

1. Clone the project:

```bash
git clone https://github.com/rpipaliya/Truck-Boking.git
cd Truck-Boking
```

2. Create the database:

- Open your database tool (for example, phpMyAdmin)
- Create a new database named `truckbooking`
- Import `database/truckbooking.sql`

3. Configure the application:

```bash
cp config.example.php config.php
```

Then open `config.php` and update the values for your environment.

4. (Optional) Set file permissions on Linux/macOS:

```bash
chmod -R 755 .
chmod -R 777 uploads/
```

5. Open the app in your browser:

- Admin: `http://localhost/Truck-Boking/admin/`
- Customer: `http://localhost/Truck-Boking/customer/`
- Driver: `http://localhost/Truck-Boking/driver/`

## Configuration

Copy `config.example.php` to `config.php` and set your database connection:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'password');
define('DB_NAME', 'truckbooking');
```

> Do not store real credentials in version control.

## Security notes

- Keep credentials outside of public repositories
- Use HTTPS in production
- Validate and sanitize all input data
- Do not commit `config.php` with actual passwords

## Module overview

### Admin
- Manage users, bookings, and reports
- Configure system settings and view dashboard analytics

### Customer
- Register and log in
- Browse trucks and create bookings
- View order status and profile details

### Driver
- Sign in and view assigned orders
- Accept or reject bookings
- Mark orders as complete

### Transporter
- Manage vehicles and fleet details
- Track operations and revenue

## Technologies used

- PHP (procedural and some object-oriented code)
- HTML5, CSS3, JavaScript, jQuery
- MySQL / MariaDB
- Bootstrap, Chart.js, Google Maps API

## Custom code

Custom frontend scripts are stored in `assets/js/custom/`. Third-party libraries are kept separate from application code.

## Contribution

If you want to contribute:

1. Create a new feature branch
2. Commit your changes with clear messages
3. Push the branch
4. Open a pull request

## License

This project is proprietary.

## Author

Truck Booking System Development Team

