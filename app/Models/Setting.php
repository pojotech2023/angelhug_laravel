<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'description',
    ];

    /**
     * Get a setting value by key with optional default.
     */
    public static function get(string $key, $default = null)
    {
        return Cache::remember('app_setting_' . $key, 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            if (!$setting) {
                return $default;
            }

            switch ($setting->type) {
                case 'boolean':
                case 'bool':
                    return filter_var($setting->value, FILTER_VALIDATE_BOOLEAN);
                case 'decimal':
                case 'float':
                    return (float) $setting->value;
                case 'integer':
                case 'int':
                    return (int) $setting->value;
                case 'json':
                case 'array':
                    return json_decode($setting->value, true) ?: $default;
                default:
                    if ($key === 'platform_fee_label') {
                        if (empty($setting->value) || stripos($setting->value, 'Clinical') !== false || stripos($setting->value, 'Protocol') !== false) {
                            return 'Others';
                        }
                    }
                    return $setting->value;
            }
        });
    }

    /**
     * Set a setting value by key.
     */
    public static function set(string $key, $value, ?string $type = null): self
    {
        Cache::forget('app_setting_' . $key);

        $setting = static::firstOrNew(['key' => $key]);

        if (is_bool($value)) {
            $setting->value = $value ? '1' : '0';
            $setting->type = $type ?: 'boolean';
        } elseif (is_numeric($value)) {
            $setting->value = (string) $value;
            $setting->type = $type ?: (str_contains((string) $value, '.') ? 'decimal' : 'integer');
        } elseif (is_array($value)) {
            $setting->value = json_encode($value);
            $setting->type = $type ?: 'json';
        } else {
            $setting->value = (string) $value;
            if ($type) $setting->type = $type;
        }

        $setting->save();
        return $setting;
    }

    /**
     * Clear all cached settings.
     */
    public static function clearCache(): void
    {
        Cache::flush();
    }

    /**
     * Retrieve all current billing settings in a structured array.
     */
    public static function getBillingSettings(): array
    {
        return [
            'gst_enabled' => (bool) static::get('gst_enabled', true),
            'gst_percentage' => (float) static::get('gst_percentage', 5.0),
            'platform_fee' => (float) (static::get('platform_fee') ?: 100.0),
            'platform_fee_label' => (string) static::get('platform_fee_label', 'Others'),
            'extra_charge_enabled' => (bool) static::get('extra_charge_enabled', false),
            'extra_charge_amount' => (float) static::get('extra_charge_amount', 0.0),
            'extra_charge_label' => (string) static::get('extra_charge_label', 'Sanitization & Consumables Kit'),
            'gstin_number' => (string) static::get('gstin_number', '33AAHCA8492C1ZP'),
        ];
    }
}
