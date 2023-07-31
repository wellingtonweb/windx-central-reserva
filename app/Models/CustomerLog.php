<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CustomerLog extends Model
{
    use HasFactory;

    public $fillable = [
        'customer_id', 'ip', 'os', 'browser', 'device'
    ];
}
