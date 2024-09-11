<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Execution_year extends Model
{
    use HasFactory;

    public function MokasherExcutionYears()
    {
        return $this->hasOne(MokasherExecutionYear::class , 'year_id' ,'id') ;
    }
}
