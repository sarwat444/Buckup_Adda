<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mokasher extends Model
{
    use HasFactory;
    public function addedBy_fun()
    {
        return $this->belongsTo(User::class , 'addedBy' , 'id') ;
    }
    public function mokasher_inputs()
    {
        return $this->hasOne(MokasherInput::class , 'mokasher_id' , 'id') ;
    }
    public function mokasher_geha_inputs()
    {
        return $this->hasOne(MokasherGehaInput::class , 'mokasher_id' , 'id') ;

    }
    public  function  mokasher_geha_inputss()
    {
        return $this->hasMany(MokasherGehaInput::class , 'mokasher_id' , 'id') ;
    }
    public function mokasher_execution_years()
    {
        return $this->hasMany(MokasherExecutionYear::class , 'mokasher_id' , 'id') ;

    }
    public function program()
    {
        return $this->belongsTo(Program::class , 'program_id' , 'id') ;

    }
}
