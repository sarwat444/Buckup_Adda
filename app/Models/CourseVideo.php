<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class CourseVideo extends Model
{
    use HasFactory;

    public function folder(): HasOne
    {
        return $this->hasOne(VimeoFolder::class, 'id', 'folder_id');
    }
}
