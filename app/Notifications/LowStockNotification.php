<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class LowStockNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function via(object $notifiable): array
    {
        return ['database']; // Menyimpan notifikasi ke dalam tabel database
    }

    public function toArray(object $notifiable): array
    {
        return [
            'product_id' => $this->product->id,
            'message' => "Peringatan: Stok untuk produk {$this->product->name} (SKU: {$this->product->sku}) telah menipis. Sisa stok: {$this->product->stock}",
        ];
    }
}