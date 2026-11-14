<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubService extends Model
{
    use HasFactory;

    protected $table = 'sub_services';

    protected $fillable = [
        'service_id',
        'title',
        'subtitle',
        'price',
        'duration',
        'features',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'features' => 'array',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function bookings()
    {
        return $this->hasMany(ServiceBooking::class, 'sub_service_id');
    }

    public function getFormattedPriceAttribute(): string
    {
        return '₹' . number_format($this->price ?? 0, 2);
    }

    public function getFeaturesListAttribute(): array
    {
        $raw = $this->features;

        if (is_array($raw)) {
            return array_values(array_filter(array_map('trim', $raw)));
        }

        if (is_string($raw)) {
            $decoded = json_decode($raw, true);
            if (is_array($decoded)) {
                return array_values(array_filter(array_map('trim', $decoded)));
            }

            // Split by newline or commas if not json
            $items = preg_split('/[\r\n]+/', $raw);
            return array_values(array_filter(array_map('trim', $items)));
        }

        return [];
    }
}
