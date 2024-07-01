<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'unit_kerja'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
