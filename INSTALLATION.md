# TradiFoods Installation Guide

## Requirements
- PHP 8.2+
- Composer
- Node.js 18+
- MySQL 8+

## Setup
1. Copy `.env.example` to `.env` and update DB credentials.
2. Install backend dependencies:
   - `composer install`
3. Install frontend dependencies:
   - `npm install`
4. Generate app key:
   - `php artisan key:generate`
5. Run migrations + seed data:
   - `php artisan migrate --seed`
6. Link storage for uploads:
   - `php artisan storage:link`
7. Build assets:
   - `npm run build`

## Admin Login
- Email: `admin@tradifoods.test`
- Password: `password`

## SQL Dump
- `database/tradifoods.sql`

## Notes
- Razorpay is scaffolded in checkout; add your keys and integrate the Razorpay API for live payments.
- WhatsApp button link in `resources/views/layouts/store.blade.php`.
