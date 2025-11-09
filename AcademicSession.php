<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicSession extends Model
{
    protected $table = 'academic_sessions';
    protected $primaryKey = 'session_id';
    public $timestamps = false;

    protected $fillable = [
        'session_name',
        'start_date',
        'end_date',
    ];

    // One session has many Std_Grp_Ass records
    public function stdGrpAssignments()
    {
        return $this->hasMany(StdGrpAss::class, 'session_id', 'session_id');
    }
}
