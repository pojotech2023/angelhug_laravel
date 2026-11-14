<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceEnquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'service_id',
        'subject',
        'message',
        'status',
        'admin_notes',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
