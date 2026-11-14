<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_number',
        'user_id',
        'service_id',
        'sub_service_id',
        'sub_service_name',
        'duration_type',
        'booking_date',
        'booking_end_date',
        'booking_time',
        'booking_end_time',
        'caller_name',
        'caller_relationship',
        'patient_name',
        'patient_age',
        'patient_gender',
        'patient_condition',
        'patient_documents',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'google_maps_link',
        'notes',
        'base_fee',
        'platform_fee',
        'extra_charges',
        'gst_rate',
        'gst_amount',
        'amount',
        'currency',
        'payment_status',
        'payment_method',
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_signature',
        'booking_status',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'booking_end_date' => 'date',
        'amount' => 'decimal:2',
        'base_fee' => 'decimal:2',
        'platform_fee' => 'decimal:2',
        'extra_charges' => 'decimal:2',
        'gst_rate' => 'decimal:2',
        'gst_amount' => 'decimal:2',
        'patient_documents' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function subService()
    {
        return $this->belongsTo(SubService::class, 'sub_service_id');
    }

    public function getEffectiveGstRateAttribute(): float
    {
        return ($this->gst_rate !== null) ? (float) $this->gst_rate : 5.0;
    }

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

    public function getEffectiveExtraChargesAttribute(): float
    {
        return (float) ($this->extra_charges ?: 0.00);
    }

    public function getEffectiveBaseFeeAttribute(): float
    {
        if ((float) $this->base_fee > 0) {
            return (float) $this->base_fee;
        }
        $total = (float) $this->amount;
        $gstRate = $this->effective_gst_rate;
        $taxable = round($total / (1 + ($gstRate / 100)), 2);
        return max(0, round($taxable - $this->effective_platform_fee - $this->effective_extra_charges, 2));
    }

    public function getEffectiveGstAmountAttribute(): float
    {
        if ((float) $this->gst_amount > 0) {
            return (float) $this->gst_amount;
        }
        $total = (float) $this->amount;
        $gstRate = $this->effective_gst_rate;
        $taxable = round($total / (1 + ($gstRate / 100)), 2);
        return round($total - $taxable, 2);
    }

    public static function generateBookingNumber(): string
    {
        $prefix = 'AH' . date('Ymd');
        $random = strtoupper(substr(uniqid(), -5));
        return $prefix . '-' . $random;
    }
}
