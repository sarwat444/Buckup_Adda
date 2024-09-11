<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory;
    public function  goals()
    {
        return $this->hasMany(Goal::class , 'objective_id' ,  'id') ;
    }

    /**
     * Get the kehta that owns the Objective
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kheta()
    {
        return $this->belongsTo(Kheta::class, 'kheta_id', 'id');
    }
}
