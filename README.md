# Simple E-Commerce Shopping Cart (Laravel + Livewire)

This project is a simple e-commerce shopping cart system built as part of a technical assessment.

It allows authenticated users to browse products, manage a shopping cart, and demonstrates backend concepts such as queues, jobs, observers, and scheduled tasks.

## Tech Stack

* Backend: Laravel 12
* Frontend: Livewire
* Styling: Tailwind CSS
* Database: MySQL
* Queue: Database
* Mail: Log mailer
* Auth: Laravel Livewire Starter Kit (Fortify)

## Features

- User authentication (Laravel starter kit)
- Product listing
- User-based shopping cart (persisted in database, not session)
- Add, update, and remove cart items
- Automatic stock management
- Low stock email notification (queued job)
- Daily sales report email (scheduled job)
- Design Decisions
- Each user has exactly one cart, created automatically via a UserObserver.
- Business logic (stock updates, notifications) is handled via Observers, keeping UI components thin.
- Cart and Order are separated to avoid mixing transient cart data with reporting data.
- Jobs and scheduling are used for asynchronous tasks as required.
- Two-Factor Authentication was disabled to keep focus on core domain logic.
- Low Stock Notification
- Triggered when product stock reaches a defined threshold.
- Implemented as a queued job (LowStockNotificationJob).
- Email is sent to a dummy admin user (admin@example.com).

## Daily Sales Report

* Implemented as a scheduled queued job.
* Runs daily at 20:00.
* Aggregates products sold for the current day.
* Sends a summary email to the dummy admin user.
* Scheduler is defined in:

```
routes/console.php
```
(as per Laravel 12+ best practices)

## Setup Instructions
1. Clone Repository
```
git clone <repository-url>
cd <project>
```

2. Install Dependencies
```
composer install
npm install && npm run dev
```

3. Environment Setup
```
cp .env.example .env
php artisan key:generate
```

Update .env:
```
QUEUE_CONNECTION=database
MAIL_MAILER=log
```

4. Run Migrations & Seeders
```
php artisan migrate --seed
```

Seeded data includes:

Dummy admin user: admin@example.com / password

Sample products

5. Run Queue & Scheduler
```
php artisan queue:work
php artisan schedule:work
```

Emails can be viewed in:
```
storage/logs/laravel-{date}.log
```

## Assumptions

- Checkout is simulated by creating Order and OrderItem records.
- Reporting is based on OrderItem data.
- This project focuses on architecture and best practices rather than UI polish.

### Time Spent

Approximately 6–8 hours, focusing on clarity, correctness, and Laravel best practices.