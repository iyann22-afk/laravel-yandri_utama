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
Aplikasi ini mengadopsi prinsip *Clean Architecture* dengan memisahkan tanggung jawab menjadi beberapa lapisan (*layers*) untuk menjaga kode tetap rapi, *testable*, dan *maintainable*.

## Arsitektur
Aplikasi ini mengadopsi prinsip *Clean Architecture* dengan memisahkan tanggung jawab menjadi beberapa lapisan (*layers*) untuk menjaga kode tetap rapi, *testable*, dan *maintainable*.

### Struktur Layer:
1. **Presentation Layer (`Controllers`):** Menangani *request* HTTP dan mengembalikan *response*. Tidak mengandung logika bisnis.
2. **Service Layer:** Menampung logika bisnis utama dan validasi kompleks.
3. **Repository Layer:** Bertindak sebagai lapisan abstraksi data. `Controller` dan `Service` berinteraksi dengan `Repository` untuk mengakses database, sehingga aplikasi tidak bergantung langsung pada *Eloquent Model*.
4. **Infrastructure Layer:** Berisi `Models`, `Observers` (untuk *lifecycle hooks* stok), dan `Jobs` (untuk *asynchronous processing* via Redis Queue).

### Flow Data:
```mermaid
graph LR
    A[Request/HTTP] --> B[Controller]
    B --> C[Service Layer]
    C --> D[Repository Layer]
    D --> E[Eloquent Models]
    E -.-> F[Observer/Event]
    F -.-> G[Redis Queue]

## Dokumentasi API
Dokumentasi Swagger tersedia di `/api/documentation`.

## Screenshots
![Dashboard](screenshots/)