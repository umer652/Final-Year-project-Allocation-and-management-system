<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $timestamps = false; 
    protected $fillable = ['title', 'description'];

    public function assigned()
    {
        return $this->belongsToMany(Assigned::class, 'assigned_project');
    }
}
