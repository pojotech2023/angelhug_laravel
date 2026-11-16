<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caretaker extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'dob' => 'date',
        'age' => 'integer',
    ];

    public static function generateApplicationNo(): string
    {
        $prefix = 'AH-CT-' . date('Ym');
        $random = strtoupper(substr(uniqid(), -4));
        return $prefix . '-' . $random;
    }

    public function getInitialsAttribute(): string
    {
        $words = preg_split('/[\s\._-]+/', trim((string)$this->name));
        $initials = '';
        foreach ($words as $w) {
            if (!empty($w)) {
                $initials .= strtoupper(substr($w, 0, 1));
            }
            if (strlen($initials) >= 2) {
                break;
            }
        }
        return $initials ?: 'CT';
    }

    public function getPhotoUrlAttribute(): ?string
    {
        if (!empty($this->photo)) {
            return asset('storage/' . $this->photo);
        }
        return null;
    }

    public function getEducationDocUrlAttribute(): ?string
    {
        if (!empty($this->education_document)) {
            return asset('storage/' . $this->education_document);
        }
        return null;
    }

    public function getGovtIdDocUrlAttribute(): ?string
    {
        if (!empty($this->govt_id_proof)) {
            return asset('storage/' . $this->govt_id_proof);
        }
        return null;
    }

    public function getResumeDocUrlAttribute(): ?string
    {
        if (!empty($this->resume_document)) {
            return asset('storage/' . $this->resume_document);
        }
        return null;
    }
}
