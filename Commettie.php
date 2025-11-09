<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commettie extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'designation',
    ];

    public $timestamps = false;

    // relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
