<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Events\AssignOrderingToLessonWasCreated;
use App\Events\InstructorSectionLessonUpdated;
use Illuminate\Database\Eloquent\Model;
use App\Enums\VideoUploadStatus;
use App\Enums\LessonType;

class Lesson extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'created' => AssignOrderingToLessonWasCreated::class,
        'updated' => InstructorSectionLessonUpdated::class
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function folder(): BelongsTo
    {
        return $this->belongsTo(VimeoFolder::class);
    }

    public function isFree(): bool
    {
        return $this->getAttribute('is_free');
    }

    public function isPublish(): bool
    {
        return $this->getAttribute('is_publish');
    }

    public function isDocument(): bool
    {
        return (int)$this->getAttribute('type') === LessonType::document->value;
    }

    public function isVideo(): bool
    {
        return (int)$this->getAttribute('type') === LessonType::video->value;
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function views(): MorphMany
    {
        return $this->morphMany(View::class, 'viewable');
    }

    public function scopeTypeVideo($query)
    {
        return $query->where('type', LessonType::video->value);
    }

    public function published($query)
    {
        return $query->where('is_publish', true);
    }

    public function scopeWhereStatusNotAvailable($query)
    {
        return $query->whereNotIn('status', [VideoUploadStatus::available->name]);
    }

    public function scopeTypeDocument($query)
    {
        return $query->where('type', LessonType::document->value);
    }

    public function lesson_progress(): HasOne
    {
        return $this->hasOne(LessonProgress::class);
    }
}
