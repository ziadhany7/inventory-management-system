<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="#"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="#"><img src="https://img.shields.io/badge/Laravel-12.x-red" alt="Laravel Version"></a>
  <a href="#"><img src="https://img.shields.io/badge/PHP-8.2%2B-blue" alt="PHP Version"></a>
  <a href="#"><img src="https://img.shields.io/badge/License-MIT-green" alt="License"></a>
</p>

# Inventory Management System API

A robust, scalable, and secure RESTful API built with **Laravel 12** for managing multi-warehouse inventories. This project demonstrates advanced software engineering patterns, including **SOLID principles**, **Repository Pattern**, and **Event-Driven Architecture**.



## 🚀 Technical Highlights

### 1. Architecture & Design Patterns
- **Repository Pattern:** Decouples the data access layer from the business logic, making the application easier to maintain and test.
- **Service Layer:** Encapsulates complex business processes (like stock transfers) to keep Controllers thin and reusable.
- **Dependency Inversion:** Utilizes Interfaces for Repositories to ensure seamless swapping of data sources.

### 2. Core Features
- **Stock Transfers:** Atomic operations using **Database Transactions** to ensure data integrity during transfers between warehouses.
- **Low Stock Alerts:** An **Event-Driven** system that triggers a `LowStockDetected` event when inventory falls below a threshold (5 units).
- **Performance Optimization:** Implemented **Response Caching** for inventory listings and **Eloquent Pagination** for high-performance data retrieval.
- **Security:** API endpoints are secured using **Laravel Sanctum**. Input validation is handled via dedicated **Form Requests**.

### 3. Automated Testing
Comprehensive test suite covering critical paths:
- **Unit Tests:** Validating core logic for stock calculations.
- **Feature Tests:** End-to-end testing for the Transfer API (Status 201, 403, etc.).
- **Event Testing:** Mocking events to verify that low-stock alerts are dispatched correctly.

---

## 📖 API Documentation

Detailed API documentation, including request/response examples and authentication details, can be found here:

👉 **[https://ziad-hany.docs.buildwithfern.com/inventory-management-system-task/inventory/get-warehouses-warehouse-id-inventory]** ---

Postman Documentation
👉 **[https://documenter.getpostman.com/view/43110145/2sBXcLhdUt]** ---

## 🛠️ Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/ziadhany7/inventory-management-system
   cd inventory-management-system

2. **Install dependencies:**
    ```bash
    composer install

3. **Environment Setup:**
    ```bash
    cp .env.example .env
    # Update your DB_DATABASE, DB_USERNAME, and DB_PASSWORD in .env
4. **Database Migration & Seeding:**
    ```bash
    php artisan migrate --seed
5. **Generate Security Key:**
    ```bash
    php artisan key:generate
6. 🧪 **Running Tests**
To verify that all components are functioning correctly, run the following command:
    ```bash
    php artisan test
    # Current Status: 5 Passing Tests (6 Assertions).

## 📝 Logging & Monitoring**

Low stock alerts are handled by a queued Listener. You can find the logs at:
    ```bash
    storage/logs/laravel.log
    ```
    
## 👨‍💻 About the Developer
**Ziad Hany Wadea - Senior Backend Developer**
**(ziadhanyimportant1@gmail.com)**

I specialize in building high-performance web applications and scalable API architectures. You can view my full professional background and experience here:

## 📄 View My Curriculum Vitae (CV)
**(https://drive.google.com/file/d/1RllBe9JJl5YZM9aHG6IMtIYXART1Npo6/view?usp=drive_link)**
