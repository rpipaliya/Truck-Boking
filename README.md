# Truck Booking System

A professional PHP + JavaScript web application for managing truck bookings, customer accounts, driver management, and transporter operations.

## 🚀 Features

- **Admin Dashboard** - Complete management system with analytics and reporting
- **Customer Portal** - Browse trucks, make bookings, track orders
- **Driver Management** - Driver authentication and order management
- **Transporter Module** - Manage fleet and operations
- **Responsive Design** - Mobile-friendly interface
- **Real-time Notifications** - Order status updates
- **Advanced Reporting** - Daily, monthly, and yearly analytics

## 📁 Project Structure

```
Truck-Booking-System/
├── admin/              # Admin dashboard & management system
├── customer/           # Customer-facing application
├── driver/             # Driver portal and order management
├── transporter/        # Transporter fleet management
├── api/                # REST API endpoints
├── assets/
│   ├── css/            # Stylesheets
│   ├── js/
│   │   └── custom/     # Custom JavaScript (not third-party libs)
│   └── images/         # Static images and icons
├── database/           # SQL schema and migrations
│   └── truckbooking.sql
├── config.example.php  # Configuration template
└── README.md           # This file
```

## 🔧 Installation

### Prerequisites

- PHP 7.4+
- MySQL 5.7+
- Apache/Nginx with mod_rewrite
- Composer (optional, for dependencies)

### Setup Steps

1. **Clone or extract the project**
   ```bash
   cd Truck-Booking-System
   ```

2. **Configure Database**
   - Copy `config.example.php` to `config.php`
   - Update database credentials
   - Import `database/truckbooking.sql` into your MySQL server

3. **Set file permissions**
   ```bash
   chmod -R 755 .
   chmod -R 777 uploads/
   ```

4. **Update application settings**
   - Edit `config.php` with your actual credentials
   - Set API keys for third-party services

## 📋 Configuration

Copy `config.example.php` to `config.php` and add your actual values:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'password');
define('DB_NAME', 'truckbooking');
```

**Never commit `config.php` with real credentials.**

## 🔐 Security Notes

- All database credentials should be stored in environment variables
- API keys are never committed to version control
- Sensitive configuration is excluded in `.gitignore`
- Use HTTPS in production
- Implement proper input validation and sanitization

## 👥 Module Overview

### Admin (`/admin`)
- Dashboard with KPIs and analytics
- User management (customers, drivers, transporters)
- Booking management and reports
- System configuration

### Customer (`/customer`)
- Registration and authentication
- Browse available trucks
- Make and manage bookings
- Track orders in real-time
- Payment processing
- Profile management

### Driver (`/driver`)
- Driver authentication
- View assigned orders
- Accept/reject bookings
- Complete deliveries
- Earnings tracking

### Transporter (`/transporter`)
- Fleet management
- Vehicle registration
- Operations oversight
- Revenue reports

## 💻 Key Technologies

- **Backend**: PHP (Procedural + OOP)
- **Frontend**: HTML5, CSS3, JavaScript (Vanilla + jQuery)
- **Database**: MySQL/MariaDB
- **Libraries**: Bootstrap, jQuery, Chart.js, Google Maps API

## 📦 Custom Assets

All custom JavaScript is located in `assets/js/custom/`. Third-party libraries are kept separate to highlight custom development work.

## 🤝 Contributing

1. Create a feature branch
2. Commit changes with clear messages
3. Push to repository
4. Submit pull request

## 📝 License

This project is proprietary. All rights reserved.

## 👤 Author

Truck Booking System Development Team

---

**Last Updated**: 2026-05-26  
**Version**: 1.0.0
