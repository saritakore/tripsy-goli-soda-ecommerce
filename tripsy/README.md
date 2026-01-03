# Tripsy Goli Soda – E-Commerce Web Application

A complete e-commerce web application developed for **Andodagi & Son’s** to manage online sales of **Tripsy Goli Soda**.  
This project provides a centralized platform for product management, customer management, order processing, and billing.

---

## 📌 Project Overview

The system is designed to reduce manual work, improve efficiency, and maintain accurate records for a small-scale beverage manufacturing company.  
It supports both **User** and **Admin** roles with separate access and functionalities.

---

## 🔧 Technologies Used

- **Frontend:** HTML, CSS, JavaScript  
- **Backend:** PHP  
- **Database:** MySQL  
- **Server:** XAMPP (Apache & MySQL)

---

## ✨ Features

### 👤 User Module
- User Registration & Login
- View Products
- Add to Cart with Quantity Management
- Checkout & Billing
- Order History with Real-Time Order Status
- User Profile (My Account)

### 🛠 Admin Module
- Admin Login
- Product Management (Add / Edit / Delete Products)
- Order Management
- Order Status Update (Pending, Confirmed, Dispatched, Delivered, Cancelled)
- Customer Management (View Registered Users)
- Company Details Management (Name, Address, Contact, Logo)

---

## 🗄 Database Structure

The project uses the following database tables:

- `users`
- `products`
- `orders`
- `order_items`
- `billing_details`
- `company_details`

---

## 🚀 How to Run the Project (Local Setup)

1. Install **XAMPP**
2. Copy the project folder into: C:\xampp\htdocs\
3. Start **Apache** and **MySQL** from XAMPP Control Panel
4. Open **phpMyAdmin**
5. Create a new database named: tripsy_db
6. Import the database file: database/tripsy_db.sql
7. Rename the configuration file: config.sample.php → config.php
8. Update database credentials in `config.php`
9. Open the project in browser: http://localhost/tripsy

---

## 🔐 Admin Access

Admin accounts are created manually in the database for security reasons.  
Admin panel is accessible via:
http://localhost/tripsy/admin/login.php

---

## 📂 Important Notes

- The file `config.php` is **not included** in the repository for security.
- Use `config.sample.php` as a reference configuration file.
- Upload images inside the `uploads/` directory.

---

## 📸 Screenshots


## 👩‍💻 Developed By

**Sarita Kore**

