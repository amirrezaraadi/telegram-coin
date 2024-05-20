<?php

namespace App\Models\Manager;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Energy extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'size',
        'unit',
        'amount',
        'is_default',
    ];

    protected $casts = [
        'publish_at' => 'timestamp'
    ];


}
