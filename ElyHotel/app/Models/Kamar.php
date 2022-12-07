<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kamar';

    protected $fillable = [
        'room_name',
        'room_class',
        'room_used_status',
        'room_capacity',
        'room_number',
        'room_price'
    ];
}
