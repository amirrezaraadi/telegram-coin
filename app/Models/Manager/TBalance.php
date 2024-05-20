<?php

namespace App\Models\Manager;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TBalance extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'publish_at'];

    protected $casts = [
        'publish_at' => 'timestamp'
    ];


}
