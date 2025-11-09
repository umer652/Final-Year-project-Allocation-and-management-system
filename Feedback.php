<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    use HasFactory;

    protected $primaryKey = 'feedback_id';

    protected $fillable = [
        'student_id',
        'group_id',
        'meeting_id',
        'start_time',
        'end_time',
        'remarks',
    ];

    // Relationships
    public function student(): BelongsTo {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function group(): BelongsTo {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function meeting(): BelongsTo {
        return $this->belongsTo(Meeting::class, 'meeting_id');
    }
}
