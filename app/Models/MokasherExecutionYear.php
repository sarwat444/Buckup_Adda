<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MokasherExecutionYear extends Model
{
    use HasFactory;
    public  function Excution_year()
    {
        return $this->belongsTo(Execution_year::class , 'year_id' , 'id') ;
    }
}
