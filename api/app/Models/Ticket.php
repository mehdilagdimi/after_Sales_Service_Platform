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

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function status(){
        // $this->hasOne(Status::class); this will cause errors?
        return $this->belongsTo(Status::class);
    }
}
