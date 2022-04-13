<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'ref',
        'user_id',
        'service_id',
        'status_id',
        'subject',
        'body'
    ];
}
