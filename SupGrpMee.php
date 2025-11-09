<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupGrpMee extends Model
{
    protected $primaryKey = 'sup_grp_mee_id';
    public $timestamps = false;

    protected $fillable = [
        'supervisor_id',
        'group_id',
        'meeting_id',
        'status'
    ];

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'gr_id');
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class, 'meeting_id', 'meeting_id');
    }
}
