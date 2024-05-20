<?php

namespace App\Models\Manager;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBalance extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['amount', 'publish_at'];

    protected $casts = [
        'publish_at' => 'timestamp'
    ];


}
