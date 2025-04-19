# Food Park - A Laravel-based Food Ordering System

**Food Park** is a modern web-based food ordering platform built using **Laravel 10** that facilitates users to browse food items, place orders, and receive real-time updates. The system includes an easy-to-use interface for customers and a comprehensive admin panel for managing food items, orders, and users.

## Features

### User Features:
- **User Authentication**: Customers can register, log in, and securely manage their accounts.
- **Browse Food Items**: Users can view a wide variety of food items with descriptions and images.
- **Place Orders**: Customers can add items to their cart and place orders for delivery or pickup.
- **Order History**: Customers can track their past orders and reorder with ease.
- **Real-time Notifications**: Users get real-time updates about the order status (e.g., preparing, dispatched, completed).

### Admin Features:
- **Admin Authentication**: Admins have their own login and dashboard to manage the platform.
- **Manage Food Items**: Admins can add, update, and delete food items, and manage categories.
- **Manage Orders**: Admins can view and process customer orders.
- **User Management**: Admins can view and manage customer accounts, including access control.
- **Real-time Order Status Update**: Admins can update the status of orders in real time.

## Technologies Used
- **Backend**: Laravel 10 (MVC architecture)
- **Frontend**: Blade templating engine with **Tailwind CSS** for modern styling
- **Database**: MySQL
- **Authentication**: Laravel Breeze for user authentication
- **Real-time Communication**: Laravel Echo and Pusher for real-time notifications

## Installation

1. Clone this repository to your local machine.
2. Run `composer install` to install the required dependencies.
3. Copy the `.env.example` file and rename it to `.env`. Update your database credentials.
4. Run `php artisan migrate` to create the necessary database tables.
5. Serve the application with `php artisan serve` and access it at `http://localhost:8000`.

## Conclusion

Food Park is a robust food ordering platform designed to provide a seamless experience for both users and admins. Built on Laravel, it ensures high performance, scalability, and security. The project is ideal for anyone interested in developing a full-stack food delivery application with real-time features.


