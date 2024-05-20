<?php

namespace App\Models\Manager;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Energy extends Model
{
    use HasFactory , SoftDeletes;


    protected $fillable = [
        'title',
        'size',
        'unit',
        'amount',
        'is_default',
        'player_id'
    ];

    protected $casts = [
        'publish_at' => 'timestamp'
    ];


}
