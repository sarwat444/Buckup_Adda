<?php

namespace App\Models;

use App\Http\Controllers\Web\Site\UsersController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MokasherGehaInput extends Model
{
    use HasFactory;
    public function mokasher()
    {
        return $this->belongsTo(Mokasher::class , 'mokasher_id') ;
    }
    public function ex_year()
    {
       return  $this->belongsTo(Execution_year::class , 'year_id' , 'id');
    }
    public function sub_geha()
    {
       return  $this->belongsTo(User::class , 'sub_geha_id' , 'id');
    }

    public function geha()
    {
        return $this->belongsTo(User::class , 'geha_id' , 'id');
    }
}
