<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StdGrpAss extends Model
{
    protected $table = 'std_grp_ass';
    protected $fillable = [
        'student_id',
        'group_id',
        'session_id',
        'technology',
    ];
    public $timestamps = false;

    // Relationships
    public function session()
    {
        return $this->belongsTo(AcademicSession::class, 'session_id', 'session_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'gr_id');
    }
}
