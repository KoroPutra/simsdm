<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    use HasFactory;

    protected $table = 'konsultasi';
    protected $fillable = [
        'id','user_id','email','no_telpon','judul','pesan',
    ];

    public function getAll()
    {
        
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
