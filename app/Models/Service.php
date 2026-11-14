<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'price',
        'gst_rate',
        'gst_exempt',
        'platform_fee',
        'extra_charges',
        'extra_charges_label',
        'duration',
        'description',
        'date',
        'image',
        'images',
        'is_active',
        'featured',
    ];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
        'featured' => 'boolean',
        'gst_exempt' => 'boolean',
        'price' => 'decimal:2',
        'gst_rate' => 'decimal:2',
        'platform_fee' => 'decimal:2',
        'extra_charges' => 'decimal:2',
    ];

    public function bookings()
    {
        return $this->hasMany(ServiceBooking::class);
    }

    public function enquiries()
    {
        return $this->hasMany(ServiceEnquiry::class);
    }

    public function subServices()
    {
        return $this->hasMany(SubService::class, 'service_id')->where('is_active', true)->orderBy('sort_order', 'asc');
    }

    public function allSubServices()
    {
        return $this->hasMany(SubService::class, 'service_id')->orderBy('sort_order', 'asc');
    }

    /**
     * Get effective GST rate for this specific service.
     */
    public function getEffectiveGstRateAttribute(): float
    {
        if ($this->gst_exempt) {
            return 0.00;
        }

        if ($this->gst_rate !== null) {
            return (float) $this->gst_rate;
        }

        $globalEnabled = (bool) Setting::get('gst_enabled', true);
        return $globalEnabled ? (float) Setting::get('gst_percentage', 5.0) : 0.00;
    }

    /**
     * Get effective platform fee for this specific service.
     */
    public function getEffectivePlatformFeeAttribute(): float
    {
        if ($this->platform_fee !== null && (float) $this->platform_fee > 0) {
            return (float) $this->platform_fee;
        }

        $globalFee = Setting::get('platform_fee');
        if ($globalFee !== null && (float) $globalFee > 0) {
            return (float) $globalFee;
        }

        return 100.00; // Standard default "Others" fee
    }

    /**
     * Get effective extra charges for this specific service.
     */
    public function getEffectiveExtraChargesAttribute(): float
    {
        if ($this->extra_charges !== null && (float) $this->extra_charges > 0) {
            return (float) $this->extra_charges;
        }

        $globalEnabled = (bool) Setting::get('extra_charge_enabled', false);
        return $globalEnabled ? (float) Setting::get('extra_charge_amount', 0.0) : 0.00;
    }

    /**
     * Get effective extra charge label for this specific service.
     */
    public function getEffectiveExtraChargesLabelAttribute(): string
    {
        if (!empty($this->extra_charges_label)) {
            return $this->extra_charges_label;
        }

        return (string) Setting::get('extra_charge_label', 'Sanitization & Clinical Consumables Kit');
    }

    public function getFormattedPriceAttribute()
    {
        return '₹' . number_format($this->price ?? 0, 2);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(public_path('storage/' . $this->image))) {
            return asset('storage/' . $this->image);
        }
        if ($this->image && file_exists(public_path($this->image))) {
            return asset($this->image);
        }
        return asset('img/about-1.jpg');
    }

    public function getGalleryUrlsAttribute()
    {
        if (empty($this->images) || !is_array($this->images)) {
            return [];
        }

        $urls = [];
        foreach ($this->images as $img) {
            if (!$img) continue;

            if (file_exists(public_path('storage/' . $img))) {
                $urls[] = asset('storage/' . $img);
            } elseif (file_exists(public_path($img))) {
                $urls[] = asset($img);
            } elseif (str_starts_with($img, 'services/')) {
                $urls[] = asset('storage/' . $img);
            } else {
                $urls[] = asset($img);
            }
        }

        return $urls;
    }
}
