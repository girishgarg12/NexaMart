**NexaMart - E-Portal for Marketing**
The platform allows users to browse products, add items to cart, and complete purchases, while also providing a seller portal for product management.
**Website Live link**: https://nexamartstore.wuaze.com/ .
**Project Overview**
NexaMart is a full-stack e-commerce web application developed as a learning project by BTech CSE students. The platform allows users to browse products, add items to cart, and complete purchases, while also providing a seller portal for product management.

###**Key Features**
**User Features**
Product Browsing: View products by category with detailed information

Shopping Cart: Add/remove items, adjust quantities

Checkout System: Secure payment processing with multiple options

User Authentication: Login/signup system with session management

Responsive Design: Mobile-friendly interface using Tailwind CSS

AI Chatbot: Gemini-powered shopping assistant

**Seller Features**
Product Management: Add/edit/delete products

Order Management: View and process customer orders

Promotion System: Feature products on the homepage

Inventory Tracking: Monitor product stock levels

**Technologies Used**
Frontend
HTML5, CSS3, JavaScript

Tailwind CSS for styling

PHP for server-side rendering

Swiper.js for product carousels

**Backend**
PHP for server logic

MySQL for database

Session management for user state

**Hosting**
InfinityFree free hosting service

Wuaze subdomain

Project Structure
nexamartstore/
├── aboutus.php          - About Us page with team information
├── bot.php              - AI chatbot implementation
├── checkout.php         - Shopping cart and checkout system
├── dbdetails.php        - Database connection configuration
├── signup.php           - User signup and account creation
├── sellerreg.php        - Seller signup and Registration
├── index.php            - Homepage with featured products
├── login1.php           - User authentication system
├── navbar.php           - Navigation bar component
├── products.php         - Product listing page
├── sell.php             - Seller information page
├── seller.php           - Seller dashboard
├── images/              - Image assets
└── uploads/             - Uploaded product images
###**Installation Instructions**
**Requirements:**

PHP 7.4 or higher

MySQL database

Web server (Apache recommended)

**Setup:**

Clone the repository

Import the SQL database schema

Configure dbdetails.php with your database credentials

Ensure the uploads/ directory has write permissions

Admin Access:

Set user role to 'seller' in database for seller access

**Usage**
As a Customer:

Browse products on the homepage

Add items to cart

Proceed through checkout

As a Seller:

Log in with seller credentials

Manage products in the inventory

Process incoming orders

Promote featured products

**Notes**
This project was developed for educational purposes

Currently hosted on free hosting with limitations

Contains example/test data for demonstration

**Future Improvements**
Implement payment gateway integration

Add product search functionality

Enhance mobile responsiveness

Implement user reviews and ratings

