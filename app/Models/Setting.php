<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $table = 'settings';
/*    protected $casts = [
        'data' => 'array'
    ];*/
}