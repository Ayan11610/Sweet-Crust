# Sweet Crust - Bakery Management System

A comprehensive bakery management system built with Laravel 9, featuring dual authentication, product management, order tracking, and inventory management.

## Documentation

For complete project documentation, including:
- Database Schema (ERD with Mermaid code)
- System Architecture
- Installation Guide
- API Routes
- Features Overview
- Troubleshooting Guide

**Please refer to: [PROJECT_DOCUMENTATION.md](PROJECT_DOCUMENTATION.md)**

## Login Credentials

For test accounts and login credentials, see: [LOGIN_CREDENTIALS.md](LOGIN_CREDENTIALS.md)

## Quick Start

1. **Install Dependencies**
```bash
composer install
```

2. **Configure Environment**
```bash
cp .env.example .env
php artisan key:generate
```

3. **Setup Database**
- Create database `sweet_crust_db`
- Update `.env` with database credentials
- Run migrations:
```bash
php artisan migrate
php artisan db:seed
```

4. **Start Server**
```bash
php artisan serve
```

5. **Access Application**
- Public Site: http://localhost:8000
- Staff Portal: http://localhost:8000/staff/login
- Customer Portal: http://localhost:8000/customer/login

##  Key Features

Dual Authentication (Staff and Customer)
Email Verification System
Product Management with Image Upload
Order Tracking and Management
Inventory Management with Low Stock Alerts
Role-Based Access Control
Responsive Design
jQuery DataTables Integration
 

##  Project Structure

```
sweet-crust/
├── app/                    # Application logic
├── database/              # Migrations & seeders
├── resources/views/       # Blade templates
├── public/               # Assets & images
├── routes/               # Route definitions
└── PROJECT_DOCUMENTATION.md  # Complete documentation
```

##  Technology Stack

- **Framework**: Laravel 9
- **Database**: MySQL
- **Frontend**: Blade, Custom CSS, jQuery
- **Authentication**: Laravel Guards
- **Email**: Gmail SMTP

## Support

For detailed documentation, troubleshooting, and more information, see [PROJECT_DOCUMENTATION.md](PROJECT_DOCUMENTATION.md) or contact Muhammad Ayan 

---

 
**Last Updated**: 22 December 2025  
# Sweet-Crust
