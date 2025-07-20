# MR. Book Web Platform

A full-stack web application for a bookstore, enabling browsing, filtering, and purchasing of books online.
Includes shopping cart functionality, user login, admin panel, responsive design, and a clean user experience.

# Project Overview

MR.Books is an educational project simulating a complete online bookstore.  
Users can browse books, filter by category/language, view detailed descriptions, mark favorites, add items to a cart, and proceed to checkout.  
Administrators can manage the book database through custom PHP scripts.  

The system integrates client-side and server-side technologies with connection to a remote MySQL database.

All files are hosted and executed via **ByetHost**, a free hosting provider with embeded MySQL database.

# Key Features

* Responsive design: mobile-friendly layout with dynamic scaling.
* Navigation bar with:
    - Homepage
    - Books display with filtering & sorting
    - Contact form (sends email)
    - "About Us" section
    - Favorites and cart access
    - Login & session management

* Book browsing:
    - Dynamic book data pulled from MySQL.
    - Search, category filtering, language filtering, and sort options.
    - "Add to Cart" and "Add to Favorites" buttons.
    - “More Details” button showing extended intro and metadata.

* Cart functionality:
    - Items saved using PHP sessions.
    - Quantity management (default = 1).
    - Persistent across pages.
    - Side menu and full cart page.

* "More Info" Page:
    - Book & author highlights from the database.
    - External links to related literature resources.
    - Table of recommended books (pulled from DB).
    - Video embed and reading tips.

* Contact form:
    - Styled with custom validation and alerts.
    - Sends actual emails via `send_contact.php`.

* Admin capabilities (via additional navigation bar):
    - Add books to database
    - View all book's details and remove books from database

# How to Use

**0. You May Simply Use The Link In The Repository's Description To Access The Site.**

**1. Environment Setup**

   - Upload all project files and folders as they are in the repository to your hosting service.
    
   * **Important :** Keep all files in their original folders.

**2. Database Connection**  

   - Create the database using `database/db_BookStore_mysql.sql` file.
   - If needed you may also use `database/BookStore_entries_mysql.sql` to insert data for testing. 
   - The database connection has already been established in the appropriate sections of each file that requires it. However, the server password has been removed for security purposes. If you wish to use the original files, please contact us to obtain it or use you own database.

   * DataBase access follows this format in PHP :

           $servername = "sql206.byethost16.com";
           $username = "b16_38703978";
           $password = "";
           $dbname = "b16_38703978_BookStore";
     
**3. Starting the System**

   - Run index.php as the main page.

# Minimum Hosting Server Requirements
   - Web Server supporting Apache, Nginx or similar custom clustered server environment.
   - Linux-based OS (e.g., Ubuntu, CentOS, Debian)
   - PHP support for version: PHP 7.4+
   - Database supporting MySQL 5.7+

# Database Structure

Main tables include:

- `book` – All book details: title, author, intro, picture, language, price, etc.
- `user` – All registered users and their profile data.
- `favorites` – Mapping between users and books they marked as favorite.
- `shopping_cart` and `cart_items` – Handles cart functionality per registered user.
- `categories` and `book_categories` – Enable category-based book filtering.
- `orders` and `order_items` – Allow tracking of previously placed orders.

> The database schema is available in `database/db_BookStore_mysql.sql`.

# Notes

- All design and layout is defined in external CSS files.
- Basic HTML/PHP/CSS/JS only – no external frameworks used.
- Book data is dynamically pulled from the database using PHP.
- Favorites and cart use PHP to access the database per user.
- All external links open in new tabs for better UX.
- Admin tools are provided in separate PHP navigation bar and scripts.
- Designed for educational and demonstration purposes.

# License

This project is licensed under a custom license:

You may use, copy, and modify the code for **personal or non-profit purposes** for free.  
If you wish to use the code in **any commercial or for-profit product**, you must contact the author and may be required to pay a fee or share profits.

© 2025 Ron Haba and Matan Sides  
All rights reserved.
