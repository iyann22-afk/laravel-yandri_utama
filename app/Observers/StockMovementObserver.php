<?php

namespace App\Observers;

use App\Models\StockMovement;

class StockMovementObserver
{
    /**
     * Handle the StockMovement "created" event.
     */
    public function created(StockMovement $stockMovement): void
    {
        // Panggil relasi product yang terkait dengan pergerakan ini
        $product = $stockMovement->product;

        // Logika penambahan/pengurangan stok
        if ($stockMovement->movement_type === 'in') {
            $product->increment('stock', $stockMovement->quantity);
        } elseif ($stockMovement->movement_type === 'out') {
            $product->decrement('stock', $stockMovement->quantity);
        } elseif ($stockMovement->movement_type === 'adjustment') {
            // Untuk adjustment, asumsinya quantity bisa minus atau plus dari input
            $product->increment('stock', $stockMovement->quantity);
        }
        // Catatan: Untuk 'transfer' idealnya mengurangi stok gudang A dan menambah gudang B, 
        // tapi untuk WMS dasar, kita fokus ke total stok produk terlebih dahulu.
    }

    // ... (biarkan method updated, deleted, dll kosong di bawahnya)
}