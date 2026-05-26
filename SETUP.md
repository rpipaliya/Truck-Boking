# Setup Guide - Truck Booking System

## Quick Start

### 1. Prerequisites Installation

**Windows:**
- Download XAMPP from https://www.apachefriends.org/
- Install with Apache, MySQL, PHP 7.4+
- Start Apache and MySQL from Control Panel

**Mac:**
- Use Homebrew: `brew install php mysql`
- Or download MAMP: https://www.mamp.info/

**Linux:**
- Ubuntu/Debian: `sudo apt-get install apache2 php mysql-server`
- CentOS/RHEL: `sudo yum install httpd php mysql-server`

### 2. Clone/Extract Project

```bash
cd /var/www/html  # or equivalent document root
git clone <repository-url>
cd Truck-Booking-System
```

### 3. Database Setup

#### Windows (XAMPP):
1. Open phpMyAdmin: http://localhost/phpmyadmin
2. Create new database: `truckbooking`
3. Go to Import tab
4. Select `database/truckbooking.sql`
5. Click Import

#### Linux/Mac:
```bash
mysql -u root -p -e "CREATE DATABASE truckbooking;"
mysql -u root -p truckbooking < database/truckbooking.sql
```

### 4. Configure Application

```bash
cp config.example.php config.php
```

Edit `config.php` with your settings:
- Database host, user, password
- API keys (if using external services)
- Email configuration
- Application URL

### 5. Set Permissions (Linux/Mac)

```bash
chmod -R 755 .
chmod -R 777 uploads/ 2>/dev/null || mkdir uploads && chmod 777 uploads
```

### 6. Access Application

- **Admin**: http://localhost/Truck-Booking-System/admin/
- **Customer**: http://localhost/Truck-Booking-System/customer/
- **Driver**: http://localhost/Truck-Booking-System/driver/
- **API**: http://localhost/Truck-Booking-System/api/

---

## Directory Permissions

```bash
# Recommended permissions
uploads/      → 777 (read, write, execute for all)
uploads/*     → 666 (read, write for all)
database/     → 755 (read, execute for all)
config/       → 755 (read, execute for all)
```

## Troubleshooting

### Database Connection Error
- Verify MySQL is running: `mysql -u root -p -e "SELECT 1;"`
- Check `config.php` credentials
- Ensure `truckbooking` database exists

### Blank Page on Admin/Customer
- Check PHP error logs: `tail -f /var/log/php_errors.log`
- Verify all PHP files are in correct directories
- Enable PHP error reporting in `config.php`

### File Upload Issues
- Ensure `uploads/` directory exists and has 777 permissions
- Check file size limits in `php.ini`: `upload_max_filesize = 100M`

### CSS/JS Not Loading
- Check if `assets/` folder is accessible
- Verify relative paths in PHP files
- Clear browser cache (Ctrl+Shift+Delete)

---

## Development Tips

### Adding New Custom JS
1. Create file in `assets/js/custom/`
2. Name it descriptively: `booking-validation.js`
3. Include in HTML: `<script src="/assets/js/custom/booking-validation.js"></script>`

### Adding New Modules
1. Create folder under root: `modules/new-module/`
2. Organize with: `index.php`, `controller.php`, `view.php`
3. Update `config.php` if needed

### Database Migrations
- New schema changes go in `database/migrations/`
- Document changes in `database/CHANGELOG.md`

### Version Control
Always run before committing:
```bash
git status
# Ensure config.php is NOT listed
# Ensure .env and secrets are NOT listed
```

---

## Production Deployment

### Pre-Deployment Checklist
- [ ] Database backed up
- [ ] All credentials in `config.php` (not committed)
- [ ] File permissions set correctly
- [ ] HTTPS certificate installed
- [ ] Error logs directed to secure location
- [ ] .gitignore reviewed

### Recommended Server Setup
```
Document Root: /var/www/html/Truck-Booking-System/
PHP Version: 7.4 or higher
MySQL Version: 5.7 or higher
SSL: Let's Encrypt (free)
Firewall: Block direct access to config files
```

### Server Configuration (Apache)
```apache
<VirtualHost *:443>
    ServerName your-domain.com
    DocumentRoot /var/www/html/Truck-Booking-System
    
    <Directory /var/www/html/Truck-Booking-System>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

---

## Support & Questions

For issues, check:
1. README.md (Feature documentation)
2. This file (Setup help)
3. PHP error logs
4. MySQL error logs

**Contact Development Team** for additional support.
