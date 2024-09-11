<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use App\Constant\CourseOptions;
use App\Enums\LessonType;

class Course extends Model implements HasMedia
{
    protected $appends = [
        'has_video',
        'has_instructor',
        'has_prerequisites',
        'enrolled',
    ];

    use HasFactory, InteractsWithMedia;


    public function getEnrolledAttribute(): bool
    {
        return $this->enrollments()->where('user_id', auth()->id())->exists();
    }

    public function scopeTopCourses($query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('is_top', CourseOptions::is_top);
    }

    public function scopeActiveCourses($query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('is_active', CourseOptions::is_active);
    }


    public function getHasVideoAttribute(): bool
    {
        return $this->video()->exists();
    }

    public function getHasInstructorAttribute(): bool
    {
        return !is_null($this->getAttribute('user_id'));
    }

    public function getHasPrerequisitesAttribute(): bool
    {
        return $this->prerequisites()->exists();
    }

    public function rates(): MorphMany
    {
        return $this->morphMany(Rate::class, 'rateable');
    }

    public function rates_avg_rate(): float
    {
        return $this->getAttribute('rates_avg_rate') * 20;
    }

    public function IsTop(): bool
    {
        return $this->getAttribute('is_top');
    }

    public function IsActive(): bool
    {
        return $this->getAttribute('is_active');
    }

    public function IsFree(): bool
    {
        return $this->getAttribute('is_free');
    }

    public function NotIsFree(): bool
    {
        return !$this->getAttribute('is_free');
    }

    public function IsDiscounted(): bool
    {
        return !is_null($this->getAttribute('old_price')) && $this->getAttribute('old_price') > 0;
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function video(): HasOne
    {
        return $this->hasOne(CourseVideo::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function prerequisites(): HasMany
    {
        return $this->hasMany(CoursePrerequisite::class);
    }

    public function createManyPrerequisites($course, $prerequisites): void
    {
        foreach ($prerequisites as $prerequisite) {
            if (isset($prerequisite['course_prerequisites'])) {
                $course->prerequisites()->create(['course_prerequisites' => $prerequisite['course_prerequisites']]);
            }
        }
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('courses')->singleFile();
    }



    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('courses_thumb')
            ->width(250)
            ->height(250)
            ->quality(100)
            ->nonQueued();
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public function availableLessons(): HasMany
    {
        return $this->hasMany(Lesson::class)->where([
            ['type', LessonType::video->value],
            ['is_free', true],
            ['is_publish', true],
        ]);
    }

    public function folder(): HasOne
    {
        return $this->hasOne(VimeoFolder::class);
    }

    public function lastLesson(): HasOne
    {
        return $this->hasOne(Lesson::class)->latest();
    }

    public function course_progress(): HasMany
    {
        return $this->hasMany(LessonProgress::class)->where('is_completed', true);
    }
}
