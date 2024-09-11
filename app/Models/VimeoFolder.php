<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VimeoFolder extends Model
{
    use HasFactory;

    public function scopeFolder($query,int $folder_id): Builder
    {
        return $query->where('folder_id',$folder_id);
    }
}
