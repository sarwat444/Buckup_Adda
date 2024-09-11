<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kheta extends Model
{
    use HasFactory;

    public function objectives()
    {
       return $this->hasMany(Objective::class) ;
    }
    public function ratingMembers()
    {
        return $this->hasMany(RatingMember::class) ;
    }

}
