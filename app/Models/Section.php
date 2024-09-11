<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function lessons():HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public function updateLessonsOrder(array $lessonsIds): void
    {
        $lessons = $this->lessons()->get();
        $count   = $this->lessons()->count();
        for ($iterate = 0; $iterate < $count; $iterate++) {
            $lessons->find($lessonsIds[$iterate])->update(['ordering' => $iterate]);
        }
    }
}
