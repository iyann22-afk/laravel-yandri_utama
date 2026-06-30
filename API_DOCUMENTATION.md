# API Documentation - Warehouse Management System (WMS)

Sistem Informasi Manajemen Gudang (Enterprise Edition). 
Dibangun dengan Arsitektur Clean, Repository Pattern, dan Event-Driven System.

## Base URL
`http://127.0.0.1:8000/api`

---

## 1. Authentication
* **POST** `/login` - Login untuk mendapatkan Sanctum Token.
* **POST** `/logout` - Menghapus token sesi user.

## 2. Master Data Module
* **GET** `/products` - List semua produk.
* **POST** `/products` - Tambah produk baru.
* **GET** `/categories` - List kategori barang.
* **GET** `/suppliers` - List supplier.
* **GET** `/customers` - List pelanggan.
* **GET** `/warehouses` - List lokasi gudang.

## 3. Transaction Module
* **POST** `/purchases` - Create transaksi pembelian (PO).
* **POST** `/sales` - Create transaksi penjualan.
* **GET** `/stock-movements` - Riwayat pergerakan stok (In, Out, Adjustment).

## 4. System Features (Backend Integration)
* **Observer Pattern**: Otomatis update stok produk saat `StockMovement` dibuat.
* **Redis Queue**: Proses notifikasi stok menipis berjalan di background.
* **Event Notification**: Pengiriman alert ke admin jika stok < 10.

---
*Dokumentasi ini disusun untuk mempermudah integrasi frontend dan keperluan audit sistem.*