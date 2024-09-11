<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    public function moksherat()
    {
       return $this->hasMany(Mokasher::class) ;
    }
    public function addedBy_fun()
    {
        return $this->belongsTo(User::class , 'addedBy' , 'id') ;
    }
    public  function goal()
    {
       return  $this->belongsTo(Goal::class) ;
    }
}
