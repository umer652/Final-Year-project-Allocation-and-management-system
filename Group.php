<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';
    protected $primaryKey = 'gr_id';
    public $timestamps = false;

    protected $fillable = [
        'mem_count',
    ];

    // Relationships
    public function stdGrpAssignments()
    {
        return $this->hasMany(StdGrpAss::class, 'group_id', 'gr_id');
    }

    public function projects()
    {
        return $this->hasMany(Assigned::class, 'group_id', 'gr_id');
    }
}
