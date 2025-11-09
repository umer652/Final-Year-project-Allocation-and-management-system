<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedProject extends Model
{
    use HasFactory;
     public $timestamps = false;


    protected $fillable = [
        'project_id',
        'group_id',
        'supervisor_id',
        'session_id',
        'result',
        'fyp_phase'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}
