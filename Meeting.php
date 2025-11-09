<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meeting extends Model
{
    use HasFactory;

    protected $primaryKey = 'meeting_id';

    protected $fillable = [
        'meeting_type',
        'date',
        'start_time',
        'agenda',
    ];

    // ✅ Relation with Feedback
    public function feedbacks(): HasMany {
        return $this->hasMany(Feedback::class, 'meeting_id');
    }

    // ✅ Relation with Student_Group_Meeting
    public function studentGroupMeetings(): HasMany {
        return $this->hasMany(StudentGroupMeeting::class, 'meeting_id');
    }
}
