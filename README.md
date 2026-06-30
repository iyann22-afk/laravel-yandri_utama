# Warehouse Management System (WMS) - Enterprise Edition

Aplikasi ini dibangun untuk mengelola operasional gudang secara efisien dengan arsitektur Clean Architecture, Repository Pattern, dan integrasi Redis Queue.

## Fitur Utama
- **Modul Master**: User, Role, Permission, Product, Category, Supplier, Customer, Warehouse.
- **Modul Transaksi**: Purchase, Sales, dan Stock Movement (In, Out, Adjustment).
- **Enterprise Features**: Sanctum Auth, Observer-based Stock Updates, Redis Queue, dan Event-driven Notification.

## Cara Instalasi
1. Clone repository: `git clone https://github.com/iyann22-afk/laravel-yandri_utama.git`
2. Install dependensi: `composer install`
3. Salin env: `cp .env.example .env`
4. Setup Database & Migrasi: `php artisan migrate`
5. Jalankan server: `php artisan serve`

## Arsitektur


## Dokumentasi API
Dokumentasi Swagger tersedia di `/api/documentation`.