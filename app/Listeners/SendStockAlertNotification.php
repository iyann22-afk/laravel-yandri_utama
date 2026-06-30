<?php

namespace App\Listeners;

use App\Events\StockBelowThreshold;
use App\Notifications\LowStockNotification;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendStockAlertNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(StockBelowThreshold $event): void
    {
        // Dalam skenario nyata, kita ambil User yang role-nya 'Admin' atau 'Warehouse Manager'
        // Untuk keperluan ujian, kita ambil semua user untuk dikirimi notifikasi
        $admins = User::all(); 
        
        Notification::send($admins, new LowStockNotification($event->product));
    }
}