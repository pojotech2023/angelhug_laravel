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

    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo && file_exists(public_path('storage/' . $this->photo))) {
            return asset('storage/' . $this->photo);
        }
        return asset('img/angelhug_docx/image1.jpeg');
    }

    public function getEducationDocUrlAttribute(): ?string
    {
        if ($this->education_document && file_exists(public_path('storage/' . $this->education_document))) {
            return asset('storage/' . $this->education_document);
        }
        return null;
    }

    public function getGovtIdDocUrlAttribute(): ?string
    {
        if ($this->govt_id_proof && file_exists(public_path('storage/' . $this->govt_id_proof))) {
            return asset('storage/' . $this->govt_id_proof);
        }
        return null;
    }

    public function getResumeDocUrlAttribute(): ?string
    {
        if ($this->resume_document && file_exists(public_path('storage/' . $this->resume_document))) {
            return asset('storage/' . $this->resume_document);
        }
        return null;
    }
}
